<?php
include 'vendor\mustache\mustache\src\Mustache\Autoloader.php';
include 'classes/Notas.php';

Mustache_Autoloader::register();
$m = new Mustache_Engine(array('loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates'),));

echo $m->render("head", ['title' => 'meu site']); // title
session_start();
$user_name = $_SESSION['user_name'];
session_abort();
echo $m->render("navbar", ['user_name' => $user_name]);
$id_note = '';
$user_id = '';

if(isset($_GET['id_note'])){
    session_start();
    $id_note = $_GET['id_note'];
    $user_id = $_SESSION['user_id'];
    session_abort();
}

$updateNote =  new Notas();
if(isset($_POST['title'])){
    $title = $_POST['title'];
    $content = $_POST['note'];

    $updateNote->updateNotes($title, $content, $id_note);

}

if(isset($_GET['action'])){
    $action = $_GET['action'];

    if($action === 'delete'){
       $delete = new Notas();
        if ($delete->deleteNota($id_note)) {
            header('Location: index.php');
        } else {
            echo 'Ocorreu um erro ao deletar sua NOTA';
        }
    }
}




$dbconection = mysqli_connect('localhost','root','1234') or die('erro de conexão');
mysqli_select_db($dbconection,'notes');
$sql ="select id_note, note_title, note_description, note_content from note where  id_user = '$user_id' and id_note = '$id_note'";
$res = mysqli_query($dbconection,$sql);

$note_content = [];
while($rows = mysqli_fetch_array($res)) {
    $note_title[] = $rows['note_title'];
    $note_content[] = $rows['note_content'];
    //$id_note[] = $rows['id_note'];

}

for($i = 0; $i<sizeof($note_content); $i++){
    if(!is_null($note_content[$i])){

        $context=[
            'note' =>   $note_content[$i],
            'title' =>   $note_title[$i],
            //'id' => $id_note[$i],
            'url' => "edit.php?id_note=$id_note[$i]",
        ];


        echo $m->render("edit",$context);
    }
}