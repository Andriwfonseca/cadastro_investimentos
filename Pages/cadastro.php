<?php require('../partials/header.php'); ?>

<?php
    require '../Classes/Usuario.php';

    $user = new Usuario();

    if(isset($_POST['nome'])){

        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');
        $telefone = filter_input(INPUT_POST, 'telefone');
        $estado = filter_input(INPUT_POST, 'estado');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $rua = filter_input(INPUT_POST, 'rua');
        $numero = filter_input(INPUT_POST, 'numero');
      

        if($nome && $email && $senha && $telefone && $estado && $cidade && $bairro && $rua && $numero){
            if ($user->cadastrar($nome,$email,$senha,$telefone,$estado, $cidade, $bairro, $rua, $numero)){
                ?>
                <div class="alert alert-success">
                    <strong>Parabéns!</strong> Cadastrado com sucesso. <a href="login.php" class="alert-link">Faça o login agora</a>
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-warning">
                Esse usuário já existe!
                <a href="login.php" class="alert-link">Faça o login agora</a>
                </div>
                <?php
            }

        }else{
            ?>
            <div class="alert alert-warning">
                Preencha todos os campos!
            </div>
            <?php
        }
    }
    ?>

<div class="container max-width-800">
    <h1>Cadastre-se</h1>

   
    <form method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" />
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" />
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" />
        </div>
        <div class="form-group">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" />
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" class="form-control" />
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" class="form-control" />
        </div>
        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" class="form-control" />
        </div>
        <div class="form-group">
            <label for="rua">Rua:</label>
            <input type="text" name="rua" id="rua" class="form-control" />
        </div>
        <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" name="numero" id="numero" class="form-control" />
        </div>

        <input type="submit" value="Cadastrar" class="btn btn-primary mt-2" />
    </form>
</div>
<?php require('../partials/footer.php'); ?>