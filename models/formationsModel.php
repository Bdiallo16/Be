<?php

    class FormationsModel extends BaseModel{
        
        private $id;
        private $id_resp;
        private $annee;
        private $name;
        private $matieres;
        
        
        public function __construct($data) {
            $this->id = $data->id;
            $this->id_resp = $data->id_resp;
            $this->annee = $data->annee;
            $this->name = $data->name;
            $this->matieres = array();
        }
        
        public function addMatiere($m){
            array_push($this->matieres, $m);
        }
        
        public function addMatieres($array){
            if(is_array($array)){
                foreach($array as $m){
                    if($m->id_formation == $this->id){
                        $this->addMatiere($m);
                    }
                }
            }
        }
        
        public static function sortDESC($formations){
            $array = array();
            if(is_array($formations)){
                while(!empty($formations)){
                    $recent = array_shift($formations);
                    foreach($formations as $f){
                        if($f->moreRecentThan($recent)){
                            array_push($formations, $recent);
                            $recent = $f;
                        }
                    }
                    $array[] = $recent;
                    if(($key = array_search($recent, $formations)) !== FALSE){
                        unset($formations[$key]);
                    }
                }
            }
            return $array;
            
        }

        public function moreRecentThan($f){
            if($this->annee == $f->annee){
                return $this->name > $f->annee; 
            } // else
            return $this->annee > $f->annee;
        }
        
        
        public function loadMatieres() {
             Load::DAO("matiere");
             $this->matieres = MatiereDAO::findByFormation($this->id);
        }

        public static function findByEtudiant($id_etu) {
            return FormationDAO::findByEtudiant($id_etu);
        }

        public static function findById($id) {
            if(is_numeric($id)){
                return FormationDAO::findById($id);
            }
            return false;
        }
        
        public static function findAll(){
            return FormationDAO::findAll();
        }

        
        // Getter & Setter
        
        public function getId(){
            return $this->id;
        }
        
        public function getAnnee(){
            return $this->annee;
        }
        
        public function getMatieres(){
            return $this->getMatieres();
        }
        
        public function getName(){
            return $this->name;
        }
        
        public function __get($name) {
            switch ($name){
                case 'id':
                    return $this->id;
                case 'id_resp':
                    return $this->id_resp;
                case 'annee':
                    return $this->annee;
                case 'matieres':
                    return $this->matieres;
                case 'name':
                    return $this->name;
                default:
                    return false;
            }
        }
        
        public function __set($name, $value) {
            switch ($name){
                case 'id_resp':
                    $this->id_resp = $value;
                    break;
                case 'annee':
                    $this->annee = $value;
                    break;
                case 'name':
                    $this->name = $value;
                default:
                    break;
            }
        }
}

?>