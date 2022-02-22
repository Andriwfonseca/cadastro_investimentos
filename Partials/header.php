<?php require '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Investimento</title>
</head>
<body class="">
    <div class="container header">
        <ul>
            <?php if(isset($_SESSION['cAdmin']) && $_SESSION['cAdmin'] == 1): ?>

                <a href="../Pages/cadastro_investimentos.php"><li>Cadastrar investimentos</li></a>

            <?php endif; ?>
            <a href="../Pages/investimentos.php"><li>Consulta</li></a>
            <a href="../Pages/perfil.php"><li>Perfil</li></a>
            <a href="../Pages/cadastro.php"><li>Criar conta</li></a>
            <a href="../sair.php"><li>Sair</li></a>
        </ul>
    </div>

<?php
