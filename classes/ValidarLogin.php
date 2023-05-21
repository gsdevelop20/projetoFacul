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
        $sql ="select id_user, user_nome, use_Email, user_Senha from users";
        $res = mysqli_query($dbconection,$sql);

        while($rows = mysqli_fetch_array($res)) {
            $emails[] = $rows['use_Email'];
            $senhas[] = $rows['user_Senha'];
            $name[] = $rows['user_nome'];
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