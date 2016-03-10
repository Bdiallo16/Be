<?php

class noteDAO {
    
    public static function findByIdmatiere($idmatiere, $idetu, $groupe) {
        $db = DB::Connect();
        if ($groupe == 1) {
              
            $query = $db->prepare("select note_groupes.note_groupe as notegroupe,groupes.id_groupe as idgroupe,
            devoirs.id_devoir as iddevoir,note_groupes.commentaire_enseignant_groupe as notecommentaire   
        from note_groupes,groupes,devoirs,etudiants,appartenir,matieres  
        where note_groupes.DEVOIRS_idDevoir=devoirs.id_devoir
        and note_groupes.GROUPES_id_groupe=groupes.id_groupe
        and etudiants.id_etu=appartenir.id_etu
        and groupes.id_groupe=appartenir.id_groupe        
        and devoirs.id_matiere=matieres.id_matiere
        and etudiants.id_etu=:idetu
        and matieres.id_matiere=idmatiere;");
            $query->bindParam(':idmatiere', $idmatiere, PDO::PARAM_INT);
            $query->bindParam(':idetu', $idetu, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetchall(PDO::FETCH_OBJ);
            $devoirsnote=array();
            foreach($result as $note){
            array_push($devoirsnote, new noteModel($note));
          } 
         }else 
                {      
            $query = $db->prepare("select note_etudiant.note_etudiant as noteetudiant,note_etudiant.id_etu as idetudiant
            ,note_etudiant.id_devoir as iddevvoir,note_etudiant.commentaire_enseignant_etudiant as notecommentaire
            from note_etudiant,etudiants,devoirs,etudiants,appartenir,matieres 
            where devoirs.id_devoir=note_etudiants.id_devoir
            and etudiants.id_etu=note_etudiants.id_etu 
            and devoirs.id_matiere=matieres.id_matiere
            and etudiants.id_etu=:idetu
            and matieres.id_matiere=:idmatiere;");
            $query->bindParam(':idmatiere', $idmatiere, PDO::PARAM_INT);
            $query->bindParam(':idetu', $idetu, PDO::PARAM_INT);        
            $query->execute();
            $result = $query->fetchall(PDO::FETCH_OBJ);
            $devoirsnote=array();
            foreach($result as $note){
            array_push($devoirsnote, new noteModel($note));
            }
        }
        return false;
    }

    public static function findByIddevoir($iddevoir, $idetu, $groupe) {

        $db = DB::Connect();
        if ($groupe == 1) {
            $query = $db->prepare("select note_groupes.note_groupe as notegroupe,groupes.id_groupe as idgroupe,
        devoirs.id_devoir as iddevoir,note_groupes.commentaire_enseignant_groupe as notecommentaire  
        from note_groupes,groupes,devoirs,etudiants,appartenir,matieres 
        where note_groupes.DEVOIRS_idDevoir=devoirs.id_devoir
        and note_groupes.GROUPES_id_groupe=groupes.id_groupe
        and etudiants.id_etu=appartenir.id_etu
        and groupes.id_groupe=appartenir.id_groupe
        and etudiants.id_etu=:idetu
        and devoirs.id_devoir=:iddevoir;");
            $query->bindParam(':iddevoir', $iddevoir, PDO::PARAM_INT);
            $query->bindParam(':idetu', $idetu, PDO::PARAM_INT);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_OBJ);
            if (!empty($result)) {
            return new noteModel($result,1);  
        }        
            }else 
                {
            $query = $db->prepare("select note_etudiants.note_etudiant as noteetudiant,note_etudiants.id_etu as idetudiant
            ,note_etudiants.id_devoir as iddevvoir,note_etudiants.commentaire_enseignant_etudiant as notecommentaire
            from note_etudiants,etudiants,devoirs,appartenir 
            where devoirs.id_devoir=note_etudiants.id_devoir
            and etudiants.id_etu=note_etudiants.id_etu 
            and note_etudiants.id_etu=:idetu and note_etudiants.id_devoir=:iddevoir;");
            $query->bindParam(':iddevoir', $iddevoir, PDO::PARAM_INT);
            $query->bindParam(':idetu', $idetu, PDO::PARAM_INT);        
            $query->execute();
            $result2 = $query->fetch(PDO::FETCH_OBJ);
            if (!empty($result2)) {
            return new noteModel($result2,0);
            }
        }
        return false;
    }

}
