<?php require('../partials/header.php'); ?>
<div class="container max-width-800">
    <h1>Login</h1>

    <?php
    require '../Classes/Usuario.php';

    $user = new Usuario();

    if(isset($_POST['email'])){

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');

        if($email && $senha){
           if($user->login($email, $senha)){
            ?>
            <script type="text/javascript">window.location.href="./investimentos.php";</script>
            <?php
           }else{
               ?>
                <div class="text-center alert alert-danger">
                Usuário e/ou Senha errados!
                </div>
            <?php
            }
        }else{
            ?>
            <div class="text-center alert alert-warning">
                Preencha todos os campos!
            </div>
            <?php
        }
    }
    ?>

    <form method="post">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" />
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" />
        </div>
        <input type="submit" value="Fazer Login" class="btn btn-primary mt-2" />
    </form>
</div>
<?php require('../partials/footer.php'); ?>