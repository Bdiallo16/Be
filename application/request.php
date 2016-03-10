<?php


    /**
     * Classe request
     * Elle anaylse l'url 
     */
	class Request{
		
		private $_controller;

		private $_method;

		private $_args;

        /**
         * Constructeur de l'objet Request
         */
		public function __construct(){
			
			$filter = array("index.php",HTTP_HOST,SITE_DIRECTORY);
			$parts = explode('/',$_SERVER['REQUEST_URI']);
			$parts = explode('/',$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF']);
			$parts = array_filter($parts);
			
			$parts = array_diff($parts, $filter);
			
			$this->_controller = ($c = array_shift($parts))? $c: 'accueil';
			$this->_method = ($c = array_shift($parts))? $c: 'index';
			$this->_args = (isset($parts[0])) ? $parts : array();
		}

        /**
         * Récupère le controlleur
         * @return type
         */
		public function getController(){
			return $this->_controller;
		}
        
        /**
         * Recupere la méthode du controlleur
         * @return type
         */
		public function getMethod(){
			return $this->_method;
		}
        
        /**
         * Recupere les arguments
         * @return type
         */
		public function getArgs(){
			return $this->_args;
		}
	}
