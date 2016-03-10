<?php


    /**
     * Classe représentant un devoir
     */
	class DevoirsModel extends BaseModel{
    
    	private $id;
        private $name ;
        // private $date_limite_correction;
       	private $groupe = false;
        private $id_matiere;
        private $id_resp;
        private $fichiers;
        private $notes;
        

        /**
         * Constructeur de la classe
         * @param type $info informations envoyé par la DAO
         */
        public function __construct($info = null) {
            if(isset($info)){
                $this->id = $info->id;
                $this->name = $info->name;
                $this->id_matiere = $info->id_matiere;
                $this->id_resp = $info->id_resp;
                // $this->date_limite_correction = $info->date_limite;
                $this->groupe = $info->groupe;            
                $this->fichiers = FichiersModel::findAll($this->id);
            }
        }

        
        /**
         * Obtenir tout les devoirs d'une matiere
         * 
         * @param type $id_matiere id de la matiere
         * @return boolean | Liste contenant les devoirs
         */
        public static function findAll($id_matiere) {
            
            if(is_numeric($id_matiere)){
                Load::DAO("devoirs");
                return DevoirsDAO::findByMatiere($id_matiere);
            }
            return FALSE;
        }

        /**
         * Retourne le devoir correspondant à l'id
         * @param type $id identifiant recherché
         * @return boolean | Devoir correspondant à l'identifiant
         */
        public static function findById($id) {

            if(is_numeric($id)){
                Load::DAO("devoirs");
                return DevoirsDAO::findById($id);
            }
            return false;
        }

        
        /**
         * Sauvegarde le devoir dans la base de donnée
         * @return type
         */
        public function create(){
            Load::DAO("devoirs");
            return DevoirsDAO::insert($this);
        }
        
        /**
         * Met à jour le devoir dans la base de données
         * @return type
         */
        public function save(){
            Load::DAO("devoirs");
            return DevoirsDAO::update($this);
        }
        
        // Getter & Setter
        
        /**
         * Retourne l'id
         * @return type identifiant
         */
        public function getId(){
            return $this->id;
        }
        
        /**
         * Retourne le nom
         * @return type nom
         */
        public function getName(){
            return $this->name;
        }

        
        /**
         * Fonction permettant de savoir si le devoir est en groupe ou non,
         * et d'en modifier la valeur.
         * @param type $b permet de modifier la valeur
         * @return type vrai si en groupe, faux sinon
         */
        public function enGroupe($b = null){
            if(isset($b)){ // SET
                $this->groupe = boolval($b);
            }else{ // GET
                return boolval($this->groupe);
            }
        }
        
        /**
         * Permet de récupérer tout les fichiers attendus ou 
         * seulement celui spécifié en paramtre
         * 
         * @param type $id id du fichier recherché
         * @return boolean | Fichier
         */
        public function getFichiersAttendus($id = null){
            if(isset($id)){
                foreach($this->fichiers as $f){
                    if($f->id === $id){
                        return $f;
                    }
                }
                return false;
            }else{
                return $this->fichiers;
            }
        }
        
        
        /**
         * Retourne l'id du responsable du devoir
         * @return type id du responsable du devoir
         */
        public function getResp(){
            return $this->id_resp;
        }
        
        
        
        public function getNote(){
            return $this->notes;
        }
        
        /**
         * Modifie l'id du responsable du devoir
         * @param type $r id du responsable
         */
        public function setResp($r){
            $this->id_resp = $r;
        }
        
        public function isGroupe(){
            return $this->groupe;
        }
        
        /**
         * Modifie le nom du devoir
         * @param type $n nouveau nom
         */
        public function setName($n){
            $this->name = $n;
        }
        
        /**
         * Retourne l'id de la matiere associé
         * @return type identifiant de la matiere associé au devoir
         */
        public function getIdMat(){
            return $this->id_matiere;
        }
        
        /**
         * Modifie l'id de la matiere associé
         * @param type $i id de la matiere
         */
        public function setIdMat($i){
            $this->id_matiere = $i;
        }
        
        /**
         * Getters
         * @param type $name nom de l'attribut recherché
         * @return boolean valeur de l'attribut ou faux si il n'existe pas
         */
        public function __get($name) {
            switch ($name){
                case 'id':
                    return $this->id;
                case 'name':
                    return $this->name;
                case 'groupe':
                    return $this->groupe;
                case 'fichiers' :
                    return $this->fichiers;
                case 'id_matiere':
                    return  $this->id_matiere;
                case 'id_resp':
                    return $this->id_resp;
                default :
                    return false;
            }
        }
        
        /**
         * Setters
         * @param type $name nom de l'attribut
         * @param type $value nouvelle valeur
         */
        public function __set($name, $value) {
            switch ($name){
                case 'name':
                    $this->name = $value;
                    break;
                case 'groupe':
                    $this->groupe = $value;
                    break;
                case 'id_matiere':
                    $this->id_matiere = $value;
                    break;
                case 'id_resp':
                    $this->id_resp = $value;
                    break;
                 
            }
        }
         public function getnote2($iddevoir, $idetu, $groupe) {
            
           Load::DAO("note");
           if(noteDAO::findByIddevoir($iddevoir, $idetu, $groupe)!=null)
           {
           return   $this->note= noteDAO::findByIddevoir($iddevoir, $idetu, $groupe);
           }
           
        }
        
}

?>