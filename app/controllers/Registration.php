<?php
namespace App;

use League\Plates\Engine;

class Registration
{
    private $templates;
    public function __construct(Engine $engine)
    {
        $this->templates = $engine;
    }

    
    public function index()
    {
        
        echo $this->templates->render('registration');
            
    }

    public function hello()
    {
        # code...
    }
}