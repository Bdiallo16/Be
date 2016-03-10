<?php

/**
 * Classe de base pour les controlleurs
 * 
 */
abstract class baseController {

    // Instance de l'objet Session
    protected $_session;
    protected $_view;
    // Instance de l'objet Load
    protected $load;

    /**
     * Constructeur par défaut
     */
    public function __construct() {
        $this->_session = Session::getInstance();
        $this->load = new Load;
    }

    /**
     * Fonction appelé par défaut dans chaque controlleur
     */
    abstract public function index();
    

    /**
     * Getter
     * @param type $key
     * @return boolean
     */
    final public function __get($key) {
        if ($return = $this->_session->$key) {
            return $return;
        }
        return false;
    }

}

?>
