<?php
class controller{
    public function view($view, $data = []){
        if(file_exists('../app/views/' . THEAM . $view . '.php')) {
            include '../app/views/' . THEAM . $view . '.php';
        }
        else{
            include '../app/views/' . THEAM . '404.php';
        }
    }

}
