<?php
namespace Project\Models;

class User
{
    private int $id_user;
    private string $username;
    private string $password;
    public function setid_user($id_user): void
    {
        $this->id_user = $id_user;
    }
    public function getid_user(): int
    {
        return $this->id_user;
    }
    public function setusername($username): void
    {
        $this->username = $username;
    }
    public function getusername(): string
    {
        return $this->username;
    }
    public function setpassword($password): void
    {
        $this->password = $password;
    }
    public function getpassword(): string
    {
        return $this->password;
    }
}