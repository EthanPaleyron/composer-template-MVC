<?php
namespace Project\Controllers;

use Project\Models\UserManager;
use Project\Validator;

class UserController
{
    private UserManager $manager;
    private Validator $validator;
    public function __construct()
    {
        $this->manager = new UserManager();
        $this->validator = new Validator();
    }
    public function index(): void
    {
        require VIEWS . 'index.php';
    }
    public function showLogin(): void
    {
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
            die();
        }
        require VIEWS . 'Auth/login.php';
    }
    public function showRegister(): void
    {
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
            die();
        }
        require VIEWS . 'Auth/register.php';
    }
    public function logout(): void
    {
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        session_start();
        session_destroy();
        header('Location: /login');
    }
    public function register(): void
    {
        $this->validator->validate([
            "username" => ["required", "min:1", "alphaNum"],
            "password" => ["required", "min:8", "alphaNum", "confirm"]
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) {
            $result = $this->manager->find($_POST["username"]);
            if (empty($result)) {
                // HACHE LE MOTS DE PASSE POUR PAS VOIR LE VRAI MOTS DE PASSE EN BDD
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($password);

                $_SESSION["user"] = [
                    "id" => $this->manager->getBdd()->lastInsertId(),
                    "username" => $_POST["username"]
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['username'] = "Le username choisi est déjà utilisé !";
                header("Location: /register");
            }
        } else {
            header("Location: /register");
        }
    }
    public function login(): void
    {
        $this->validator->validate([
            "username" => ["required", "min:1", "alphaNum"],
            "password" => ["required", "min:8", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) {
            $result = $this->manager->find($_POST["username"]);
            if ($result && password_verify($_POST['password'], $result->getpassword())) {
                $_SESSION["user"] = [
                    "id" => $result->getid_user(),
                    "username" => $result->getusername(),
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
}