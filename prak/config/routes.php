<?php

use Ven\App\Controller\FormController;
use Ven\App\Controller\HomeController;
use Ven\App\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/shifts', [HomeController::class, 'shifts']),
    Route::get('/employees', [HomeController::class, 'employees']),
    Route::get('/orders', [HomeController::class, 'orders']),
    Route::post('/sing-in', [FormController::class, 'auth']),
    Route::get('/create-shift', [FormController::class, 'createShift']),
    Route::get('/change-shift', [FormController::class, 'changeShift']),
    Route::get('/change-shift-status', [FormController::class, 'changeShiftStatus']),
    Route::post('/add-user', [FormController::class, 'addEmployee']),
    Route::get('/add-order', [FormController::class, 'addOrder']),
    Route::get('/change-order-position', [FormController::class, 'changeOrder']),
    Route::get('/new-order-status', [FormController::class, 'newOrderStatus']),
    Route::get('/dismiss', [HomeController::class, 'dismiss']),
    Route::get('/exit', [HomeController::class, 'logOut'])
];