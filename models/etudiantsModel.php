<?php

    class EtudiantsModel extends UsersModel{
        
        private $formations;
        private $dernierformation;
        
        public function __construct($data, $searchInDB = false) {
            
            if($searchInDB){
                $this->id = $data->id_etu;
                $info = EtudiantDAO::getInfo($this->id);
                $this->construct_from($info);
                $this->formations = FormationsModel::findByEtudiant($this->id);
                                  
                foreach ($this->formations as $f){
                   
                    $f->loadMatieres();
                   
                    
                }
                 $formation = FormationDAO::findByEtudiant($this->id);
                                      $cpt=0;
                foreach ($formation  as $f2){
                   
                   if($cpt==0)
                   {
                       $this->dernierformation=$f2;
                   }
                     $cpt++;
                }
                
                
            }else{
                $this->construct_from($data);
            }
            
        }
        
        public static function findAll() {
            return EtudiantDAO::findAll();
        }

        public static function findById($id) {
            
            return EtudiantDAO::findById($id);
            
        }
        
        public function save(){
            
        } 
        
        public function update(){
            
        }
        
        public function delete(){
            
        }
         public function getFormations(){
            return $this->formations;
        }
         public function getiddernierFormations(){
            return $this->dernierformation->id;
        }
        
        public function getNote($id,$iddevoir){
            return $this->formations;
        }
        public function isAdmin(){
		    return FALSE;
	    }
	    
	    public function isEtudiant(){
		    return TRUE;
	    }
	    
	    public function isEnseignant(){
		    return FALSE;
	    }

    

}


?>
