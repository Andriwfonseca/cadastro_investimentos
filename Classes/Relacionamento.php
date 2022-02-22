<?php

class Relacionamento{

    public function isParticipante($id_usuario, $id_investimento, $id_admin){      
        global $pdo;  

        $sql = $pdo->prepare("SELECT id FROM relacionamentos WHERE id_usuario = :id_usuario and id_investimento = :id_investimento and id_admin = :id_admin");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":id_investimento", $id_investimento);  
        $sql->bindValue(":id_admin", $id_admin);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }

        return false;
    }

    public function deletaParticipante($id_usuario, $id_investimento, $id_admin){
        global $pdo;  

        $sql = $pdo->prepare("DELETE FROM relacionamentos WHERE id_usuario = :id_usuario and id_investimento = :id_investimento and id_admin = :id_admin");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":id_investimento", $id_investimento);  
        $sql->bindValue(":id_admin", $id_admin);
        $sql->execute();

        if($sql->rowCount()>0){
            return true;
        }   

        return false;
    }
}