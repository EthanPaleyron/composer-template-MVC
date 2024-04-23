<?php
namespace Project\Models;

use Project\Models\User;

class UserManager extends Manager
{
    public function find($username) // get user by name
    {
        $stmt = $this->bdd->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute(
            array(
                $username
            )
        );
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "Project\Models\User");
        return $stmt->fetch();
    }
    public function store($password): void // add new user
    {
        $stmt = $this->bdd->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->execute(
            array(
                $_POST["username"],
                $password
            )
        );
    }
}