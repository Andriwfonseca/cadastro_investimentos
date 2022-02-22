<?php
require '../config.php'; 
require '../Classes/Investimento.php';
require '../Classes/Relacionamento.php';

if(!isset($_SESSION['cLogin'])){
    echo 'não logado';    
    exit;
}   

$retorno = '';

$id_usuario = filter_input(INPUT_POST, 'id');
$id_investimento = filter_input(INPUT_POST, 'id_investimento');
$id_admin = filter_input(INPUT_POST, 'id_admin');

$investimento = new Investimento();

if($id_usuario && $id_investimento && $id_admin){
    $investimento->editarParticipar($id_usuario, $id_investimento, $id_admin);
    if($investimento){
        $retorno = 'ok';
    }else{
        $retorno = "erro";
    }
    
}

echo $retorno;