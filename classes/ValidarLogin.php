<?php

class ValidarLogin{
    private $email;
    private $senha;

    public function __construct($email,$senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }

    public function validar(){
        $dbconection = mysqli_connect('localhost','root','1234') or die('erro de conexão');
        mysqli_select_db($dbconection,'notes');
        $sql ="select id_user, user_name, user_email, user_password from users";
        $res = mysqli_query($dbconection,$sql);

        while($rows = mysqli_fetch_array($res)) {
            $emails[] = $rows['user_email'];
            $senhas[] = $rows['user_password'];
            $name[] = $rows['user_name'];
            $id[] = $rows['id_user'];
        }

        for($i = 0; $i<sizeof($emails); $i++){
            if($this->email === $emails[$i] && $this->senha === $senhas[$i]){
                session_start();
                $_SESSION['user_id'] = $id[$i];
                $_SESSION['user_name'] = $name[$i];
                header('Location: index.php');
                return true;
            }
        }
        return false;
    }

    public function  is_login(){
        if ($this->validar()){
         return true;
        }
        return false;
    }

}