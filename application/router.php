<?php

/**
 * Classe routeur permet d'executer le bon controlleur et la bonne fonction du controlleur suivant l'URL
 */
	class Router{
		
        /**
         * Fonction qui recupere le bon controlleur et la fonction 
         * 
         * @param Request $request
         * @return type
         * @throws Exception
         */
		public static function route(Request $request){
			
			$controller = $request->getController().'Controller';
			$method = $request->getMethod();
			$args = $request->getArgs();

			$controllerFile = SITE_PATH.'controllers/'.$controller.'.php';

			if(is_readable($controllerFile)){
				require_once $controllerFile;
				
				$controller = new $controller;
				$method = (is_callable(array($controller,$method))) ? $method : 'index';	
				
				if(!empty($args)){
					call_user_func_array(array($controller,$method),$args);
				}else{	
					call_user_func(array($controller,$method));
				}	
				return;
			}
				
			throw new Exception('404 - '.$request->getController().' not found');
		}
		
		/**
         * Fonction qui execute le bon controlleur et la fonction
         * @param type $controller
         * @param type $method
         * @param type $args
         * @return type
         * @throws Exception
         */
		public static function call($controller, $method = 'index', $args = array()){
			
			$controller = $controller.'Controller';
			$controllerFile = SITE_PATH.'controllers/'.$controller.'.php';
			
			if(is_readable($controllerFile)){
				require_once $controllerFile;
				
				$controller = new $controller;
				$method = (is_callable(array($controller,$method))) ? $method : 'index';	
				
				if(!empty($args)){
					if(!is_array($args)){
						$args = array($args);
					}
					call_user_func_array(array($controller,$method),$args);
				}else{	
					call_user_func(array($controller,$method));
				}	
				return;
			}
			
			throw new Exception('404 - '.$controller.' not found');
			
		}
		
        /**
         * Créer une url
         * 
         * @param type $uri
         * @return type
         */
		private static function site_url($uri){
			return BASE_URL.$uri;
		}
		
        /**
         * Fait une redirection
         * 
         * @param type $uri
         * @param type $method
         * @param type $http_response_code
         */
		public static function redirect($uri = '', $method = 'location', $http_response_code = 302)
		{
			if ( ! preg_match('#^https?://#i', $uri))
			{
				if(SITE_DIRECTORY != "")
					$uri = "/".SITE_DIRECTORY.$uri;
				$uri = Router::site_url($uri);
			}
	
			switch($method)
			{
				case 'refresh'	: header("Refresh:0;url=".$uri);
					break;
				default			: header("Location: ".$uri, TRUE, $http_response_code);
					break;
			}
			exit;
		}
	}
		
		
	
