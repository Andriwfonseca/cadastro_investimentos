<?php require('../partials/header.php');
require '../Classes/Investimento.php';
require '../Classes/Relacionamento.php';

if(!isset($_SESSION['cLogin'])){
    header("location: ./login.php");
}    

$investimento = new Investimento();
$relacionamento = new Relacionamento(); 

if (isset($_GET['ja-participante']) && !empty($_GET['ja-participante'])){
    $ja_participante = addslashes($_GET['ja-participante']);
}else{
    $ja_participante = "0";
}
if (isset($_GET['nao-participante']) && !empty($_GET['nao-participante'])){
    $nao_participante = addslashes($_GET['nao-participante']);
}else{
    $nao_participante = "0";
}
if (isset($_GET['ordem']) && !empty($_GET['ordem'])){
    $filtro = addslashes($_GET['ordem']);
}else{
    $filtro = "id";    
}
/*estado inicial do checkbox*/
if (!isset($_GET['ordem'])){
    $nao_participante = "on";
    $ja_participante = "on";
}
$dados = [];

if($_SESSION['cAdmin'] == 1){
    $dados = $investimento->listarInvestimentosAdmin($_SESSION['cLogin'], $filtro);
}else{
    $dados = $investimento->listarInvestimentos($_SESSION['cLogin'], $filtro, $ja_participante, $nao_participante);
}

?>
<div class="container max-width-800">
    
    <form method="GET">
    <label for="filtro">Filtrar</label>
        <select name="ordem">
            <option value=""></option>
            <option value="descricao" <?= ($filtro == 'descricao') ? 'selected' : '' ?>>Por descrição</option>
            <option value="valor_cota_menor" <?= ($filtro == 'valor_cota_menor') ? 'selected' : '' ?>>Menor valor cota</option>
            <option value="valor_cota_maior" <?= ($filtro == 'valor_cota_maior') ? 'selected' : '' ?>>Maior valor cota</option>
            <option value="qtd_cota" <?= ($filtro == 'qtd_cota') ? 'selected' : '' ?>>Quantidade cota</option>
        </select>
        <?php if ($_SESSION['cAdmin'] == 0): ?>
            <input type="checkbox" id="nao-participante" name="nao-participante"  class="ml-2" <?= ($nao_participante == 'on') ? 'checked' : '' ?>>
            <label for="nao-participante">Não participante</label>
            <input type="checkbox" id="ja-participante" name="ja-participante" <?= ($ja_participante == 'on') ? 'checked' : '' ?>>
            <label for="ja-participante">Já participante</label>
        <?php endif; ?>
        <input type="submit" class="btn btn-primary" value="Filtrar" />   
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Valor Cota</th>
                <th scope="col">Quantidade Cota</th>
                <th scope="col">Valor a pagar</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
        <?php for($x = 0;$x < count($dados);$x++): ?>       
            <tr class="tabela">                
                <td><?= $x + 1; ?></td>
                <td><?= $dados[$x]['descricao'] ?></td>
                <td>R$ <?= $dados[$x]['valor_cota'] * $dados[$x]['qtd_cota'] ?></td>
                <td>R$ <?= $dados[$x]['valor_cota'] ?></td>
                <td><?= $dados[$x]['qtd_cota'] ?></td>
                <td>R$ <?= $dados[$x]['valor_cota'] * ($dados[$x]['percentual'] / 100) ?></td>               
                <td>   
                    <?php if ($_SESSION['cAdmin'] == 0): ?>                    
                        <button class="btn btn-light border-1"                        
                        <?= (Investimento::getQuantidadeCota($dados[$x]['id']) <= 0 && !$relacionamento->isParticipante($_SESSION['cLogin'], $dados[$x]['id'], $dados[$x]['id_admin'])) ? 'disabled' : '' ?>
                        onclick="editarParticipar(<?= $_SESSION['cLogin']?>, <?= $dados[$x]['id'] ?>, <?= $dados[$x]['id_admin'] ?>)" >
                        <p><input disabled type="checkbox" name="participante" <?php echo ($relacionamento->isParticipante($_SESSION['cLogin'], $dados[$x]['id'], $dados[$x]['id_admin'])) ? "checked" : ""; ?>> 
                        Participar</p>                                        
                        </button>  
                    <?php endif; ?>

                    <?php if ($_SESSION['cAdmin'] == 1): ?>                    
                        <button class="btn btn-light border-1" onclick="listarParticipantes(<?= $dados[$x]['id'] ?>)" >
                        <p>Participantes</p>                                       
                        </button>  
                        <?php endif; ?>
                </td>               
            </tr>   
        <?php endfor; ?>
        </tbody>
    </table>
</div>
<?php require('../partials/footer.php'); ?>