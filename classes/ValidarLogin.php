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
        if($this->email === 'gabrildado08@gmail.com' and $this->senha === '1234'){
            header('Location: index.php');
            return true;
        }else{
            return false;
        }

    }

    public function  is_login(){
        if ($this->validar()){
         return true;
        }
        return false;
    }

}