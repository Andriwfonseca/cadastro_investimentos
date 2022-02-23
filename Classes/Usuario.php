<?php
class Usuario{

    public function cadastrar($nome, $email, $senha, $telefone, $estado, $cidade, $bairro, $rua, $numero, $admin){
        global $pdo;        
        
        //verifica se esse email ja esta cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $pdo->prepare("INSERT INTO usuarios SET  nome = :nome, email = :email,
                                                            senha = :senha, telefone = :telefone,
                                                            estado = :estado, cidade = :cidade,
                                                            bairro = :bairro, rua = :rua, numero = :numero,
                                                            admin = :admin");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":estado", $estado);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":admin", $admin);
            $sql->execute();

            return true;
        }else{
            return false;
        }
    }    

    public function login($email, $senha){
        global $pdo;

        $sql = $pdo->prepare("SELECT id, nome, admin FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();
        
        //Se existir um usuario com esse email e senha, salva a id dele na sessao
        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            
            $_SESSION['cLogin'] = $dado['id'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['cAdmin'] = $dado['admin'];

            return true;
        }else{
            return false;
        }
    }

    public function getUsuario($id){
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);       
        $sql->execute();
        
        $dados = [];
        //Se existir um usuario com esse email e senha, salva a id dele na sessao
        if($sql->rowCount() > 0){
            $dados = $sql->fetch(); 
        }

        return $dados;
    }

    public function alterarCadastro($id, $nome, $email, $senha, $telefone, $estado, $cidade, $bairro, $rua, $numero){
        global $pdo;        
        
        //verifica se esse email ja esta cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND id != :id");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $pdo->prepare("UPDATE usuarios SET  nome = :nome, email = :email,
                                                        senha = :senha, telefone = :telefone,
                                                        estado = :estado, cidade = :cidade,
                                                        bairro = :bairro, rua = :rua, numero = :numero
                                                        WHERE id = :id");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":estado", $estado);
            $sql->bindValue(":cidade", $cidade);
            $sql->bindValue(":bairro", $bairro);
            $sql->bindValue(":rua", $rua);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":id", $id);
            $sql->execute();

            return true;
        }else{
            return false;
        }
    }    

    public function listarParticipantes($id_investimento){
        global $pdo;
     
        $sql = $pdo->prepare("SELECT usuarios.nome FROM usuarios INNER JOIN relacionamentos 
                                    ON (usuarios.id = relacionamentos.id_usuario and 
                                    relacionamentos.id_investimento = :id_investimento)");
        $sql->bindValue(":id_investimento", $id_investimento);       
        $sql->execute();
        
        $dados = [];
        //Se existir um usuario com esse email e senha, salva a id dele na sessao
        if($sql->rowCount() > 0){   
            $dados = $sql->fetchAll(); 
        }

        return $dados;

    }
}