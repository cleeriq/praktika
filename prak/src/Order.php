<?php

namespace Ven\App;

session_start();

class Order {


    private $active_shift;

    private $user_role;

    private $user_id;

    public function __construct() {
        $this->userInfo();
        $this->activeShift();
    }

    public function create() {

        $order_info = [
            'order_status_id' => '1',
            'shift_id' => $this->active_shift,
            'user_id' => $this->user_id
        ];

        $order_id = SQL::insert('order', $order_info);

        if (!empty($_GET['positions'])) {
            foreach($_GET['positions'] as $position_id) {
                $array = [
                    'order_id' => $order_id,
                    'position_id' => $position_id
                ];
                SQL::insert('order_to_position', $array);
            }
        }

    }

    public function change() {

        SQL::delete('order_to_position', 'order_id', $_GET['order_id']);

        foreach($_GET['positions'] as $position_id) {
            $array = [
                'order_id' => $_GET['order_id'],
                'position_id' => $position_id
            ];

            SQl::insert('order_to_position', $array);
        }
    }

    public function changeStatus() {

        $array = [
            'order_status_id' => $_GET['order_status']
        ];

        SQL::update('order', 'id', $_GET['order_id'], $array);

        $this->orderByRole();

    }

    public function positionsList() {
        $positions = SQL::select('position');

        foreach($positions as $position) {
            echo '<option value="'.$position['id'].'">'.$position['name'].'</option>';
        }
    }


    public function orderByRole() {

        match ($this->user_role) {
            '1' => $this->admin(),
            '2' => $this->waiter(),
            '3' => $this->cook()
        };
    }

    private function admin() {
        
        if (!empty($_GET['shift_id'])) {
            $result = SQL::select('order', 'shift_id', $_GET['shift_id']);

            if (!empty($result)) {
                foreach($result as $row) {
                    $status = SQL::select('order_status', 'id', $row['order_status_id']); //отдельный метод
                    $status = '<div class="status-value">'.$status[0]['name'].'</div>';

                    $waiter = SQL::select('user', 'id', $row['user_id']);
                    $waiter = '<div class="waiter">Официант:<div>'.$waiter[0]['name'].'</div></div>'; //отдельный метод


                    $positions = $this->positions($row['id']);

                    echo $this->order($row['id'], $positions, $status, waiter:$waiter);
                }

            }
        }
    }

    private function waiter() {
        $result = SQL::select('order', 'shift_id', $this->active_shift, 'user_id', $this->user_id);

        foreach ($result as $row) {

            $positions = $this->positions($row['id']);
            $change = ($row['order_status_id'] == '1') ?  '<div class="change-order">Изменить</div>' : "" ;

            $status = match ($row['order_status_id']) {
                '1' => '<select  name="order_status">
                            <option value="1" selected>Принят</option>
                            <option value="5">Отменен</option>
                        </select>',
                '2' => '<div class="status-value">Готовится</div>', 
                '3' => '<select name="order_status">
                            <option disabled hidden selected >Готов</option>
                            <option value="4">Оплачен</option>
                            <option value="5">Отменен</option>
                        </select>', 
                '4' => '<div class="status-value">Оплачен</div>', 
                '5' => '<div class="status-value">Отменен</div>'
            };


            echo $this->order($row['id'], $positions, $status, $change);

        }
        
        
    }

    public function checkWaiter() {
        $waiters = SQL::select('user_to_shift', 'shift_id', $this->active_shift);
        foreach($waiters as $row) {
            if ($row['user_id'] == $this->user_id) {
                return '<button class="trigger">Добавить</button>';
            }
        }

        return '';
    }

    private function cook() {
        $result = SQL::select('order', 'shift_id', $this->active_shift, 'order_status_id', ['1', '2', '3']);

        foreach ($result as $row) {
            $positions = $this->positions($row['id']);

            $status = match ($row['order_status_id']) {
                '1' => '<select  name="order_status">
                            <option disabled hidden selected>Принят</option>
                            <option value="2">Готовится</option>
                            <option value="3">Готов</option>
                        </select>',
                '2' => '<select  name="order_status">
                            <option disabled hidden selected>Готовится</option>
                            <option value="3">Готов</option>
                        </select>', 
                '3' => '<div class="status-value">Готов</div>'
            };

            echo $this->order($row['id'], $positions, $status);
        }
    }

    private function order($order_id, $positions=NULL, $status=NULL, $change=NULL, $waiter=NULL) {
        return <<<END
                <div class="order" value="$order_id">
                    <div class="header">
                        <div>
                            <div class="status">Статус:</div>
                            {$status}
                            {$change}
                        </div>
                    </div>
                    <div class="positions">
                        <ul>
                        {$positions}
                        </ul>
                    </div>
                    {$waiter}
                </div>
        END;
    }

    private function positions($order_id) {
        $positions = SQL::select('order_to_position', 'order_id', $order_id); //отдельный метод
        $positionsList = [];
        foreach($positions as $position) {
            $name = SQL::select('position', 'id', $position['position_id']);
            $positionsList[] = '<li value="'.$position['position_id'].'">'.$name[0]['name'].'</li>';
        }
        return implode(" ", $positionsList);
    }

    private function userInfo() {
        $user = $_SESSION['user'];

        $this->user_id = $user->info['id'];
        $this->user_role = $user->info['role_id'];

    }

    private function activeShift() {
        $result = SQL::select('shift', 'shift_status_id', '1');

        if (!empty($result)) {
            $this->active_shift = $result[0]['id'];
        }
    }


}