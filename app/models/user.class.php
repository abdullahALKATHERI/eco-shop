<?php
class user
{

    private $error = "";
    public function signup($POST){
        $data = array();
        $db = database::getInstance();
        $data['username'] = trim($POST['name']);
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        $repassword = trim($POST['repassword']);
        // check regular expressions - pool result 0 or 1 for email
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->error .= "Please enter a valid email <br>";
        }
        // check regular expressions - pool result 0 or 1 for user name
        if(empty($data['username']) || !preg_match("/^[a-zA-Z]+$/",$data['username']))
        {
            $this->error .= "Please enter a valid name <br>";
        }

        if($data['password'] !== $repassword){
            $this->error .= "Password do not match <br>";
        }

        if(strlen($data['password']) < 4){
            $this->error .= "Password must be at least 4 characters long <br>";
        }

        // check if email already exist
        $sql = "select * from users where email = :email limit 1";
        $arr ['email'] = $data['email'];
        $check = $db->read($sql,$arr);
        if(is_array($check)){
            $this->error .= "That email is already use <br>";
        }
        // check for address
        $data['address'] = $this->generateString(60);
        $sql = "select * from users where address = :address limit 1";
        $arr2['address'] = $data['address'];
        $check = $db->read($sql,$arr2);
        if(is_array($check)){
                $data['address'] = $this->generateString(60);
        }

        //show($this->error);

        if($this->error === ""){
            $data['rank'] = "customer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = hash('sha1',$data['password']);
            //
            $query = "insert into users(name,email,password,address,date,rank) values (:username,:email,:password,:address,:date,:rank)";
            //$db->write($query,$data);
            if($db->write($query,$data)){
                header("Location: " . ROOT . "login");
                die;
            }
        }
        $_SESSION['error'] = $this->error;

    }
    public function login($POST){

    }
    public function get_user($url){

    }
    // random text .. for address.
    private function generateString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}