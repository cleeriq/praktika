<?php

namespace Ven\App;

use Ven\App\SQL;
use DateTimeImmutable;

class Shift {

    public function employeesList() { 
        $waiters = SQL::select('user', 'role_id', '2');

        foreach ($waiters as $waiter) {
            echo '<option value="'.$waiter['id'].'">'.$waiter['name'].'</option>';
        }
    }

    public static function create() {
        $array = [
            'date' => $_GET['date'], 
            'start' => $_GET['start'], 
            'end' => $_GET['end'],
            'shift_status_id' => '2'
        ];

        $shift_id = SQL::insert('shift', $array);

        foreach($_GET['employees'] as $employee_id) {
            $array = [
                'user_id' => $employee_id,
                'shift_id' => "$shift_id"
            ];

            SQl::insert('user_to_shift', $array);
        }
    }

    public static function change() {
        $array = [
            'date' => $_GET['date'], 
            'start' => $_GET['start'], 
            'end' => $_GET['end']
        ];

        SQL::update('shift', 'id', $_GET['shift_id'], $array);

        SQL::delete('user_to_shift', 'shift_id', $_GET['shift_id']);

        foreach($_GET['employees'] as $employee_id) {
            $array = [
                'user_id' => $employee_id,
                'shift_id' => $_GET['shift_id']
            ];

            SQl::insert('user_to_shift', $array);
        }

    }

    public static function changeStatus() {
        $new_status_id = match ($_GET['status']) {
            '1' => '3',
            '2' => '1',
        };

        if ($new_status_id == '1') {
            $result = SQL::select("shift", 'shift_status_id', '1');
            if (!empty($result)) {
                foreach($result as $row) {
                    $new_status = [
                        'shift_status_id' => '2'
                    ];
                    SQL::update('shift', 'id', $row['id'], $new_status);
                }
            }
        }

        $array = [
            'shift_status_id' => $new_status_id
        ];

        SQL::update('shift', 'id', $_GET['shift'], $array);
        return;
    }

    public function shiftsList() {
        $shifts = SQL::select('shift', sorted:'shift_status_id');

        foreach ($shifts as $shift) {
            echo '
                <div class="shift" value="'.$shift['id'].'">
                    <div class="date">'.$shift['date'].'</div>
                    <div class="time">
                        <span class="start">'.(new DateTimeImmutable($shift['start']))->format('H:i').'</span> - 
                        <span class="end">'.(new DateTimeImmutable($shift['end']))->format('H:i').'</span>
                    </div>
                    '.$this->statusButton($shift['id'], $shift['shift_status_id']).'
                    <div class="orders">
                        <a href="/orders?shift_id='.$shift['id'].'">Заказы</a>
                    </div>
                    <div class="employees">
                        <ul>
                            '.$this->shiftEmployeesList($shift['id']).'
                        </ul>
                    </div>
                    '.$this->changeButton($shift['shift_status_id']).'
                </div>';
        }
    }

    private function shiftEmployeesList($shift_id) {
        $result = SQL::select('user_to_shift', 'shift_id', $shift_id);

        $li = [];
        foreach($result as $row) {
            $user = SQL::select('user', 'id', $row['user_id']);
            $li[] = '<li value="'.$user[0]['id'].'">'.$user[0]['name'].'</li>';
        }

        return implode(" ", $li);
    }

    private function statusButton($shift_id, $status_id) {
        return match ($status_id) {
            '1' => '<div class="button-open">
                <button><a href="/change-shift-status?shift='.$shift_id.'&status=1">Закрыть</a></button>
                </div>',
            '2' => '<div class="button">
                <button><a href="/change-shift-status?shift='.$shift_id.'&status=2">Открыть</a></button>
                </div>',
            '3' => '<div></div>'
        };
    }

    private function changeButton($status_id) {
        return match ($status_id) {
            '1' => '<div class="change-btn">Изменить</div>',
            '2' => '<div class="change-btn">Изменить</div>',
            '3' => '<div></div>'
        };
    }
}