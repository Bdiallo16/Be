<?php
    class FichiersattenduModel extends BaseModel{
        
        private $id;
        private $id_fichier_attendu;
        private $date_remise;
        private $heure_remise;
        private $commentaire_etudiant;
        private $commentaire_enseigant;        
      
        
        public function __construct($info) {
            
            $this->id = $info->id;
            $this->id_fichier_attendu = $info->id_fichier_attendu;
            $this->date_remise = $info->date_remise;
            $this->heure_remise = $info->heure_remise;
            $this->commentaire_etudiant= $info->commentaire_etudiant;
            $this->commentaire_enseigant = $info->commentaire_enseigant;           
                      
        }
        public function getId(){
            return $this->id;
        }
        
        public function getIdfichierAttendu(){
            return $this->id_fichier_attendu;
        }
        
        public function getHeure(){
            return $this->heure_remise;
        }
        
        public function getDate(){
            return $this->date_remise;
        }
        
        public function getCommentaireEtudiant(){
            return $this->commentaire_etudiant;
        }
          public function getCommentaireEnseigant(){
            return $this->commentaire_enseigant;
        }
        public static function findById($idfichier,$idetu) { 
            Load::DAO("fichier");
            return FichierDAO::findByIdandidetu($idfichier,$idetu);
        }
       
        
        
        
    }