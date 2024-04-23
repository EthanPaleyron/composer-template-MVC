<?php
namespace Project\Models;

abstract class Manager
{
    protected \PDO $bdd;
    // connects to the database
    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    // retrieve database
    public function getBdd(): \PDO
    {
        return $this->bdd;
    }
}