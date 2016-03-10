<?php

/**
 * Classe représentant un fichier attendu
 */
    class FichiersModel extends BaseModel{
        
        private $id;
        private $id_devoir;
        private $heure_limite;
        private $date_limite;
        private $retard;
        private $name;        
        private $file;
        
        /**
         * Constructeur de la classe
         * @param type $info
         */
        public function __construct($info = null) {
            if(isset($info)){
                $this->id = $info->id;
                $this->id_devoir = $info->id_devoir;
                $this->heure_limite = $info->heure;
                $this->date_limite = $info->date;
                $this->retard = (isset($info->retard)? $info->retard : true); // Retard autorisé par défaut
                $this->name = $info->name;
            }
        }
        

        /**
         * Fonction permettant de récupérer tout les fichiers attendu du devoir
         * 
         * @param type $id_devoir
         * @return type
         */
        public static function findAll($id_devoir) {
            Load::DAO("fichier");
            return FichierDAO::findByDevoir($id_devoir);
        }

        /**
         * Permet de récupérer un fichier selon son id
         * 
         * @param type $id
         * @return type
         */
        public static function findById($id) {
            Load::DAO("fichier");
            return FichierDAO::findById($id);
        }

        /**
         * Permet de sauvegarder le fichier attendu dans la base de donnée
         */
        public function create(){
            Load::DAO("fichier");
            return FichierDAO::insert($this);
        }
        
        /**
         * Permet de mettre à jour le fichier dans la base de donnée
         */
        public function save(){
            return FichierDAO::update($this);
        }
        
        // Getter & Setter
        
        /**
         * Obtenir id
         * @return type
         */
        public function getId(){
            return $this->id;
        }
        
        /**
         * Obtenir id du devoir associé
         * @return type
         */
        public function getIdDevoir(){
            return $this->id_devoir;
        }
        
        /**
         * Obtenir l'heure limite de dépot
         * @return type
         */
        public function getHeure(){
            return $this->heure_limite;
        }
        
        /**
         * Obtenir la date limite de dépot
         * @param type $format
         * @return type
         */
        public function getDate($format = null){
            
            try{
            $date = new DateTime($this->date_limite);
            }catch(Exception $e){
                return $this->date_limite;
            }
            if(isset($format)){
                return $date->format($format);
            }
            return $date->format("d-m-Y");
            
        }
        
        /**
         * Modifier le retard possible
         * et Connaitre sa valeur
         * @param type $b
         * @return type
         */
        public function acceptRetard($b = null){
            if(isset($b)){ // SET
                $this->retard = boolval($b);
            }else{ // GET
                return boolval($this->retard);
            }
        }
        
        /**
         * Obtenir le nom
         * @return type
         */
        public function getName(){
            return $this->name;
        }

        
        /**
         * Modifie l'id du devoir associé
         * @param type $id
         */
        public function setIdDevoir($id){
            $this->id_devoir = $id;
        }
        
        /**
         * Modifie le nom
         * @param type $name
         */
        public function setName($name){
            $this->name = $name;
        }
        
        /**
         * Modifie la date
         * @param type $d
         */
        public function setDate($d){
            $this->date_limite = $d;
        }
        
        /**
         * Modifie l'heure
         * @param type $h
         */
        public function setHeure($h){
            $this->heure_limite = $h;
        }
        
        
        public function getStatutTravaux($idfichier){
            $statut="Remis pour évaluation";    
           
            return $statut;
        }
        public function getStatutEvaluation($idfichier){
            $statut="Evalué";    
            $statut="Pas évalué";
            return $statut;
        }
         public function getrendu($idfichier,$idetudiant){
            Load::DAO("fichier");
            return FichierDAO::findByIdandidetu($idfichier,$idetudiant);
        }
        public function getTempsRestant($idfichier){
          
            $datelimite =$this->date_limite;
            $heurelimite=$this->heure_limite;
            $date = date("d-m-Y");
            $heure = date("H:i");
            $format = 'Y-m-d H:i:s';
            $datetime1=$date."".$heure;
            $datetime2 =$datelimite." ".$heurelimite ;
            $dateFrom = new DateTime($datetime1);
            $dateNow = new DateTime($datetime2);
            $datenull = new DateTime("0000-00-00 00:00:00");
            $interval = $dateNow->diff($dateFrom);
            if($interval>$datenull)
            {   
                return $interval;
            }
            else {
                if($this->acceptRetard()==1)
                {
                    return "Le temps est écoulé,mais le retard est accepté";
                }else{
                    return "Le temps est écoulé";
                }
            }
        }
        
        /**
         * Getters
         * @param type $name
         * @return boolean
         */
        public function __get($name) {
            switch($name){
                case 'id':
                    return $this->id;
                case 'id_devoir':
                    return $this->id_devoir;
                case 'heure': // Alias
                    return $this->heure_limite;
                case 'heure_limite':
                    return $this->heure_limite;
                case 'date': // Alias
                    return $this->date_limite;
                case 'date_limite':
                    return $this->date_limite;
                case 'retard':
                    return $this->retard;
                case 'name':
                    return $this->name;
                default:
                    return false;
            }
        }
        
        /**
         * Setters
         * @param type $name
         * @param type $value
         */
        public function __set($name, $value) {
            
            switch($name){
                case 'heure': // Alias
                    $this->heure_limite = $value;
                    break;
                case 'heure_limite':
                    $this->heure_limite = $value;
                    break;
                case 'date': // Alias
                    $this->date_limite = $value;
                    break;
                case 'date_limite':
                    $this->date_limite = $value;
                    break;
                case 'name':
                    $this->name = $value;
                    break;
                case 'retard':
                    $this->retard = $value;
                    break;
                case 'id_devoir':
                    $this->id_devoir = $value;
            }
            
        }
        
    }

?>