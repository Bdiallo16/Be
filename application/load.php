<?php
    
    /**
     * Classe permettant de charger correctement les ressources de l'appli
     */
	class Load{
		
        /**
         * Charge la vue
         * @param type $name
         * @param array $vars
         * @return boolean
         * @throws Exception
         */
		public function view($name,array $vars = null){
			$file = SITE_PATH.'views/'.$name.'View.php';

			if(is_readable($file)){

				if(isset($vars)){
					extract($vars);
				}
				require($file);
				return true;
			}
			throw new Exception('View issues');
		}
		
        /**
         * Charge la DAO
         * @param type $name
         * @return boolean
         * @throws Exception
         */
		public static function DAO($name){
            $model = $name.'DAO';
			$modelPath = SITE_PATH.'models/DAO/'.$model.'.php';
			
			if(is_readable($modelPath)){
				require_once($modelPath);
				if(class_exists($model)){
					return true;
				}
			}
			throw new Exception('DAO ('.$name.') issues.');
        }
        
		/**
         * Charge le model
         * @param type $name
         * @return boolean
         * @throws Exception
         */
		public function model($name){
			$model = $name.'Model';
			$modelPath = SITE_PATH.'models/'.$model.'.php';

			if(is_readable($modelPath)){
				require_once($modelPath);

				if(class_exists($model)){
					return true;
				}
			}
			throw new Exception('Model issues.');	
		}
		
		/**
         * Retourne le chemin de la vue
         * @param type $name
         * @return string
         */
		public static function getView($name){
			
			$file = SITE_PATH.'views/'.$name.'View.php';

			if(is_readable($file)){
				return $file;
			}
			
		}
		
        /**
         * Retourne le chemin du fichier CSS
         * @param type $stylesheet
         * @return type
         */
		public static function css($stylesheet){
			if(SITE_DIRECTORY != "")
				return "/".SITE_DIRECTORY."/assets/css/".$stylesheet.".css";
			return "/assets/css/".$stylesheet.".css";
		}
		
        
        /**
         * Retourne le chemin du fichier JavaScript
         * @param type $script
         * @return type
         */
		public static function js($script){
			if(SITE_DIRECTORY != "")
				return "/".SITE_DIRECTORY."/assets/js/".$script.".js";
			return "/assets/js/".$script.".js";
		}
		
        /**
         * Retourne le chemin d'une image
         * @param type $img
         * @return type
         */
		public static function image($img){
			if(SITE_DIRECTORY != "")	
				return "/".SITE_DIRECTORY."/assets/img/".$img;
			return "/assets/img/".$img;
		}
		
        /**
         * Créer l'url pour le lien passé en paramètre  ex : "/" -> "http://localhost/"
         * @param type $l
         * @return type
         */
		public static function link($l){
			if(SITE_DIRECTORY != "")	
				return "/".SITE_DIRECTORY.$l;
			return $l;
		}
		
		
		
		
		
	}
