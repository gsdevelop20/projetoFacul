<?php
include ('Database.php');
class Register{
    private $user_name;
    private $user_email;
    private $user_password;

    public function __construct($user_name,$user_email,$user_password)
    {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
    }

    public function userRegister(){

        $DB = new Database();
        $dbconection = $DB->conectDB();
        $sql ="insert into users (user_name,  user_email, user_password) values
        ('$this->user_name','$this->user_email','$this->user_password')";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }
        return false;
    }

}
