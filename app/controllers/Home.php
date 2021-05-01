<?php
    class home extends controller {

       public function index(){
           $data["page_title"]= "Home";
           $this->view("index",$data);

        }
    }
