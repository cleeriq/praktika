<?php

use Ven\App\View;
use Ven\App\Employee;

$view = new View;
$employee = new Employee;


$view->static('header', 'Сотрудники', 'style_em');

?>
    <div class="add-bg">
        <div class="add-block">
            <div class="close">
            <svg width="20.000000" height="20.000000" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="20.000000" height="20.000000" fill="#FFFFFF" fill-opacity="0"/>
                <path d="M12.09 9.94L17.09 4.9C17.32 4.67 17.32 4.32 17.09 4.09L16.32 3.28C16.09 3.05 15.75 3.05 15.51 3.28L10.48 8.32C10.32 8.48 10.09 8.48 9.94 8.32L4.9 3.25C4.67 3.01 4.32 3.01 4.09 3.25L3.28 4.05C3.05 4.28 3.05 4.63 3.28 4.86L8.32 9.9C8.48 10.05 8.48 10.28 8.32 10.44L3.25 15.51C3.01 15.75 3.01 16.09 3.25 16.32L4.05 17.13C4.28 17.36 4.63 17.36 4.86 17.13L9.9 12.09C10.05 11.94 10.28 11.94 10.44 12.09L15.48 17.13C15.71 17.36 16.05 17.36 16.28 17.13L17.09 16.32C17.32 16.09 17.32 15.75 17.09 15.51L12.09 10.48C11.94 10.32 11.94 10.09 12.09 9.94L12.09 9.94Z" fill="#706E6B" fill-opacity="1.000000" fill-rule="evenodd"/>
            </svg>
            </div>
            <form id="addForm" method="POST" action="/add-user" enctype="multipart/form-data">
                <div>
                    <label>Имя</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Логин</label>
                    <input type="text" name="login">
                </div>
                <div>
                    <label>Пароль</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <label>Фотография</label>
                    <input type="file" name="photo_file" id="photo_file">
                </div>
                <div>
                    <label>Должность</label>
                    <select name="role_id">
                        <option disabled selected hidden></option>
                        <option value="1">Администратор</option>
                        <option value="2">Официант</option>
                        <option value="3">Повар</option>
                    </select>
                </div>
                <button type="submit">Добавить</button>
            </form>
        </div>
    </div>
    <header>
        <nav>
            <a href="/shifts">смены</a>
            <a href="/employees">сотрудники</a>
        </nav>
        <div>
            <a href="/exit">
                <svg width="30.000000" height="30.000000" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <clipPath id="clip6_77">
                            <rect id="sign-out-alt" width="30.000000" height="30.000000" fill="white" fill-opacity="0"/>
                        </clipPath>
                    </defs>
                    <rect id="sign-out-alt" width="30.000000" height="30.000000" fill="#FFFFFF" fill-opacity="0"/>
                    <g clip-path="url(#clip6_77)">
                        <path id="Vector" d="M22.5 5L25 5L25 25L22.5 25L22.5 5Z" fill="#1C2E45" fill-opacity="1.000000" fill-rule="evenodd"/>
                        <path id="Vector" d="M15 12.5L5 12.5L5 17.5L15 17.5L15 21.25L21.25 15L15 8.75L15 12.5Z" fill="#1C2E45" fill-opacity="1.000000" fill-rule="evenodd"/>
                    </g>
                </svg>
            </a>
        </div>
    </header>
    <div class="container">
        <div class="content">
            <button class="trigger">Добавить</button>
            <select class="role">
                <option value="">Все должности</option>
                <option value="2">Официанты</option>
                <option value="3">Повара</option>
                <option value="1">Администраторы</option>
            </select>
            <div class="employees-list">
                <? $employee->employeeList() ?>
            </div>
        </div>
    </div>
<? $view->static("footer", "em"); ?>