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
    public function showLogin(): void
    {
        // Si l'utilisateur n'est pas connecter on le redirige sur l'homepage
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
            die();
        }
        require VIEWS . 'Auth/login.php';
    }
    public function showRegister(): void
    {
        // Si l'utilisateur n'est pas connecter on le redirige sur l'homepage
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
            die();
        }
        require VIEWS . 'Auth/register.php';
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
            if (empty($result)) { // Si l'username existe deja en BDD
                // hache le mots de passe pour pas voir le vrai mots de passe en bdd
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->manager->store($password);

                $_SESSION["user"] = [
                    "id" => $this->manager->getBdd()->lastInsertId(),
                    "username" => $_POST["username"]
                ];
                header("Location: /");
            } else { // Sinon on affiche un message d'erreur
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
            if ($result && password_verify($_POST['password'], $result->getpassword())) { // Si l'username existe deja en BDD et que le password corespond au password enregistrer en BDD de l'user
                // On enregistre sont nom et identifient en session
                $_SESSION["user"] = [
                    "id" => $result->getid_user(),
                    "username" => $result->getusername(),
                ];
                header("Location: /");
            } else { // Sinon on affiche un message d'erreur
                $_SESSION["error"]['message'] = "Une erreur sur les identifiants";
                header("Location: /login");
            }
        } else {
            header("Location: /login");
        }
    }
    public function logout(): void
    {
        // Si l'utilisateur n'est pas connecter on le redirige au login
        if (!isset($_SESSION["user"]["username"])) {
            header("Location: /login");
            die();
        }
        // Sinon on efface sa session et redirige au login
        session_start();
        session_destroy();
        header('Location: /login');
    }
}