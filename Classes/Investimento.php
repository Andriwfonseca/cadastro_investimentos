<?php

class Investimento{

    public function cadastrar($descricao, $valor_cota, $percentual, $valor_pagar, $qtd_cota){
        global $pdo;        
        
        $id_admin = $_SESSION['cAdmin'];

        $sql = $pdo->prepare("SELECT id FROM investimentos WHERE descricao = :descricao");
        $sql->bindValue(":descricao", $descricao);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $pdo->prepare("INSERT INTO investimentos SET  descricao = :descricao, valor_cota = :valor_cota,
                                                            percentual = :percentual, valor_pagar = :valor_pagar,
                                                            qtd_cota = :qtd_cota, id_admin = :id_admin");
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":valor_cota", $valor_cota);
            $sql->bindValue(":percentual", $percentual);
            $sql->bindValue(":valor_pagar", $valor_pagar);    
            $sql->bindValue(":qtd_cota", $qtd_cota);
            $sql->bindValue(":id_admin", $id_admin);
           
            $sql->execute();

            return true;
        }else{
            return false;
        }
    }   

    public function listarInvestimentos($id_usuario, $filtro, $ja_participante, $nao_participante){
        global $pdo;
        $dados = [];

        $order = "ASC";

        if($filtro === "valor_cota_maior" || $filtro === "qtd_cota"){
            $order = "DESC";
            $filtro = str_replace("_maior", "", $filtro);
        }else  if($filtro === "valor_cota_menor"){
            $filtro = str_replace("_menor", "", $filtro);            
        }   

        if($ja_participante == "on" && $nao_participante != "on"){
            $query = "SELECT investimentos.* FROM investimentos INNER JOIN relacionamentos ON (investimentos.id = relacionamentos.id_investimento and
            relacionamentos.id_usuario = :id_usuario) ORDER BY investimentos." .$filtro ." " .$order;
        }
        else if($nao_participante == "on" && $ja_participante != "on"){
            $query = "SELECT * FROM investimentos as inv WHERE 
            NOT EXISTS (SELECT * FROM relacionamentos as rel WHERE inv.id = rel.id_investimento and rel.id_usuario = :id_usuario) ORDER BY inv." .$filtro ." " .$order;
        }else if($ja_participante == "on" && $nao_participante == "on"){
            $query = "SELECT * FROM investimentos ORDER BY " .$filtro ." " .$order;
        }else{
            return $dados;
        }      
       
        $sql = $pdo->prepare($query);   
        if($ja_participante != "on" || $nao_participante != "on"){   
            
            $sql->bindValue(":id_usuario", $id_usuario);           
        }
       
        $sql->execute();        
       
        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll();               
        }

        return $dados;
    }

    public function listarInvestimentosAdmin($id, $filtro){
        global $pdo;
        
        $order = "ASC";

        if($filtro === "valor_cota_maior" || $filtro === "qtd_cota"){
            $order = "DESC";
            $filtro = str_replace("_maior", "", $filtro);
        }else  if($filtro === "valor_cota_menor"){
            $filtro = str_replace("_menor", "", $filtro);            
        }
       
        
        $sql = $pdo->prepare("SELECT * FROM investimentos WHERE id_admin = :id ORDER BY " .$filtro ." " .$order);
        $sql->bindValue(":id", $id); 
        $sql->execute();

        $dados = [];
                
        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll();               
        }

        return $dados;
    }

    public function editarParticipar($id_usuario, $id_investimento, $id_admin){
        global $pdo;  
       
        $relacionamento = new Relacionamento();
        
        $relacionamento->isParticipante($id_usuario, $id_investimento, $id_admin);      
        
        if(!$relacionamento->isParticipante($id_usuario, $id_investimento, $id_admin)){
            
            if(Investimento::getQuantidadeCota($id_investimento) > 0){         

                $sql = $pdo->prepare("INSERT INTO relacionamentos SET  id_usuario = :id_usuario, id_investimento = :id_investimento, id_admin = :id_admin");
                $sql->bindValue(":id_usuario", $id_usuario);
                $sql->bindValue(":id_investimento", $id_investimento);  
                $sql->bindValue(":id_admin", $id_admin); 
                $sql->execute();

                if($sql->rowCount() > 0) {
                    Investimento::diminuiCota($id_investimento);
                    return true;
                }
            }             
        }else{             
            $deletar = $relacionamento->deletaParticipante($id_usuario, $id_investimento, $id_admin);

            if($deletar){
                Investimento::addCota($id_investimento);
                return true; 
            }
                               
        }
        return false;
    }

    public static function getQuantidadeCota($id_investimento){
        global $pdo;

        $sql = $pdo->prepare("SELECT qtd_cota FROM investimentos WHERE id = :id");
        $sql->bindValue(":id", $id_investimento); 
        $sql->execute();
        
        if($sql->rowCount() > 0){            
            return $sql->fetch()['qtd_cota'];
        }
        return 0;
    }

    public static function addCota($id_investimento){
        global $pdo;

        $qtd_cota = Investimento::getQuantidadeCota($id_investimento);
        $qtd_cota = $qtd_cota + 1;

        $sql = $pdo->prepare("UPDATE investimentos SET qtd_cota = :qtd_cota WHERE id = :id");
        $sql->bindValue(":id", $id_investimento); 
        $sql->bindValue(":qtd_cota", $qtd_cota); 
        $sql->execute();
        
        if($sql->rowCount() > 0){            
            return true;
        }
        return false;
    }

    public static function diminuiCota($id_investimento){
        global $pdo;

        $qtd_cota = Investimento::getQuantidadeCota($id_investimento);
        $qtd_cota = $qtd_cota - 1;

        $sql = $pdo->prepare("UPDATE investimentos SET qtd_cota = :qtd_cota WHERE id = :id");
        $sql->bindValue(":id", $id_investimento); 
        $sql->bindValue(":qtd_cota", $qtd_cota); 
        $sql->execute();
        
        if($sql->rowCount() > 0){            
            return true;
        }
        return false;
    }
}