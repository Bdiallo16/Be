<?php

    class AdminModel extends UsersModel{
        
        public function __construct($data, $searchInDB = false) {
            
            $this->connected = true;
            if($searchInDB){
                $this->id = $data->id_admin;
                $info = UserDAO::getAdminInfo($this->id);
                $this->construct_from($info);
             
            }else{
                $this->construct_from($data);
            }
        }
        
        public static function findAll() {
            // Not implemented
            return array();
        }

        public static function findById($id){
            // Not implemented
            return null;
        }
        
        public function save(){
            // Not implemented
        } 
        
        public function update(){
            // Not implemented
        }
        
        public function delete(){
            // Not implemented
        }
        
        public function isAdmin(){
		    return TRUE;
	    }
	    
	    public function isEtudiant(){
		    return FALSE;
	    }
	    
	    public function isEnseignant(){
		    return FALSE;
	    }
        
    }

?>
