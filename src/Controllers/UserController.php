<?php
namespace Project\Controllers;

class UserController extends Controller
{
    public function register(): void
    {
        $this->validator->validate([
            "username" => ["required", "min:1", "alphaNum"],
            "password" => ["required", "min:8", "alphaNum", "confirm"]
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) { // if the validator is not incorect
            $result = $this->userManager->find($_POST["username"]);
            if (empty($result)) { // if the username already exists in the DB
                // hash the password so you don't see the real password in the database
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $this->userManager->store($password);
                // adds in-session registration information
                $_SESSION["user"] = [
                    "id" => $this->userManager->getBdd()->lastInsertId(),
                    "username" => $_POST["username"]
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['username'] = "The chosen username is already in use!";
                // $_SESSION["error"]['username'] = "Le nom d'utilisateur choisi est déjà utilisé !";
                header("Location: /register/");
            }
        } else {
            header("Location: /register/");
        }
    }
    public function login(): void
    {
        $this->validator->validate([
            "username" => ["required", "min:1", "alphaNum"],
            "password" => ["required", "min:8", "alphaNum"]
        ]);
        $_SESSION['old'] = $_POST;
        if (!$this->validator->errors()) { // if the validator is not incorect
            $result = $this->userManager->find($_POST["username"]);
            if ($result && password_verify($_POST['password'], $result->getpassword())) { // Si l'username existe deja en BDD et que le password corespond au password enregistrer en BDD de l'user
                // add in session the information retrieved from the database
                $_SESSION["user"] = [
                    "id" => $result->getid_user(),
                    "username" => $result->getusername(),
                ];
                header("Location: /");
            } else {
                $_SESSION["error"]['message'] = "An error on the login";
                // $_SESSION["error"]['message'] = "Une erreur lors de la connexion";
                header("Location: /login/");
            }
        } else {
            header("Location: /login/");
        }
    }
    public function logout(): void
    {
        // if the user is logged in, the session is deleted and redirected to the login screen
        if (isset($_SESSION["user"]["username"])) {
            session_start();
            session_destroy();
        }
        header("Location: /login/");
    }
}