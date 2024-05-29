<?php

namespace Ven\App\Controller;

use Ven\App\Auth;
use Ven\App\Employee;
use Ven\App\Order;
use Ven\App\Shift;

class FormController {

    public function auth() {
        Auth::authentication();
    }

    public function createShift() {
        Shift::create();
        header('Location: /shifts');
    }

    public function changeShift() {
        Shift::change();
        header('Location: /shifts');
    }

    public function changeShiftStatus() {
        Shift::changeStatus();
        header('Location: /shifts');
    }

    public function addEmployee() {
        (new Employee)->newEmployee();
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    public function addOrder() {
        (new Order())->create();
        header('Location: /orders');
    }

    public function changeOrder() {
        (new Order())->change();
        header('Location: /orders');
    }

    public function newOrderStatus() {
        return (new Order())->changeStatus();
        // header('Location: /orders');
    }
}