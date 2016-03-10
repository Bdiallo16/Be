<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formationDAO
 *
 * @author jerome
 */
class FormationDAO {
    
    // Table
    const TABLE = "FORMATIONS";
    // Colonnes
    const ID_COL = "id_formation";
    const ID_RESP_COL = "id_responsable";
    const ANNEE_COL = "annee_formation";
    const NOM_COL = "libelle_formation";
    // Alias
    const ID_ALIAS = "id";
    const ID_RESP_ALIAS = "id_resp";
    const ANNEE_ALIAS = "annee";
    const NOM_ALIAS = "name";
    
    
    public static function findById($id_formation){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ANNEE_COL." as ".self::ANNEE_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE
                ." WHERE ".self::ID_COL." = :id");
        $query->bindParam(':id',$id_formation,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if(!empty($result)){
            return new FormationsModel($result);
        }
        return false;
    }
    
    
    public static function findByEtudiant($id_etu){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT F.".self::ID_COL." as ".self::ID_ALIAS.", "
                ."F.".self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                ."F.".self::ANNEE_COL." as ".self::ANNEE_ALIAS.", "
                ."F.".self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE." F"
                ." JOIN ETUDIANT_FORMATION E ON F.".self::ID_COL." = E.".self::ID_COL
                ." WHERE id_etu = :id"
                ." ORDER BY ".self::ANNEE_COL." DESC");
        $query->bindParam(':id',$id_etu,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $formations = array();
        foreach($result as $f){
            array_push($formations, new FormationsModel($f));
        }
        return $formations;
        
    }
    public static function findByEtudiantasc($id_etu){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT F.".self::ID_COL." as ".self::ID_ALIAS.", "
                ."F.".self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                ."F.".self::ID_ANNEE_COL." as ".self::ID_ANNEE_ALIAS.", "
                ."F.".self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE." F"
                ." JOIN ETUDIANT_FORMATION E ON F.".self::ID_COL." = E.".self::ID_COL
                ." WHERE id_etu = :id"
                ." ORDER BY ".self::ID_ANNEE_COL." ASC");
               
        $query->bindParam(':id',$id_etu,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $formations = array();
        foreach($result as $f){
            array_push($formations, new FormationsModel($f));
        }
        return $formations;
        
    }
    
    public static function findAll(){
        $db = DB::Connect();
        $result = $db->query("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ANNEE_COL." as ".self::ANNEE_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE
                ." ORDER BY ".self::ANNEE_COL." DESC");
        $result->setFetchMode(PDO::FETCH_OBJ);
        $list = $result->fetchAll();
        $formations = array();
        foreach($list as $f){
            array_push($formations, new FormationsModel($f));
        }
        return $formations;
    }
    
}
