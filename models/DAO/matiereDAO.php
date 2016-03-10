<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatiereDAO
 *
 * @author jerome
 */
class MatiereDAO {
    
  
    // Table
    const TABLE = "MATIERES";
    // Colonnes
    const ID_COL = "id_matiere";
    const ID_RESP_COL = "id_responsable";
    const ID_FORM_COL = "id_formation";
    const NOM_COL = "libelle_matiere";
    // Alias
    const ID_ALIAS = "id";
    const ID_RESP_ALIAS = "id_resp";
    const ID_FORM_ALIAS = "id_form";
    const NOM_ALIAS = "name";
    
    
    /**
     * Permet de récupérer toute les matières auquel est associé l'enseignant
     * 
     * @param type $id_ens identifiant de l'enseignant
     * @return array toute les matieres auquel est associé l'enseignant
     */
    public static function findByEnseignant($id_ens){
        
        $db = DB::Connect();
        
        $query = $db->prepare("
                SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ID_FORM_COL." as ".self::ID_FORM_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS."
                FROM ".self::TABLE." M
                WHERE M.".self::ID_RESP_COL." = :id
                UNION
                SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ID_FORM_COL." as ".self::ID_FORM_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS."
                FROM ".self::TABLE." M2
                WHERE ".self::ID_COL." in (SELECT ".self::ID_COL." FROM DEVOIRS WHERE ".self::ID_RESP_COL." = :id)
                UNION
                SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ID_FORM_COL." as ".self::ID_FORM_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS."
                FROM ".self::TABLE." M3
                WHERE ".self::ID_COL." in (SELECT ".self::ID_COL."
                                       FROM DEVOIRS 
                                       WHERE id_devoir in ( SELECT id_devoir 
                                                            FROM ASSOCIE 
                                                            WHERE id_enseignant = :id ))");
        
        $query->bindParam(':id',  $id_ens,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $matieres = array();
        foreach($result as $matiere){
            array_push($matieres, new MatieresModel($matiere));
        }
        return $matieres;
    }
    
    /**
     * 
     * Permet de récupérer une matiere par son identifiant
     * 
     * @param type $id id recherché
     * @return \MatieresModel|boolean la matiere correspondant à l'id, faux sinon non trouvé
     */
    public static function findById($id){
        
        $db = DB::Connect();
        $query = $db->prepare(""
                ."SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ID_FORM_COL." as ".self::ID_FORM_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS."
                FROM ".self::TABLE." M
                WHERE M.".self::ID_COL." = :id");
        
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if(!empty($result)){
            return new MatieresModel($result);
        }
        return false;
    }
    
    
    /**
     * 
     * Permet de récupérer toute les matieres de la formation
     * 
     * @param type $id id de la formation
     * @return array liste des matieres associées à la formation
     */
    public static function findByFormation($id){
        
        $db = DB::Connect();
        $query = $db->prepare(""
                ."SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_RESP_COL." as ".self::ID_RESP_ALIAS.", "
                .self::ID_FORM_COL." as ".self::ID_FORM_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS."
                FROM ".self::TABLE." M
                WHERE ".self::ID_FORM_COL." = :id");     
        
        
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $matiere=array();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($result as $r){
            array_push($matiere, new MatieresModel($r));
        }
        return $matiere;
    }
    
    /**
     * Fonction permettant d'inserer une matiere dans la base de données
     * 
     * @param MatieresModel $m la matiere à inserer
     */
    public static function insert(MatieresModel $m){
        
        $db = DB::Connect();
        $query = $db->prepare("INSERT INTO ".self::TABLE." ("
                . self::ID_FORM_COL.","
                . self::ID_RESP_COL.","
                . self::NOM_COL. ") VALUES ( :id_form,"
                . " :id_resp,"
                . " :nom )");
        
        try{
            $db->beginTransaction();
            $query->bindValue(":id_form",$m->getIdFormation(),PDO::PARAM_INT);
            $query->bindValue(":id_resp",$m->getIdResponsable(),PDO::PARAM_INT);
            $query->bindValue(":nom",$m->getName(),PDO::PARAM_STR);
            $query->execute();
            $db->commit();
        }catch(PDOException $e){
            
            $db->rollback();
            DB::setError($e->getMessage());
            return false;
        }
        
        $id = $db->lastInsertId();
        return self::findById($id);
        
    }
    
    /**
     * Fonction permettant de modifier une matiere dans la base de données
     * 
     * @param MatieresModel $m la matière à mettre à jour
     */
    public static function update(MatieresModel $m){
        
        $db = DB::Connect();
        $query = $db->prepare("UPDATE ".self::TABLE." SET "
                . self::NOM_COL ." = :nom "
                . " WHERE ".self::ID_COL." = :id ");
        
        try{
            
            $query->bindValue(":nom",$m->getName(),PDO::PARAM_STR);
            $query->bindValue(":id",$m->getId(),PDO::PARAM_INT);
            $db->beginTransaction();
            $query->execute();
            $db->commit();
            
        }catch(PDOException $e){
            $db->rollback();
            DB::setError($e->getMessage());
            return false;
        }
        
        return self::findById($m->getId());
        
    }
    

}
