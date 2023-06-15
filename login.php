<?php
include 'vendor\mustache\mustache\src\Mustache\Autoloader.php';
include 'classes/ValidarLogin.php';

session_start();

$context =[];

$_SESSION['require_login'] = true;
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validar = new ValidarLogin($email, $senha);

    $validar->validar();
    if ($validar->validar()){
        $_SESSION['require_login']=false;
    }else{
        $context = ['b' => 'border border-danger','c'=>"d-block"];
    }
}

Mustache_Autoloader::register();

$login = new Mustache_Engine(array('loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),));

echo $login->render("head", ['title' => 'LOGIN',]); // head html
echo $login->render("login",$context); // "Tela de login"


