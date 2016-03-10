<?php
/**
 * Controlleur qui permet de déconnecter l'utilisateur
 */
	class logoutController extends baseController{
		
		public function __construct(){
			parent::__construct();
		}
        /**
         * Deconnecte et redirige l'utilisateur vers l'accueil
         */
		public function index(){
			
			
			$this->_session->disconnect();	
			Router::redirect("/Accueil","refresh");
					
		}

	}