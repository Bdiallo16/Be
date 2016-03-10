<?php

abstract class UsersModel extends BaseModel {

    protected $id;
    protected $nom = "undefined";
    protected $prenom = "undefined";
    protected $tel;
    protected $email;
    protected $login;
    protected $password;
    protected $data = array();

    protected function construct_from($info) {

        if (isset($info->id)) {
            $this->id = $info->id;
        }
        if (isset($info->nom)) {
            $this->nom = $info->nom;
        }
        if (isset($info->prenom)) {
            $this->prenom = $info->prenom;
        }
        if (isset($info->tel)) {
            $this->tel = $info->tel;
        }
        if (isset($info->email)) {
            $this->email = $info->email;
        }

        if (isset($info->login)) {
            $this->login = $info->login;
        }
        if (isset($info->password)) {
            $this->password = $info->password;
        }
    }

    abstract public function save();

    abstract public function update();

    abstract public function delete();

    abstract public function isAdmin();

    abstract public function isEtudiant();

    abstract public function isEnseignant();

    public static function Login($login, $pass) {

        return UserDAO::connection($login, $pass);
    }

    public static function Logout() {
        session_unset();
        session_destroy();
    }

    public function isConnected() {
        return true;
    }

    public function __get($key) {

        switch ($key) {
            case 'nom':
                return $this->nom;
            case 'prenom':
                return $this->prenom;
            case 'tel':
                return $this->tel;
            case 'email':
                return $this->email;
            case 'id':
                return $this->id;
            case 'privilege':
                return $this->privilege;
            case 'login':
                return $this->login;
            case 'password':
                return $this->password;

            default :
                if (isset($data[$key]))
                    return $this->data[$key];
                return false;
        }
    }

    public function __set($key, $value) {
        switch ($key) {
            case 'nom':
                $this->nom = $value;
                break;
            case 'prenom':
                $this->prenom = $value;
                break;
            case 'tel':
                $this->tel = $value;
                break;
            case 'email':
                $this->email = $value;
                break;
            case 'login':
                $this->login = $value;
                break;
            case 'password':
                $this->password = $value;
                break;

            default :
                $this->data[$key] = $value;
                return false;
        }
    }

    public function json_encode() {
        return array("user" => array(
                "id" => $this->id,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "tel" => $this->tel,
                "email" => $this->email,
                "login" => $this->login,
                "password" => $this->password));
    }

}

?>