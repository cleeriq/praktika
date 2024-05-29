<?php

namespace Ven\App;

use Ven\App\SQL;

class Employee {
     

    public function employeeList() {

        if (!empty($_GET['role'])) {
            $employees = SQL::select('user', 'role_id', $_GET['role']);
        } else {
            $employees = SQL::select('user');
        }

        foreach($employees as $employee) {
            echo <<<END
            <div class="employee">
                <div class="header">
                    <div>
                        <div class="image" style="background-image: url('../../user_image/{$employee['photo_file']}'); background-size: cover;"></div>
                        <div class="name">{$employee['name']}</div>
                    </div>
                    <div class="arrow">
                        <svg width="35.000000" height="35.000000" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M10.8 12.52L17.5 19.2L24.19 12.52L26.25 14.58L17.5 23.33L8.75 14.58L10.8 12.52Z" fill="#000000" fill-opacity="0.540000" fill-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="info">
                    <div class="position">Должность: {$this->employeeRole($employee['role_id'])}</div>
                    <div class="login">Логин: {$employee['login']}</div>
                    <div class="password">Пароль: {$employee['password']}</div>
                    <div class="dismiss"><a href="/dismiss?user_id={$employee['id']}">Удалить</a></div>
                </div>
            </div>
            END;
        }
    }

    public function dismissEmployee() {
        SQL::delete('user_to_shift', 'user_id', $_GET['user_id']);
        SQL::delete('user', 'id', $_GET['user_id']);
    }

    private function employeeRole($role_id) {
        $role = SQL::select('role', 'id', $role_id);
        return $role[0]['name'];
    }


    public function newEmployee() {
        $photo_file = $this->userPhoto();
        $_POST['photo_file'] = $photo_file;

        SQL::insert('user', $_POST);
    }

    private function userPhoto() {

        $name = $_FILES['photo_file']['name'];
        $temp = $_FILES['photo_file']['tmp_name'];

        $dir_path = APP_PATH.'/user_image/';

        move_uploaded_file($temp, $dir_path . $name);

        return $name;
    }


}