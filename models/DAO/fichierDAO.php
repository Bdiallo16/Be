<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fichierDAO
 *
 * @author jerome
 */
class FichierDAO {
    
    // Table
    const TABLE_F_ATTENDU = "FICHIERS_ATTENDUS";
    const TABLE_F_RENDU = "FICHIERS_RENDUS";
    // Colonnes
    // Fichier attendu
    const ID_COL = "id_fichier_attendu";
    const ID_DEV_COL = "id_devoir";
    const RETARD_COL = "permission_retard";
    const HEURE_COL = "heure_limite_depot";
    const DATE_COL = "date_limite_depot";
    const NOM_COL = "libelle_fichier_attendu";
    // Fichier rendu
    const ID_FR_COL = "id_fichier_rendu";
    const ID_FA_COL = "id_fichier_attendu";
    const FICHIER_COL = "fichier";
    const DATE_DEPOT_COL = "date_remise";
    const HEURE_DEPOT_COL = "heure_remise";
    const COMMENT_ETU_COL = "commentaire_etudiant";
    const COMMENT_ENS_COL = "commentaire_enseignant_fichier";
    
    // Alias
    // Fichier attendu
    const ID_ALIAS = "id";
    const ID_DEV_ALIAS = "id_devoir";
    const RETARD_ALIAS = "retard";
    const HEURE_ALIAS = "heure";
    const DATE_ALIAS = "date";
    const NOM_ALIAS = "name";
    // Fichier rendu
         
    const ID_RENDU_ALIAS = "id";
    const ID_RENDU_DEV_ALIAS = "id_fichier_attendu";
    const DATE_RENDU_ALIAS = "date_remise";
    const HEURE_RENDU_ALIAS = "heure_remise";
    const COMMENTAIRE_ETU_ALIAS = "commentaire_etudiant";
    const COMMENTAIRE_ENS_ALIAS = "commentaire_enseigant";
    // TODO
    
    
    
    /**
     * Fonction permettant de trouver un fichier attendu par son ID
     * 
     * @param type $id Id du fichier a trouver
     * @return boolean|\FichiersModel  faux si on ne la pas trouvé, le fichier sinon
     */
    public static function findById($id){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_DEV_COL." as ".self::ID_DEV_ALIAS.", "
                .self::RETARD_COL." as ".self::RETARD_ALIAS.", "
                .self::HEURE_COL. " as ".self::HEURE_ALIAS.", "
                .self::DATE_COL." as ".self::DATE_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE_F_ATTENDU
                ." WHERE ".self::ID_COL." = :id");
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if(!empty($result)){
            return new FichiersModel($result);
        }
        
        return false;
    }
    
    
    /**
     * Permet de récupérer tout les fichiers attendus d'un devoir
     * 
     * @param type $id id du devoir
     * @return array liste des fichiers attendu associé au devoir
     */
    public static function findByDevoir($id){
        
        $db = DB::Connect();
        $query = $db->prepare("SELECT ".self::ID_COL." as ".self::ID_ALIAS.", "
                .self::ID_DEV_COL." as ".self::ID_DEV_ALIAS.", "
                .self::RETARD_COL." as ".self::RETARD_ALIAS.", "
                .self::HEURE_COL. " as ".self::HEURE_ALIAS.", "
                .self::DATE_COL." as ".self::DATE_ALIAS.", "
                .self::NOM_COL." as ".self::NOM_ALIAS
                ." FROM ".self::TABLE_F_ATTENDU
                ." WHERE ".self::ID_DEV_COL." = :id");
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $fichiers = array();
        
        foreach($result as $file){
            array_push($fichiers, new FichiersModel($file));
        }
        
        return $fichiers;
    }
    
    public static function findByIdandidetu($id,$idetudiant){
        
        
        $db = DB::Connect();
        $query = $db->prepare("select distinct fichiers_rendus.id_fichier_rendu as id,fichiers_rendus.id_fichier_attendu as id_fichier_attendu,
        fichiers_rendus.date_remise as date_remise,fichiers_rendus.heure_remise as heure_remise,fichiers_rendus.commentaire_etudiant as commentaire_etudiant,
        fichiers_rendus.commentaire_enseignant_fichier as commentaire_enseigant
        from etudiants,fichiers_attendus,fichiers_rendus,etudiant_rendus,groupes_rendus,groupes,appartenir
        where fichiers_rendus.id_fichier_attendu=fichiers_attendus.id_fichier_attendu
        and groupes_rendus.id_groupe=groupes.id_groupe
        and groupes_rendus.id_fichier_rendu=fichiers_rendus.id_fichier_rendu
        and etudiants.id_etu=appartenir.id_etu
        and groupes.id_groupe=appartenir.id_groupe
        and fichiers_attendus.id_fichier_attendu=:id
        and etudiants.id_etu=:idetu");
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->bindParam(':idetu',$idetudiant,PDO::PARAM_INT);
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        if(!empty($result)){
            return new FichiersattenduModel($result);
        }
        
        return false;
    }
    
    /**
     * Fonction permettant d'ajouter dans la base de donnée un fichier attendu
     * 
     * @param FichiersModel $f fichier attendu à inserer dans la base de donnée
     */
    public static function insert(FichiersModel $f){
        $db = DB::Connect();
        $query = $db->prepare("INSERT INTO ".self::TABLE_F_ATTENDU." ("
                . self::ID_DEV_COL.","
                . self::NOM_COL.","
                . self::DATE_COL.","
                . self::HEURE_COL.","
                . self::RETARD_COL. ") VALUES ( :id_devoir ,"
                                            . " :name ,"
                                            . " :date ,"
                                            . " :heure,"
                                            . " :retard )");
        try{
            $query->bindValue(":id_devoir",$f->getIdDevoir(),PDO::PARAM_INT);
            $query->bindValue(":name",$f->getName(),PDO::PARAM_STR);
            $query->bindValue(":date",$f->getDate(),PDO::PARAM_STR);
            $query->bindValue(":heure",$f->getHeure(),PDO::PARAM_STR);
            $query->bindValue(":retard",$f->acceptRetard(),PDO::PARAM_BOOL);
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
     * Fonction permettant de mettre a jour les informations d'un fichier attendu
     * 
     * @param FichiersModel $f le fichier attendu a mettre a jour
     */
    public static function update(FichiersModel $f){
        
        $db = DB::Connect();
        $query = $db->prepare("UPDATE ".self::TABLE_F_ATTENDU." SET "
                . self::NOM_COL." = :name,"
                . self::DATE_COL." = :date,"
                . self::HEURE_COL." = :heure,"
                . self::RETARD_COL." = :retard "
                ." WHERE ".self::ID_COL." = :id");
        
        try{
            $query->bindValue(":id",$f->getId(),PDO::PARAM_INT);
            $query->bindValue(":name",$f->getName(),PDO::PARAM_STR);
            $query->bindValue(":date",$f->getDate(),PDO::PARAM_STR);
            $query->bindValue(":heure",$f->getHeure(),PDO::PARAM_STR);
            $query->bindValue(":retard",$f->acceptRetard(),PDO::PARAM_BOOL);
            
            $db->beginTransaction();
            $query->execute();
            $db->commit();
            
        }catch(PDOException $e){
            $db->rollback();
            DB::setError($e->getMessage());
            return false;
        }
        
        
        return self::findById($f->getId());
            
    }
    
    
    
}
