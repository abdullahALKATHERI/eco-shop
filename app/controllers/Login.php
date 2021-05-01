<?php
class login extends controller {

    public function index(){
        $data["page_title"]= "login";
        $this->view("login",$data);

    }
}