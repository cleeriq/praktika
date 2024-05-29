<?php

namespace Ven\App;

class View {

    public function pages($page) {
        include_once APP_PATH."/views/pages/$page.php";
    }

    public function static($page, $title=NULL, $style=NULL) {
        include_once APP_PATH."/views/static/$page.php";
    }
}