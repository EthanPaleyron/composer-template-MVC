<?php
namespace Project\Controllers;

use Project\Validator;
use Project\Models\UserManager;

abstract class Controller
{
    protected Validator $validator;
    protected UserManager $userManager;
    public function __construct()
    {
        $this->validator = new Validator();
        $this->userManager = new UserManager();
    }
}