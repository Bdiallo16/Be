<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnseignantDAO
 *
 * @author jerome
 */
class EnseignantDAO {
    
    public static function getInfo($id){
        $db = DB::Connect();
        $query = "SELECT nom_enseignant as nom, prenom_enseignant as prenom FROM ENSEIGNANTS WHERE id_enseignant = ".$id;
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $info = $result->fetch();
        return $info;
    }
    
    public static function findAll(){
        $db = DB::Connect();
            
        if(isset($db)){

            $query = "SELECT id_enseignant as id, nom_enseignant as nom, prenom_enseignant as prenom, tel_enseignant as tel, email_enseignant as email FROM ENSEIGNANTS";

            $result = $db->query($query);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $list = $result->fetchAll();

            $enseignants = array();
            foreach($list as $enseignant){
                array_push($enseignants, new EnseignantsModel($enseignant));
            }
            return $enseignants;
        }
        
        return array();
    }
    
    public static function findById($id){
        $db = DB::Connect();
        if(isset($db)){
            $query = "SELECT id_enseignant as id, prenom_enseignant as prenom, nom_enseignant as nom, 
                        tel_enseignant as tel, email_enseignant as email, 
                        login_secu as login, motdepasse_secu as password  
                    FROM ENSEIGNANTS
                    NATURAL JOIN SECURITE
                    WHERE id_enseignant = :id";
            $req = $db->prepare($query);
            $req->bindParam(":id",$id,PDO::PARAM_INT);
            $req->execute();

            $enseignant = $req->fetch(PDO::FETCH_OBJ);
            if(!empty($enseignant)){
                return new EnseignantsModel($enseignant);
            }
            return false;
        }
    }
    
    
    
}
