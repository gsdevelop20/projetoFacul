<?php
include 'vendor\mustache\mustache\src\Mustache\Autoloader.php';

Mustache_Autoloader::register();

$m = new Mustache_Engine(array('loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),));

echo $m->render("head", ['title' => 'meu site']); // title
echo $m->render("navbar", []); // navbar

