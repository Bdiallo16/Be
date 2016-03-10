<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDAO
 *
 */
class UserDAO {
    
    const ADMIN = 'Administrateur';
    const ETUDIANT = 'Etudiants';
    const ENSEIGNANT = 'Enseignants';
    
    public static function connection($login, $password){
        
        $bdd = DB::Connect();

	        
          
        $req = $bdd->prepare("SELECT ETU.id_etu as id_etu, ENS.id_enseignant as id_ens, ADMIN.id_admin as id_admin, PROFIL.libelle_profil as privilege
                    FROM SECURITE
                    NATURAL JOIN PROFIL
                    LEFT OUTER JOIN ETUDIANTS ETU ON SECURITE.id_secu = ETU.id_secu
                    LEFT OUTER JOIN ENSEIGNANTS ENS ON SECURITE.id_secu = ENS.id_secu
                    LEFT OUTER JOIN ADMINISTRATEUR ADMIN ON SECURITE.id_secu = ADMIN.id_secu
                    WHERE login_secu = :login AND motdepasse_secu = :pass");
        
        $req->bindParam(':login', $login, PDO::PARAM_STR);
        //$req->bindValue(':pass', sha1($pass), PDO::PARAM_STR);
        $req->bindParam(':pass', $password, PDO::PARAM_STR);
        $req->execute();
        $rep = $req->fetch(PDO::FETCH_OBJ);

        if(!empty($rep)){

            if($rep->privilege == self::ADMIN){
                return new AdminModel($rep,true);
            }else if($rep->privilege == self::ENSEIGNANT){
                return new EnseignantsModel($rep,true);
            }else if($rep->privilege == self::ETUDIANT){
                return new EtudiantsModel($rep,true);
            }
            return false;

        }else{
            return false;
        }
        
    }
    
    public static function getAdminInfo($id)
    {
        $db = DB::Connect();
        $query = "SELECT nom_admin as nom, prenom_admin as prenom FROM ADMINISTRATEUR WHERE id_admin = ".$id;
        $result = $db->query($query);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $info = $result->fetch();
        return $info;
    }   
    
    
}
