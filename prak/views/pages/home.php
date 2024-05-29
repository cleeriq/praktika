<?php

use Ven\App\View;

$view = new View;


$view->static('header', 'Вход', 'style');

?>
    <div class="form-block">
        <h1>Вход</h1>
        <form method="post" action="/sing-in"> 
            <div>
                <label>Логин</label>
                <input type="text" name="login" value="<?= (!empty($_SESSION['validation'])) ? $_SESSION['validation']['login'] : '' ?>">
            </div>
            <div>
                <label>Пароль</label>
                <input type="password" name="password">
            </div>
            <small><?= (!empty($_SESSION['validation'])) ? $_SESSION['validation']['text'] : '' ?></small>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>