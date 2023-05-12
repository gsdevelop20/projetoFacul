<?php  

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
include 'vendor\mustache\mustache\src\Mustache\Engine.php';
$m = new Mustache_Engine();
echo $m->render('Hello, {{planet}}!', ['planet' => 'World']); // "Hello, World!"