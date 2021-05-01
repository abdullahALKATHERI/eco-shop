<?php
class signup extends controller {

    public function index(){
        $data["page_title"]= "Signup";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            show($_POST);
        }
        $this->view("signup",$data);

    }
}
