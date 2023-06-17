<?php
include 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
include 'classes/Register.php';

$context = [];

if(isset($_POST['email'])) {
    $nome =  $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['senha'];

    $resgister = new Register($nome,$email, $password);


    if($resgister->userRegister()){
        header('Location: login.php');
    }else {
        $context = ['b' => 'border border-danger', 'c' => "d-block"];
    }

}







Mustache_Autoloader::register();

$resgister = new Mustache_Engine(array('loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),));

echo $resgister->render("head", ['title' => 'Cadastro',]); // head html
echo $resgister->render("register",$context); // tela de cadastro
