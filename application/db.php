<?php

    /**
     * Classe de gestion de la base de donnée
     * Gère les connections
     */
	class DB
	{
	    private static $connecte = false;
	    private static $db = null;
	    
	    private static $error;
	    private static $message; 
	    
        /**
         * Contructeur
         */
	    private function DB()
	    {
	        try
	        {
	            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8"; 
	            DB::$db = new PDO(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD,$pdo_options);
                DB::$connecte = true;
	        }
	        catch (Exception $e)
	        {
	            die('Erreur : ' . $e->getMessage());
	        }
	    }
	     
        /**
         * Connection à la base de données
         * @return type la connexion
         */
	    public static function Connect()
	    {
	        if (!DB::$connecte){
	            $obj = new DB();
	            return DB::$db;
	        }
	        else
	            return DB::$db;
	    }
	     
        /**
         * Deconnecte de la base de données
         */
	    public static function Disconnect()
	    {
	        DB::$connecte = false;
	        DB::$db = null;
	    }
	     
        /**
         * Test si la connexion est etablie
         * @return type vrai si connecté, faux sinon
         */
	    public static function IsConnected()
	    {
	        return DB::$connecte;
	    }
	    
        /**
         * Modifie le message d'erreur
         * @param type $message
         */
	    public static function setError($message = ""){
		    DB::$error = true;
		    DB::$message = $message;
	    }
	    
        /**
         * Vérifie si il y a eu une erreur
         * @return type
         */
	    public static function hasError(){
		    return DB::$error;
	    }
	    
        /**
         * Obtient le dernier message d'erreur
         * @return type
         */
	    public static function getMessage(){
	    	DB::$error = false;
			return DB::$message;
		}
	 
	}
	
?>