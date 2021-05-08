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

    public function load_model($model){
        if(file_exists('../app/models/' . strtolower($model) . '.class.php')) {
            include '../app/models/' . strtolower($model) . '.class.php';
            return new $model();
        }

        return false;

    }

}
