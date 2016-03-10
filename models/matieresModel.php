<?php

    /**
     * Classe représentant une matiere
     */
    class MatieresModel extends BaseModel{
        

        private $id;
        private $id_formation;
        private $id_responsable;
        private $name;
        private $devoirs;
        
        /**
         * Constructeur de la classe
         * @param type $data
         */
        public function __construct($data = null) {
            if(isset($data)){
                $this->id = $data->id;
                $this->id_formation = $data->id_form;
                $this->id_responsable = $data->id_resp;
                $this->name = $data->name;
            }
        }

        // TODO
        public static function findAll() {
            return null;
        }

        /**
         * Récupère la matiere ayant l'id passé en paramètre
         * @param type $id
         * @return boolean
         */
        public static function findById($id) {
            if(is_numeric($id)){
                return MatiereDAO::findById($id);
            }
            return false;
        }
         public static function findByFormation($id) {
            if(is_numeric($id)){
                return MatiereDAO::findByFormation($id);
            }
            return false;
        }
        
        /**
         * Récupère tous ses devoirs associé dans la BDD 
         */
        public function loadDevoirs(){
            $this->devoirs = DevoirsModel::findAll($this->id);
            
        }
        
        /**
         * Permet de sauvegarder la matiere dans la BDD
         */
        public function create(){
            return MatiereDAO::insert($this);
        }
        /**
         * Permet de mettre à jour les données de la BDD
         */
        public function save(){
            return MatiereDAO::update($this);
        }
        
        /**
         * Retourne tout les devoirs de la matiere
         * @param type $idmatier
         * @return type
         */
        public function getallDevoirs($idmatier){
            
           $devoir= devoirsDAO::findByMatiere($idmatier);
            return $devoir;
        
        }
        
       // Getter & Setter
       
        /**
         * Retourne le devoir correspondant, faux si non trouvé
         * @param type $id
         * @return boolean
         */
        public function findDevoir($id){
            if(!empty($this->devoirs)){
                foreach($this->devoirs as $d){
                    if($d->id === $id){
                        return $d;
                    }
                }
            }
            return false;
        }
        
        /**
         * Retourne tout ses devoirs
         * @return type
         */
        public function getDevoirs(){
            return $this->devoirs;
        }
        
        /**
         * Retourne son id
         * @return type
         */
        public function getId(){
            return $this->id;
        }
        
        /**
         * Retourne l'id de la formation associé
         * @return type
         */
        public function getIdFormation(){
            return $this->id_formation;
        }
        
        /**
         * Retourne la formation associé
         * @return type FormationsModel
         */
        public function getFormation(){
            return FormationsModel::findById($this->id_formation);
        }

        /**
         * Retourn l'id du responsable
         * @return type
         */
        public function getIdResponsable(){
            return $this->id_responsable;
        }
        
        /**
         * Retourne le responsable 
         */
        public function getResponsable(){
            return EnseignantsModel::findById($this->id_responsable);
        }
        
        
        /**
         * Retourne le nom de la matiere
         * @return type
         */
        public function getName(){
            return $this->name;
        }

        /**
         * Getters
         * @param type $name
         * @return boolean
         */
        public function __get($name) {
            switch ($name){
                case 'id':
                    return $this->id;
                case 'id_formation':
                    return $this->id_formation;
                case 'id_responsable':
                    return $this->id_responsable;
                case 'name':
                    return $this->name;
                default:
                    return false;
            }
        }
        
        /**
         * Modifie l'id de la formation associé
         * @param type $id
         */
        public function setFormation($id){
            $this->id_formation = $id;
        }
        
        /**
         * Modifie l'id du responsable
         * @param type $id
         */
        public function setResponsable($id){
            $this->id_responsable = $id;
        }
        
        /**
         * Modifie le nom
         * @param type $name
         */
        public function setName($name){
            $this->name = $name;
        }
        
        /**
         * Setters
         * @param type $name
         * @param type $value
         */
        public function __set($name, $value) {
            switch ($name){
                case 'id_formation':
                    $this->id_formation = $value;
                    break;
                case 'id_responsable':
                    $this->id_responsable = $value;
                    break;
                case 'name':
                    $this->name = $value;
                default:
                    break;
            }
        }

}

?>