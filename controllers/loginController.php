<?php
/**
 * Controlleur qui gère l'affichage de l'interface pour se connecter
 */
	class loginController extends baseController{
		
        /**
         * Contructeur
         */
		public function __construct(){
			parent::__construct();
			
			$this->view = 'login';
			
			if($this->_session->is_logged()){
				Router::redirect("/Users","refresh");
			}
			
		}
        /**
         * Affichage de la page de connexion
         * Affiche un message d"erreur dans la page si besoin
         * @param type $error
         */
		public function index($error = null){

			
			$vars['title'] = 'Login Page';
			$vars['view'] = $this->view;
			
			if(isset($_GET["error"])){
				switch($_GET["error"]){
					case 1:	
						$vars['error'] = "<i class='uk-icon-exclamation-triangle'></i> Veuillez entrer votre <b>nom d'utilisateur</b> et votre <b>mot de passe</b>";
						break;
					case 2:
						$vars['error'] = "<i class='uk-icon-exclamation-triangle'></i> Mot de passe ou Nom d'utilisateur incorrect</b>";
						break;
					default:
						$vars['error'] = "Une erreur inconnue est survenue";
				}
			}
			
			if($this->_session->is_logged()){
			 	$vars['is_logged']= $this->_session->is_logged();
			 	if(isset($this->_session->userInfo))
			 		$vars['user'] = $this->_session->userInfo;
			 	
			}
			else{
				$vars['is_logged'] = false;	
			}
			
			
			$this->load->view('template',$vars);	
		}
		

	}