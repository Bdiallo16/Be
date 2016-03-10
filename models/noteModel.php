<?php

  class noteModel {
      
                private $note;
	        private $idgroupe ;
              private $iddevoir;
               private $idetudiant;
               private $notecommentaire;
              private $noteetudiant;
            public function __construct($data,$groupe) {
            
             if($groupe==1)  
             {
                 
           $this->idgroupe = $data->idgroupe;            
             $this->note= $data->notegroupe;
             }
             else{             
            $this->idetudiant=$data->idetudiant;
             $this->note=$data->noteetudiant;        
              }
         
            $this->notecommentaire = $data->notecommentaire;
            $this->iddevoir = $data->iddevoir;
            
        }
         public function getnote(){
          if(!empty($this->note))  
          return $this->note;
         else {
          
           }
        }
        
         public static function getIdnote($iddevoir, $idetu, $groupe) {
            
            return noteDAO::findById($iddevoir, $idetu, $groupe);
            
        }
        public static function findByIdmatiere($idmatiere, $idetu, $groupe) {
            
            return noteDAO::findById($idmatiere, $idetu, $groupe);
            
        }
  }