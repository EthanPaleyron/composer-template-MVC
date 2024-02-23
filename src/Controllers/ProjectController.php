<?php
namespace Project\Controllers;

use Project\Validator;

class ProjectController
{
    private Validator $validator;
    public function __construct()
    {
        $this->validator = new Validator();
    }
    public function index(): void
    {
        require VIEWS . 'index.php';
    }
}