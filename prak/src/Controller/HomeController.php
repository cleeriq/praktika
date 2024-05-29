<?php

namespace Ven\App\Controller;
use Ven\App\Employee;
session_start();

use Ven\App\View;

class HomeController {

    private $view;
    private $user;

    public function __construct(){
        $this->view = new View;
        $this->issetUser();
    }

    public function index() {
        $this->view->pages('home');
    }
    public function shifts() {
        if (!empty($this->user)) {
            if ($this->user->info['role_id'] == '1') {
                $this->view->pages('shifts');
            }
        }
    }
    public function employees() {
        if (!empty($this->user)) {
            if ($this->user->info['role_id'] == '1') {
                $this->view->pages('employees');
            }
        }

    }
    public function orders() {
        if (!empty($this->user)) {
            $this->view->pages('orders');
        }
        
    }

    public function dismiss() {
        if (!empty($this->user)) {
            if ($this->user->info['role_id'] == '1') {
                (new Employee)->dismissEmployee();
                header('Location: '.$_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function logOut() {
        session_destroy();
        header('Location: /home');
    }

    private function issetUser() {
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        }
    }

    
}