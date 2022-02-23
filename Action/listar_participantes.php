<?php
require '../config.php'; 
require '../Classes/Usuario.php';

if(!isset($_SESSION['cLogin'])){
    echo 'não logado';    
    exit;
}   
if(!isset($_SESSION['cAdmin'])){
    echo 'não é admin';    
    exit;
}

$retorno = [];

$id_investimento = filter_input(INPUT_POST, 'id_investimento');

$usuario = new Usuario();

if($id_investimento){    
    $retorno = $usuario->listarParticipantes($id_investimento);  
}
echo json_encode($retorno);
