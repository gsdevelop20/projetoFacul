
<?php
include 'vendor\mustache\mustache\src\Mustache\Autoloader.php';
session_start();

Mustache_Autoloader::register();
$m = new Mustache_Engine(array('loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),));
if(isset($_SESSION['require_login'])) {
    if ($_SESSION['require_login']) {
        header('Location: login.php');
    };
}else{
    header('Location: login.php');
}


echo $m->render("head", ['title' => 'meu site']); // title
echo $m->render("navbar", []); // navbar
$t[] = [
  'cards' =>'Gabriel'
];

echo $m->render("index",['cards'=>$t]); // "Hello, World!"


