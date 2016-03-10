<?php
	
/**
 * Gere la session
 */
	class Session{

		private static $_instance;

		private $_storage = "storage";

		private function __construct(){}

		public static function getInstance(){
			
			if(!isset($_SESSION["session_open"])){
				session_start();
				$_SESSION["session_open"] = true;
			}
			
			if(!self::$_instance instanceof self){
				self::$_instance = new Session;
			}
			return self::$_instance;
		}

        /**
         * Deconnecte
         */
		public function disconnect(){
			session_unset();
		}

        /**
         * Verifie si l'utilisateur est connecté
         * @return type
         */
		public function is_logged(){
			return $this->is_logged;
		}
		
        /**
         * Met a vrai ou faux la valeur de estConnecté?
         * @param type $bool
         */
		public function login($bool){
			$this->is_logged = $bool;
		}

        /**
         * Setters
         * Permet de modifier le contenu de la session
         * @param type $key
         * @param type $val
         */
		public function __set($key,$val){
		
			$_SESSION[$this->_storage][$key] = $val;
		}

        /**
         * Getters
         * Permet de récupérer le contenu de la session
         * @param type $key
         * @return boolean
         */
		public function __get($key){
			
			if(isset($_SESSION[$this->_storage][$key])){
				return $_SESSION[$this->_storage][$key];
			}
			return false;
			
		}
		
		
		
	}
?>
