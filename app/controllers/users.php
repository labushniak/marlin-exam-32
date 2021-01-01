<?php
namespace App;

use League\Plates\Engine;

class Users
{
    private $templates;
    public function __construct(Engine $engine)
    {
        $this->templates = $engine;
    }

    
    public function index()
    {
        
        echo $this->templates->render('users');
            
    }

    public function hello()
    {
        # code...
    }
}