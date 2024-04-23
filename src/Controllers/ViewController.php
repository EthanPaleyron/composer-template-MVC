<?php
namespace Project\Controllers;

class ViewController extends Controller
{
    public function showHome(): void
    {
        // redirection to the homepage
        require VIEWS . 'index.php';
    }
    public function showLogin(): void
    {
        // if the user is not logged in, he is redirected to the homepage
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
        }
        require VIEWS . 'Auth/login.php';
    }
    public function showRegister(): void
    {
        // if the user is not logged in, he is redirected to the homepage
        if (isset($_SESSION["user"]["username"])) {
            header("Location: /");
        }
        require VIEWS . 'Auth/register.php';
    }
}