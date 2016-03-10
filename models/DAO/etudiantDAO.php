<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EtudiantDAO
 *
 * @author jerome
 */
class EtudiantDAO {
    
    public static function getInfo($id){
            
        $db = DB::Connect();
        $query = "SELECT nom_etu as nom, prenom_etu as prenom FROM ETUDIANTS WHERE id_etu = ".$id;
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $info = $result->fetch();
        return $info;
    }
    
    
    public static function findAll(){
        
        $db = DB::Connect();
            
        if(isset($db)){

            $query = "SELECT id_etu as id, nom_etu as nom, prenom_etu as prenom, tel_etu as tel, email_etu as email FROM ETUDIANTS";

            $result = $db->query($query);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $list = $result->fetchAll();
            $etudiants = array();
            foreach($list as $etudiant){
                array_push($etudiants, new EtudiantsModel($etudiant));
            }

            return $etudiants;


        }

        return array();
        
    }
    
    public static function findById($id){
        $db = DB::Connect();
        if(isset($db)){
            $query = "SELECT id_etu as id, prenom_etu as prenom, nom_etu as nom, 
                        tel_etu as tel, email_etu as email, 
                        login_secu as login, motdepasse_secu as password  
                    FROM ETUDIANTS
                    NATURAL JOIN SECURITE
                    WHERE id_etu = :id";
            $req = $db->prepare($query);
            $req->bindParam(":id",$id,PDO::PARAM_INT);
            $req->execute();

            $etudiant = $req->fetch(PDO::FETCH_OBJ);
            if(!empty($etudiant)){
                return new EtudiantsModel($etudiant);
            }
            return false;
        }
    }
    
}
