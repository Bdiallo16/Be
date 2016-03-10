<?php

    /**
     * Controlleur réservé a l'administrateur.
     */
	class adminController extends baseController{
		
        /**
         * Constructeur
         */
		public function __construct(){
			parent::__construct();
			
			$this->view = 'Utilisateurs/admin';
			
            
			$this->authorization();
			
		}
		
        /**
         * Fonction qui vérifie que l'utilisateur a le droit d'accéder au contenu
         * Sinon il est redirigé.
         * Seul l'administrateur peut accéder ici
         */
		public function authorization(){
			if(!$this->_session->is_logged()){
				Router::redirect("/Login","refresh");
			}
			
			$user = $this->_session->user;
			
			if(!$user->isAdmin()){
				Router::redirect("/Users","refresh");
			}
		}
		
        /**
         * FOnction par défaut
         * Affiche l'accueil de l'admin
         */
		public function index(){

			$user = $this->_session->user;
			
			$vars['title'] = 'Administration';
			$vars['view'] = $this->view;
			
			$vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
			
			$vars["user"] = $user;
			
			$this->load->view('template',$vars);
	
		}
		
        /**
         * Fonction qui charge la page pour ajouter/modifier des enseignants
         */
		public function enseignants(){
			
            $user = $this->_session->user;
			
            $vars['title'] = 'Administration';
			$vars['view'] = 'Utilisateurs/Admin/enseignants';
			
			$vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
			
			$vars["user"] = $user;
			
            $vars["users"] = EnseignantsModel::findAll();
            
			$this->load->view('template',$vars);
            
		}
		
        /**
         * Fonction qui charge la page pour ajouter/modifier des etudiants
         */
		public function etudiants(){
			
            $user = $this->_session->user;
			
            $vars['title'] = 'Administration';
			$vars['view'] = 'Utilisateurs/Admin/etudiants';
			
			$vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
			
			$vars["user"] = $user;
			
            $vars["users"] = EtudiantsModel::findAll();
            
			$this->load->view('template',$vars);
        }
		
        /**
         * Fonction qui récupère les requetes ajax
         * Renvoi les informations des enseignants et etudiant
         */
        public function ajax(){
            
            if(isset($_GET["id_etudiant"])){
                $id = $_GET["id_etudiant"];
                $etudiant = EtudiantsModel::findById($id);
                if($etudiant){
                    $json = $etudiant->json_encode();
                }else{
                    $json = array();
                }
                echo json_encode($json);
            }else if(isset($_GET["id_enseignant"])){
                $id = $_GET["id_enseignant"];
                $enseignant = EnseignantsModel::findById($id);
                if($enseignant){
                    $json = $enseignant->json_encode();
                }else{
                    $json = array();
                }
                echo json_encode($json);
            }
        }
        
        /**
         * Recupere une requete ajax pour modifier enseignant et etudiant
         */
        public function update(){
            //TODO
        }
        /**
         * Recuepere une requete ajax pour ajouter un etudiant
         */
        public function addEtudiant(){
            //TODO
        }
        
        /**
         * Recupere une requete ajax pour ajouter un enseignant
         */
        public function addEnseignant(){
            //TODO
        }

	}