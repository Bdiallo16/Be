<?php

    class EnseignantsModel extends UsersModel {
     
        private $formations;
        private $matieres;
        
        public function __construct($data, $searchInDB = false) {
            
            if($searchInDB){
                
                $this->id = $data->id_ens;
                $info = EnseignantDAO::getInfo($this->id);
                $this->construct_from($info);
                
                Load::DAO("matiere");
                $this->loadMatieres();
                $this->loadFormations();
                
            }else{
                $this->construct_from($data);
            }
        }
        
        public function refresh(){
            $this->formations = null;
            $this->matieres = null;
            Load::DAO("matiere");
            $this->loadMatieres();
            $this->loadFormations();
        }
        
        public function loadMatieres(){
            $this->matieres = MatiereDAO::findByEnseignant($this->id);
        }
        
        public function loadFormations(){
            $this->formations = array();
            foreach($this->matieres as $m){
                if(!$this->hasFormation($m->id_formation)){
                    $f = formationDAO::findById($m->id_formation);
                    if($f){
                        array_push($this->formations, $f);
                    }
                }
            }
            
            foreach($this->formations as $f){
                $f->addMatieres($this->matieres);
            }
            
            $this->formations = FormationsModel::sortDESC($this->formations);
        }
        
        
        private function hasFormation($id_formation){
            foreach($this->formations as $f){
                if($f->id == $id_formation){
                    return true;
                }
            }
            return false;
        }
        
        public static function findAll() {
            
            return EnseignantDAO::findAll();
        
        }

        public static function findById($id) {
             return EnseignantDAO::findById($id);
        }
        
        public function save(){
            
        } 
        
        public function update(){
            
        }
        
        public function delete(){
            
        }
        
        public function isAdmin(){
		    return FALSE;
	    }
	    
	    public function isEtudiant(){
		    return FALSE;
	    }
	    
	    public function isEnseignant(){
		    return TRUE;
	    }
        
        public function getMatieres(){
            return $this->matieres;
        }
        
        public function getFormations(){
            return $this->formations;
        }
        
    }
    

?>
