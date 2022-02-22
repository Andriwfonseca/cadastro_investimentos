<?php

class Investimento{

    public function cadastrar($descricao, $valor_cota, $percentual, $valor_pagar, $participante, $qtd_cota){
        global $pdo;        
        
        $sql = $pdo->prepare("SELECT id FROM investimentos WHERE descricao = :descricao");
        $sql->bindValue(":descricao", $descricao);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $pdo->prepare("INSERT INTO investimentos SET  descricao = :descricao, valor_cota = :valor_cota,
                                                            percentual = :percentual, valor_pagar = :valor_pagar,
                                                            qtd_cota = :qtd_cota, participante = :participante");
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":valor_cota", $valor_cota);
            $sql->bindValue(":percentual", $percentual);
            $sql->bindValue(":valor_pagar", $valor_pagar);
            $sql->bindValue(":participante", $participante);
            $sql->bindValue(":qtd_cota", $qtd_cota);
           
            $sql->execute();

            return true;
        }else{
            return false;
        }
    }   

    public function listarInvestimentos($filtro, $participante){
        global $pdo;
        
        $order = "ASC";

        if($filtro === "valor_cota_maior" || $filtro === "qtd_cota"){
            $order = "DESC";
            $filtro = str_replace("_maior", "", $filtro);
        }else  if($filtro === "valor_cota_menor"){
            $filtro = str_replace("_menor", "", $filtro);            
        }
       
        
        $sql = $pdo->prepare("SELECT * FROM investimentos WHERE participante = :participante ORDER BY " .$filtro ." " .$order);
        $sql->bindValue(":participante", $participante); 
        $sql->execute();

        $dados = [];
                
        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll();               
        }

        return $dados;
    }
}