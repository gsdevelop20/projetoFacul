<?php
include ('classes/Database.php');
include 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
include 'classes/Notas.php';
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

$user_name = $_SESSION['user_name'];

if(isset($_GET['id_note'])) {
    $id = $_GET['id_note'];
    if (isset($_POST['note'])) {
        $data = $_POST['note'];
        $title = $_POST['title'];
        $nota = new Notas($title, null, $data);

        if ($nota->updateNotes($title, $data, $id)) {
            echo 'toooop';
        }

        unset($_POST['note']);
        unset($_POST['title']);
        unset($_SESSION['id_note1']);
        unset($nota);

    }
}

$user_id = $_SESSION['user_id'];
$data = new Database();
$dbconection = $data->conectDB();

$sql ="select id_note, note_title, note_description, note_content from note where  id_user = '$user_id' order by id_note desc ";
$res = mysqli_query($dbconection,$sql);

$note_content = [];
while($rows = mysqli_fetch_array($res)) {
    $note_title[] = $rows['note_title'];
    $note_content[] = $rows['note_content'];
    $id_note[] = $rows['id_note'];

}


$nota = new Notas(null,null,'1');
echo $m->render("head", ['title' => 'meu site']); // title
echo $m->render("navbar", ['user_name' => $user_name]); // navbar
echo $m->render("btn_more",['action' => "index.php?action=new"]);

if(isset($_GET['action'])){

    echo $m->render("create",['index'=>'index.php','save'=>'create']);

}
if(isset($_POST['notes'])){
    $data1 = $_POST['notes'];
    $title1 = $_POST['titles'];
    $save = new Notas($title1,null,$data1);

    if($save->insertResgister()){
        header("Refresh: 0; url=index.php");
    }else {

    }
}
  
for($i = 0; $i<sizeof($note_content); $i++){
    $items=[];   
    if(!is_null($note_content[$i])){

        $context=[
            'note' =>   $note_content[$i],
            'title' =>   $note_title[$i],
            'id' => $id_note[$i],
            'url' => "edit.php?id_note=$id_note[$i]",
            'hidden'=> 'd-none'
        ];

        if(isset($_GET['id_note'])){
            $context['hidden'] = '';
        }
        $items[] = $context;
	}
 echo $m->render("index", ['items' => $items]);         
}

echo $m->render("js",[]);

//echo $m->render("index",['cards'=>$t, 'note'=>$g]); // "Hello, World!"
