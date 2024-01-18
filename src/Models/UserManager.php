<?php
namespace Project\Models;

use Project\Models\User;

class UserManager
{
    private \PDO $bdd;
    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function getBdd(): \PDO
    {
        return $this->bdd;
    }
    public function find($username): User|bool
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute(
            array(
                $username
            )
        );
        $stmt->setFetchMode(\PDO::FETCH_CLASS, "Project\Models\User");
        return $stmt->fetch();
    }
    public function getAll(): array|bool
    {
        $stmt = $this->bdd->query('SELECT * FROM users');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, "Project\Models\User");
    }
    public function store($password): void
    {
        $stmt = $this->bdd->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute(
            array(
                $_POST["username"],
                $password
            )
        );
    }
}