<?php

/* Simple Framework MVC */

define('SITE_PATH', realpath(dirname(__FILE__)) . '/');

require_once(SITE_PATH . 'application/config.php');
require_once(SITE_PATH . 'application/db.php');
require_once(SITE_PATH . 'application/request.php');
require_once(SITE_PATH . 'application/router.php');
require_once(SITE_PATH . 'application/baseController.php');
require_once(SITE_PATH . 'application/baseModel.php');
require_once(SITE_PATH . 'application/load.php');
require_once(SITE_PATH . 'application/session.php');
require_once(SITE_PATH . 'controllers/errorController.php');
require_once(SITE_PATH . 'models/usersModel.php');
require_once(SITE_PATH . 'models/etudiantsModel.php');
require_once(SITE_PATH . 'models/enseignantsModel.php');
require_once(SITE_PATH . 'models/adminModel.php');
require_once(SITE_PATH . 'models/formationsModel.php');
require_once(SITE_PATH . 'models/matieresModel.php');
require_once(SITE_PATH . 'models/devoirsModel.php');
require_once(SITE_PATH . 'models/fichiersModel.php');
require_once(SITE_PATH . 'models/fichiersattenduModel.php');
require_once(SITE_PATH . 'models/noteModel.php');
require_once(SITE_PATH . 'models/DAO/fichierDAO.php');
require_once(SITE_PATH . 'models/DAO/userDAO.php');
require_once(SITE_PATH . 'models/DAO/enseignantDAO.php');
require_once(SITE_PATH . 'models/DAO/etudiantDAO.php');
require_once(SITE_PATH . 'models/DAO/formationDAO.php');
require_once(SITE_PATH . 'models/DAO/matiereDAO.php');
require_once(SITE_PATH . 'models/DAO/devoirsDAO.php');
require_once(SITE_PATH . 'models/DAO/noteDAO.php');
try {
    Router::route(new Request);
} catch (Exception $e) {
    $controller = new errorController;
    $controller->error($e->getMessage());
}
