<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of devoirsDAO
 *
 * @author jerome
 */
class DevoirsDAO {
    
    // Table
    const TABLE = "DEVOIRS";
    // Colonnes
    const ID_COL = "id_devoir";
    const ID_MAT_COL = "id_matiere";
    const ID_RESP_COL = "id_responsable";
    const GROUPE_COL = "estEnGroupe";
    const NOM_COL = "libelle_devoir";
    // Alias
    const ID_ALIAS = "id";
    const ID_RESP_ALIAS = "id_resp";
    const ID_MAT_ALIAS = "id_matiere";
    const GROUPE_ALIAS = "groupe";
    const NOM_ALIAS = "name";
    
    public static function findByMatiere($id){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_MAT_COL ." as ".self::ID_MAT_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::GROUPE_COL." as ".self::GROUPE_ALIAS.", "
                .self::NOM_COL. " as ".self::NOM_ALIAS
                ." FROM ".self::TABLE
                ." WHERE ".self::ID_MAT_COL." = :id");
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        
        $devoirs = array();
        
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($result as $devoir){
            array_push($devoirs, new DevoirsModel($devoir));
        }
        return $devoirs;
    }
    
    public static function findById($id){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_MAT_COL ." as ".self::ID_MAT_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::GROUPE_COL." as ".self::GROUPE_ALIAS.", "
                .self::NOM_COL. " as ".self::NOM_ALIAS
                ." FROM ".self::TABLE
                ." WHERE ".self::ID_COL." = :id");
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if(!empty($result)){
            return new DevoirsModel($result);
        }
        
        return false;
    }
    
    /**
     * Fonction permettant d'inserer un devoir dans la base de données
     * 
     * @param DevoirsModel $d devoir à inserer
     * @return boolean|/DevoirsModel renvoie le devoir créé si ok, faux sinon
     */
    public static function insert(DevoirsModel $d){
        
        $db = DB::Connect();
        $query = $db->prepare("INSERT INTO ".self::TABLE." ("
                . self::ID_MAT_COL.","
                . self::ID_RESP_COL.","
                . self::NOM_COL.","
                . self::GROUPE_COL.") VALUES ( :id_matiere ,"
                                            . " :id_resp ,"
                                            . " :name ,"
                                            . " :groupe)");
        try{
            $query->bindValue(":id_matiere",$d->getIdMat(),PDO::PARAM_INT);
            $query->bindValue(":id_resp",$d->getResp(),PDO::PARAM_INT);
            $query->bindValue(":name",$d->getName(),PDO::PARAM_STR);
            $query->bindValue(":groupe",$d->enGroupe(),PDO::PARAM_BOOL);
            $db->beginTransaction();
            $query->execute();
            $db->commit();
        }catch(PDOException $e){
            DB::setError($e->getMessage());
            $db->rollback();
            return false;
        }
        
        $id = $db->lastInsertId();
        
        return self::findById($id);
        
    }
    
    /**
     * Met a jour la base de données
     * @param DevoirsModel $d
     * @return boolean
     */
    public static function update(DevoirsModel $d){
        
        $db = DB::Connect();
        $query = $db->prepare("UPDATE ".self::TABLE." SET "
                . self::NOM_COL." = :name,"
                . self::GROUPE_COL." = :groupe,"
                ." WHERE ".self::ID_COL." = :id");
        
        try{
            $query->bindValue(":id",$d->getId(),PDO::PARAM_INT);
            $query->bindValue(":name",$d->getName(),PDO::PARAM_STR);
            $query->bindValue(":groupe",$d->enGroupe(),PDO::PARAM_BOOL);
            
            $db->beginTransaction();
            $query->execute();
            $db->commit();
            
        }catch(PDOException $e){
            $db->rollback();
            DB::setError($e->getMessage());
            return false;
        }
        
        
        return self::findById($d->getId());
        
    }
    
}
