<?php

/**
 * Controlleur qui affiche la page de test et les réalises
 */
	class TestController extends baseController {
		
        /**
         * Constructeur
         */
		public function __construct(){
			parent::__construct();
			$this->view = 'test';
            $this->message = array();
		}
		
        /****************************
         * TESTS
         ****************************/
        
		public function test_matiereFindById(){
            $db = DB::Connect();
            $result = $db->query("SELECT libelle_matiere as nom FROM MATIERES WHERE id_matiere = 3");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            $matiere = MatieresModel::findById(3);
            
			$this->message["mat_findById_mess"] = "Attendu : ".$attendu."  - Trouver : ".$matiere->name;
            return (count($matiere) === 1 && ($attendu === $matiere->name));
		}
		
		public function test_matiereFindByEnseignant(){
            
            $matiere = MatiereDAO::findByEnseignant(1);
            
            $this->message["mat_findByEns_mess"] = "Attendu : 4  - Trouver : ".($matiere ? count($matiere) :  "rien") ;
            
            return (count($matiere) === 4);
		}
		
		public function test_etudiantFindById(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT prenom_etu as nom FROM ETUDIANTS WHERE id_etu = 3");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            $etudiant = EtudiantsModel::findById(3);
            
			$this->message["etu_findById_mess"] = "Attendu : ".$attendu."  - Trouver : ".$etudiant->prenom;
            
            return (!empty($etudiant) && $etudiant->prenom === $attendu);
		}
		
		public function test_etudiantFindAll(){
			$db = DB::Connect();
			$result = $db->query("SELECT count(*) as nombre FROM ETUDIANTS");
			$result->setFetchMode(PDO::FETCH_OBJ);
			$result = $result->fetch();
			$count = $result->nombre;
			
			$etudiants = EtudiantsModel::findAll();
            $this->message["etu_findAll_mess"] = "Attendu : ".$count. " - Trouver : ".count($etudiants);
            
            return (count($etudiants) === intval($count));
		}
		
		public function test_enseignantFindById(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT prenom_enseignant as nom FROM ENSEIGNANTS WHERE id_enseignant = 1");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            $enseignant = EnseignantsModel::findById(1);
            
			$this->message["ens_findById_mess"] = "Attendu : ".$attendu." - Trouver : ".$enseignant->prenom;
            return (!empty($enseignant) && $enseignant->prenom === $attendu);
		}
		
		public function test_enseignantFindAll(){
			$db = DB::Connect();
			$result = $db->query("SELECT count(*) as nombre FROM ENSEIGNANTS");
			$result->setFetchMode(PDO::FETCH_OBJ);
			$result = $result->fetch();
			$count = $result->nombre;
			
			$enseignants = EnseignantsModel::findAll();
            
            $this->message["ens_findAll_mess"] = "Attendu : ".$count. " - Trouver : ".count($enseignants);
            
			return (count($enseignants) === intval($count));
			
		}
        
        public function test_devoirFindById(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT libelle_devoir as nom FROM DEVOIRS WHERE id_devoir = 9");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            
            Load::DAO("devoirs");
            $devoir = DevoirsDAO::findById(9);
            if($devoir){
                $this->message["dev_findById_mess"] = "Attendu : ".$attendu."  - Trouver : ".$devoir->name  ;
            }else{
                $this->message["dev_findById_mess"] = "Attendu : ".$attendu."  - Trouver :  Rien" ;
            }
            return (!empty($devoir) && ($attendu === $devoir->name));
        }

        public function test_devoirFindByMatiere(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT count(*) as nombre FROM DEVOIRS WHERE id_matiere = 5");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $count = $result->nombre;
            
            Load::DAO("devoirs");
            $devoirs = DevoirsDAO::findByMatiere(5);
            
            $this->message["dev_findByMatiere_mess"] = "Attendu : ".$count. " - Trouver : ".count($devoirs);
            return (count($devoirs) === intval($count));
        }


        public function test_fichierFindById(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT libelle_fichier_attendu as nom FROM FICHIERS_ATTENDUS WHERE id_fichier_attendu = 6");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            Load::DAO("fichier");
            $fichier = FichierDAO::findById(6);
            if($fichier){
                $this->message["file_findById_mess"] = "Attendu : ".$attendu."  - Trouver : ".$fichier->name  ;
            }else{
                $this->message["file_findById_mess"] = "Attendu : ".$attendus."  - Trouver :  Rien" ;
            }
            return (!empty($fichier) && ($attendu === $fichier->name));
        }
        
        public function test_fichierFindByDevoir(){
            $db = DB::Connect();
            $result = $db->query("SELECT count(*) as nombre FROM FICHIERS_ATTENDUS WHERE id_devoir = 1");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $count = $result->nombre;
            
            Load::DAO("fichier");
            $fichiers = FichierDAO::findByDevoir(1);
            
            $this->message["file_findByDevoir_mess"] = "Attendu : ".$count. " - Trouver : ".count($fichiers);
            return (count($fichiers) === intval($count));
        }
        
        public function test_formFindById(){
            
            $db = DB::Connect();
            $result = $db->query("SELECT libelle_formation as nom FROM FORMATIONS WHERE id_formation = 2");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nom;
            
            $formation = FormationsModel::findById(2);
            if($formation){
                $this->message["form_findById_mess"] = "Attendu : ".$attendu. " - Trouver : ".$formation->getName();
            }else{
                $this->message["form_findById_mess"] = "Attendu : ".$attendu. " - Trouver : Rien";
            }
                
            return (!empty($formation) && ($formation->getName() === $attendu));
        }
        
        public function test_formFindByEtu(){
            $db = DB::Connect();
            $result = $db->query("SELECT count(*) as nombre FROM ETUDIANT_FORMATION WHERE id_etu = 2");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nombre;
            
            $formations = FormationsModel::findByEtudiant(2);
            
            $this->message["form_findByEtu_mess"] = "Attendu : ".$attendu. " - Trouver : ".count($formations);
            
            return (count($formations) === intval($attendu));
        }
        
        public function test_formFindAll(){
            $db = DB::Connect();
            $result = $db->query("SELECT count(*) as nombre FROM FORMATIONS");
            $result->setFetchMode(PDO::FETCH_OBJ);
            $result = $result->fetch();
            $attendu = $result->nombre;
            
            $formations = FormationsModel::findAll();
            if($formations){
                $this->message["form_findAll_mess"] = "Attendu : ".$attendu. " - Trouver : ".count($formations);
            }else{
                $this->message["form_findAll_mess"] = "Attendu : ".$attendu. " - Trouver : Rien";
            }
            return (count($formations) === intval($attendu));
        }

        
        
        /*********************
         *  AFFICHAGE
         ********************/
        
        
        public function index(){
			
            $vars["title"] = "Page de Test";
			
            // Test a effectué
            $vars["formationFindById"] = $this->test_formFindById();
            $vars["formationFindAll"] = $this->test_formFindAll();
            $vars["formationFindByEtu"] = $this->test_formFindByEtu();
            
            $vars["matiereFindById"] = $this->test_matiereFindById();
            $vars["matiereFindByEnseignant"] = $this->test_matiereFindByEnseignant();
            
            $vars["devoirFindById"] = $this->test_devoirFindById();
            $vars["devoirFindByMatiere"] = $this->test_devoirFindByMatiere();
            
            $vars["etudiantFindById"] = $this->test_etudiantFindById();
            $vars["etudiantFindAll"] = $this->test_etudiantFindAll();
            
            $vars["enseignantFindById"] = $this->test_enseignantFindById();
            $vars["enseignantFindAll"] = $this->test_enseignantFindAll();
            
            $vars["fichiersFindById"] = $this->test_fichierFindById();
            $vars["fichiersFindByDevoir"] = $this->test_fichierFindByDevoir();
                    
            $vars["message"] = $this->message;
			$this->load->view("test",$vars);
			
		}
		
	}


?>