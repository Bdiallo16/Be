<?php

/**
 * Controlleur par défaut
 * 
 * Accessible depuis http://mon-site/ ou http://mon-site/Accueil
 * 
 */
	class accueilController extends baseController{
		
        /**
         * Constructeur
         */
		public function __construct(){
			parent::__construct();
			
			$this->view = 'accueil';
			
			if($this->_session->is_logged()){
				Router::redirect("/Users","refresh");
			}
			
		}
        /**
         * Fonction par défaut
         * 
         * 
         */
		public function index(){

			$vars['title'] = 'Accueil';
			$vars['view'] = $this->view;
			
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