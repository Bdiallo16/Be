<?php

/**
 * Controlleur appelé lors d'une erreur
 * Ici on peut chargé une vue pour presenter l'erreur
 */
class errorController extends baseController{
	
    
	public function index(){
		
		
	}
	/**
     * Affiche le message d'erreur
     * @param type $message
     */
	public function error($message = 'No information about the error'){
		
		echo '<pre>'.print_r($message,1).'</pre>';	
			
	}
}
