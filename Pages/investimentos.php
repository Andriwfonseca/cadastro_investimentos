<?php require('../partials/header.php');
require '../Classes/Investimento.php';

if(!isset($_SESSION['cLogin'])){
    header("location: ./login.php");
}    

$investimento = new Investimento();

if (isset($_GET['ordem']) && !empty($_GET['ordem'])){
    $filtro = addslashes($_GET['ordem']);
}else{
    $filtro = "id";
}
if (isset($_GET['participante']) && !empty($_GET['participante'])){
    $participante = addslashes($_GET['participante']);
}else{
    $participante = "0";
}

$dados = $investimento->listarInvestimentos($filtro, $participante);


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
        <input type="radio" id="Não participante" name="participante" value="0" class="ml-2" <?= ($participante == 0) ? 'checked' : '' ?>>
        <label for="Não participante">Não participante</label>
        <input type="radio" id="Já participante" name="participante" value="1" <?= ($participante == 1) ? 'checked' : '' ?>>
        <label for="Já participante">Já participante</label>
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
                    <!-- ?<?= $dados[$x]['id'] ?>&participante=<?= ($dados[$x]['participante'] == 0) ? '1' : '0'  ?> -->
                    <button class="btn btn-light border-1" onclick="editarParticipar()" >
                    <p><input disabled type="checkbox" name="participante" value="<?= $dados[$x]['participante'] ?>"> 
                     Participar                                          
                    </form>               
                </td>               
            </tr>   
        <?php endfor; ?>
        </tbody>
    </table>
</div>
<script>
function editarParticipar(){
    alert('Enviar uma requisição post para a pagina editar_participar.php');
}
</script>