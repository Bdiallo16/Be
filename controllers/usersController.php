<?php
/**
 * Controlleur pour les utilisateurs (les enseignants et les etudiants)
 * accéssible via http://mon-site/Users
 */
	class usersController extends baseController{
		
        /**
         * Constructeur
         */
        public function __construct(){
			parent::__construct();
			
			$this->view = 'Utilisateurs/user';
			if(isset($this->_session->user)){
                $this->_session->user->refresh();
            }
		}
        /**
         * Vérifie les authorisations de l'utilisateur
         */
        public function authorization(){
            
            if(!$this->_session->is_logged()){
				Router::redirect("/Login","refresh");
			}
			
			$user = $this->_session->user;
			
			if($user->isAdmin()){
				Router::redirect("/Admin","refresh");
			}
        }
        
        /**
         * Seul les étudiants ne sont pas redirigé
         */
        public function etudiantOnly(){
            if(!$this->_session->is_logged()){
				Router::redirect("/Login","refresh");
			}
			
			$user = $this->_session->user;
            
			if($user->isEnseignant()){
                Router::redirect("/Users","refresh");
            }
			if($user->isAdmin()){
				Router::redirect("/Admin","refresh");
			}
        }
        
        /**
         * Seul les enseignants ne sont pas redirigé
         */
        public function enseignantOnly(){
            if(!$this->_session->is_logged()){
				Router::redirect("/Login","refresh");
			}
			
			$user = $this->_session->user;
			if($user->isEtudiant()){
                Router::redirect("/Users","refresh");
            }
			if($user->isAdmin()){
				Router::redirect("/Admin","refresh");
			}
        }
        
        /**
         * Affichage par défaut
         */
		public function index(){

			$this->authorization();
			
            $user = $this->_session->user;
			
            $vars['title'] = 'Espace Perso';
			$vars['view'] = $this->view;
            
            $vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
			
			$vars["user"] = $user;
                       
			
            // Enseignant
            if($user->isEnseignant()){
                
                $vars["view"] = "Utilisateurs/teacher";
                
                $vars["test"] = "Hello";
            
                $vars["user"] = $user;
			
                
            }else{ // Etudiant
                
            }
            
            
			$this->load->view('template',$vars);
				
		}
		
		
        /**
         * Affichage d'une matiere
         */
		public function cours(){
			
            $args = func_get_args();
            if(!empty($args)){
                $arg = array_shift($args);
                if(is_numeric($arg)){
                    $this->showFile($arg);
                }else{
                    $arg = strtolower($arg);
                    if($arg == "create"){
                        $this->createCours();
                    }else if($arg == "edit"){
                        if(isset($_GET["i"])){
                            $this->editCours($_GET["i"]);
                        }else{
                            Router::redirect("/Users","refresh");
                        }
                    }
                }
            }else{
            	if(isset($_POST["jsonData"])){
	            	if(isset($_GET["i"])){
	            		$this->updateCours($_GET["i"]);
	            	}else{
	            		echo json_encode(["result" => "error"]);
	            	}
	            	
            	}else if(isset($_GET["i"])){
                    
                    $this->showCours($_GET["i"]);
                    
                }else{
                   
                    Router::redirect("/Users","refresh");	
                    
                }
            }   
		}
        
        /**
         * Gere les echanges ajax avec la page pour modifier un cours
         * @param type $id_cours
         */
        public function updateCours($id_cours){
        
            $this->enseignantOnly();
            
            $user = $this->_session->user;
            $matiere = MatieresModel::findById($id_cours);
            $result = array("result" => "ok");
            if($matiere){
                $newMatiere = json_decode($_POST["jsonData"]);
                if($newMatiere->id === $matiere->id){
                    // Matiere
                    if(!empty($newMatiere->nom) && ($newMatiere->nom != $matiere->getName() )){
                        $matiere->setName($newMatiere->nom);
                        $matiere->save();
                        
                    }
                    // Devoirs
                    if(!empty($newMatiere->devoirs)){
                        
                        $matiere->loadDevoirs();
                        foreach($newMatiere->devoirs as $d){
                            
                            if($d->id < 0){
                                
                                // INSERT NEW DEVOIR
                                $devoir = new DevoirsModel();
                                $devoir->setIdMat($matiere->getId());
                                $devoir->setResp($user->id);
                                $devoir->setName($d->nom);
                                $devoir->enGroupe(boolval($d->groupe));
                                $devoir->create();
                                
                                
                                if(!empty($d->fichiers)){
                                    foreach($d->fichiers as $f){
                                        
                                        // INSERT NEW FICHIER
                                        $fichier = new FichiersModel();
                                        $fichier->setName($f->nom);
                                        $fichier->setDate($f->date);
                                        $fichier->setHeure($f->heure);
                                        $fichier->setIdDevoir($d->id);
                                        $fichier->acceptRetard(boolval($f->retard));
                                        $fichier->create();
                                        
                                        
                                        
                                    }
                                }
                                
                            }else{
                                
                                $devoir = $matiere->findDevoir($d->id);
                                if($devoir){
                                    
                                    if(($devoir->getName() !== $d->nom )
                                      || $devoir->enGroupe() !== boolval($d->groupe)){
                                        $devoir->setName($d->nom);
                                        $devoir->enGroupe(boolval($d->groupe));
                                        $devoir->save();
                                        
                                        
                                        
                                    }
                                    
                                    if(!empty($d->fichiers)){
                                        
                                        foreach($d->fichiers as $f){
                                         
                                            if($f->id < 0){
                                                
                                                        // INSERT NEW FICHIER
                                                $fichier = new FichiersModel();
                                                $fichier->setName($f->nom);
                                                $fichier->setDate($f->date);
                                                $fichier->setHeure($f->heure);
                                                $fichier->setIdDevoir($d->id);
                                                $fichier->acceptRetard(boolval($f->retard));
                                                $fichier->create();

                                                
                                                
                                            }else{
                                                
                                                $fichier = $devoir->getFichiersAttendus($f->id);
                                                
                                                if($fichier){
                                                    
                                                    if(($fichier->getName() !== $f->nom) || 
                                                       ($fichier->getDate() !== $f->date) ||
                                                       ($fichier->getHeure() !== $f->heure) ||
                                                       ($fichier->acceptRetard() !== boolval($f->retard))){
                                                        
                                                        $fichier->setName($f->nom);
                                                        $fichier->setDate($f->date);
                                                        $fichier->setHeure($f->heure);
                                                        $fichier->acceptRetard(boolval($f->retard));
                                                        $fichier->save();
                                                        
                                                        
                                                        
                                                    }
                                                    
                                                }else{
                                                    $result["result"] = "OOPS - FICHIER NON TROUVE";
                                                }
                                                
                                            }
                                        }
                                    }
                                    
                                    
                                }else{
                                    $result["result"] = "OOPS - DEVOIR NON TROUVE";
                                }
                                
                            }  
                        }
                    }
                    
                    
                    
                    
                }else{
                    echo json_encode(["result" => 'Mauvais identifiants']);
                }
            }else{
                
                $result["result"] = "error";
            }
            echo json_encode($result);
        }
        
        
        
        /**
         * Affiche le cours
         * @param type $id_cours
         */
        public function showCours($id_cours){
            
            $this->authorization();
            $user = $this->_session->user;

            $cours = MatieresModel::findById($id_cours);
            if($cours){
                $cours->loadDevoirs();
            }
            $formation = ($cours ? $cours->getFormation() : false);
            
            $vars["matiere"] = $cours;
            $vars["formation"] = $formation;
            
            $vars["view"] = "Utilisateurs/cours";
            
            $vars['title'] = 'Espace Perso';
            $vars['is_logged'] = $this->_session->is_logged();
            $vars['enseignant'] = $user->isEnseignant(); 
            $vars['etudiant'] = $user->isEtudiant();
            $vars['admin'] = $user->isAdmin();

            $vars["user"] = $user;
            
            
            $this->load->view('template',$vars);
        }
        
        
        /**
         * Affiche la page pour créer un cours
         */
        public function createCours(){
            
            if(isset($_POST["postData"])){
                
                $id_formation = $_POST["id-form"];
                $id_responsable = $this->_session->user->id;
                $id_enseignants = $_POST["id_enseignants"];
                $name = $_POST["matiere-name"];
                
                $matiere = new MatieresModel();
                $matiere->setResponsable($id_responsable);
                $matiere->setFormation($id_formation);
                $matiere->setName($name);
                $res = $matiere->create();
                
                if($res){
                    Router::redirect("/Users/Cours?i=".$res->id,"refresh");
                }
                
            }else{
            
                $this->enseignantOnly();
                $user = $this->_session->user;

                $vars["formations"] = FormationsModel::findAll();
                $vars["enseignants"] = EnseignantsModel::findAll();
                $vars["view"] = "Utilisateurs/create";
                $vars['title'] = 'Espace Perso';
                $vars['is_logged'] = $this->_session->is_logged();
                $vars['enseignant'] = $user->isEnseignant(); 
                $vars['etudiant'] = $user->isEtudiant();
                $vars['admin'] = $user->isAdmin();
                $vars["user"] = $user;
                $vars["matiere"] = $user;

                $this->load->view('template',$vars);
            }
        }
        
        /**
         * Affiche la page pour modifier un cours
         * @param type $id
         */
        public function editCours($id){
            $this->enseignantOnly();
			$user = $this->_session->user;
			
            $matiere = MatieresModel::findById($id);
            if($matiere){
                $matiere->loadDevoirs();
            }
            $formation = ($matiere ? $matiere->getFormation() : false);
            
            $vars["matiere"] = $matiere;
            $vars["formation"] =  $formation;
            
            $vars["view"] = "Utilisateurs/edit";
            $vars['title'] = 'Espace Perso';
			$vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
			
			$vars["user"] = $user;
			
			$this->load->view('template',$vars);
        }
        
        /**
         * Affiche la page d'un fichier
         * @param type $id
         */
        public function showFile($id){
            
            $this->authorization();
			$user = $this->_session->user;
    	    $vars["fichier"]=  FichiersModel::findById($id);	
            $vars["view"] = "Utilisateurs/file";
            $vars['title'] = 'Espace Perso';
			$vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();			
			$vars["user"] = $user;
            $iddevoir=$vars["fichier"]->id_devoir;
            $cours = MatieresModel::findById($iddevoir);
            if($cours){
                $cours->loadDevoirs();
            }
            $formation = ($cours ? $cours->getFormation() : false);
            
            $vars["matiere"] = $cours;
            $vars["formation"] = $formation;
            $vars["fichier_rendu"]= FichiersattenduModel::findById( $vars["fichier"]->getId(),$user->id);
            
            $this->load->view('template',$vars);
        }
        
        /**
         * Affiche les notes d'un etudiant
         */
        public function mynotes(){
            $this->authorization();
            $user = $this->_session->user;
            
            $vars['title'] = 'Espace Perso';
            $vars['view'] = "Utilisateurs/notes";
            
            $vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();            
            $vars["user"] = $user;            
            $cours = MatieresModel::findByFormation($user->getiddernierFormations()); 
            $vars["matiere"] = $cours;
                       
            $this->load->view('template',$vars);
        }

        
        /**
         * Affiche la page d'evaluation
         */
        public function evaluation(){
            $this->enseignantOnly();
            
            $user = $this->_session->user;
            
            $vars['title'] = 'Espace Perso';
            $vars['view'] = "Utilisateurs/evaluation";
            
            $vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
            
            $vars["user"] = $user;
            
            
            $this->load->view('template',$vars);
            
        }

        /**
         * Affiche les notes réservé à l'enseignant
         */
        public function notes(){
            
            $this->authorization();
            $user = $this->_session->user;
            
            $vars['title'] = 'Espace Perso';
            $vars['view'] = "Utilisateurs/ensnotes";
            
            $vars['is_logged'] = $this->_session->is_logged();
			$vars['enseignant'] = $user->isEnseignant(); 
			$vars['etudiant'] = $user->isEtudiant();
			$vars['admin'] = $user->isAdmin();
            
            $vars["user"] = $user;
            
            //$iddevoir = $vars["fichier"]->id_devoir;
            
            //$cours = MatieresModel::findById($iddevoir);
            //if($cours){
            //    $cours->loadDevoirs();
            //}
            //$formation = ($cours ? $cours->getFormation() : false);            
            //$vars["matiere"] = $cours;
            //$vars["formation"] = $formation;
            $this->load->view("template",$vars);
            
        }
        
		
        /**
         * Fonction permettant de verifier si l'utilisateur est bien enregistrer dans 
         * la base de données avec les identifiants qu'il vient de fournir.
         * Si les identifiants sont ok alors l'utilisateur 
         * 
         * @param login variable POST contenant login de l'utilisateur
         * @param pass variable POST contenant le mot de passe de l'utilisateur
         * 
         */
		public function verify(){
		
            if(!$this->_session->is_logged()){
                if(!empty($_POST['login']) && !empty($_POST['password'])){
                    
                    $login = $_POST["login"];
                    $pass = $_POST["password"];
                    $user = UsersModel::Login($login,$pass);
                    
                    if(!empty($user)){

                        if($user->isConnected()){
                            $this->_session->login($user->isConnected());
                            $this->_session->user = $user;
                           Router::redirect("/Users","refresh");
                        }else{
                            Router::redirect("/Login?error=3","refresh");
                        }
                    }else{
                        Router::redirect("/Login?error=2","refresh");
                    }


                }else{
                    Router::redirect('/Login?error=1','refresh');
                }
            }else{
                Router::redirect("/Users","refresh");
            }
		}
        
        // API REST - Ajax function

        public function get(){
            // ???
        }
        
	}