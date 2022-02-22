<?php
require('../partials/header.php');
require '../Classes/Investimento.php';

if(!isset($_SESSION['cLogin'])){
    header("location: ./login.php");
}
if($_SESSION['cAdmin'] == 0){
    header("location: ./investimentos.php");
}   

$investimento = new Investimento();

if(isset($_POST['descricao'])){

    $descricao = filter_input(INPUT_POST, 'descricao');    
    $valor_cota = filter_input(INPUT_POST, 'valor_cota');
    $qtd_cota = filter_input(INPUT_POST, 'qtd_cota');
    $percentual = filter_input(INPUT_POST, 'percentual');

    $participante = 0;    
    $valor_total = $valor_cota * $qtd_cota;
    $valor_pagar = $valor_total * ($percentual / 100);
    

    if($descricao && $valor_cota && $percentual && $qtd_cota){
        if ($investimento->cadastrar($descricao, $valor_cota, $percentual, $valor_pagar, $participante, $qtd_cota)){
            ?>
            <div class="alert alert-success">
                <strong>Parabéns!</strong> Investimento cadastrado com sucesso. <a href="investimentos.php" class="alert-link">Verifique na página de consultas</a>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-warning">
            Esse investimento já existe!
            <a href="investimentos.php" class="alert-link">Verifique na página de consultas</a>
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
    <h1>Cadastro de investimentos</h1>
    <div id="resultado"></div>
    <form method="POST" enctype="multipart/form-data" id="form-registro-ponto">

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" class="form-control" />
        </div>
        <div class="form-group">
            <label for="titulo">Valor cota:</label>
            <input type="text" name="valor_cota" id="valor" class="form-control" />
        </div>
        <div class="form-group">
            <label for="titulo">Quantidade cota:</label>
            <input type="text" name="qtd_cota" id="qtd_cota" class="form-control" />
        </div>
        <div class="form-group">
            <label for="valor">Percentual de rentabilidade:</label>
            <input type="text" name="percentual" id="percentual" class="form-control" />
        </div>
        <br>
        <input type="submit" value="Registrar" class="btn btn-primary" />       
    </form>

</div>
<?php require('../partials/footer.php'); ?>