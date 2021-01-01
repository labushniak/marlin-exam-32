<?php
namespace App;

use League\Plates\Engine;
use Delight\Auth\Auth;
use \Tamtamchik\SimpleFlash\Flash;
use \App\Session;


class Registration
{
    private $templates, $auth, $flash, $SiteParams;
    public function __construct(Engine $engine, Auth $auth, Flash $flash, Session $session)
    {
        $this->templates = $engine;
        $this->auth = $auth;
        $this->flash = $flash;
        $this->session = $session;
        
    }

    
    public function index()
    {
        
        if($_POST['submit']){
            try {
                $userId = $this->auth->register($_POST['email'], $_POST['password']);
            
                $this->flash->success('We have signed up a new user with the ID ' . $userId);
                header('Location: /login');
            }
            catch (\Delight\Auth\InvalidEmailException $e) {
                $this->flash->warning('Invalid email address');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                $this->flash->warning('Invalid password');
            }
            catch (\Delight\Auth\UserAlreadyExistsException $e) {
                $this->flash->warning('User already exists');
            }
            catch (\Delight\Auth\TooManyRequestsException $e) {
                $this->flash->warning('Too many requests');
            }
        }
        
        echo $this->templates->render('registration', ['flash' => $this->flash->display()]);
            
    }

}