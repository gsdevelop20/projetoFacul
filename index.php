
<?php
include 'vendor\mustache\mustache\src\Mustache\Autoloader.php';
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
$g = '';

if(isset($_GET['id_note'])) {
    $id = $_GET['id_note'];
    $_SESSION['id_note1'] = $id;
}

if(isset($_POST['note'])){
    $data = $_POST['note'];
    $title = $_POST['title'];
    $nota = new Notas($title,null,$data);



    if($nota->updateNotes($title,$data)){
        echo 'toooop';
    }else {
        echo 'nooooooooooo';
    }

}

$user_id = $_SESSION['user_id'];
$dbconection = mysqli_connect('localhost','root','1234') or die('erro de conexão');
mysqli_select_db($dbconection,'notes');
$sql ="select id_note, note_title, note_description, note from note where  id_user = '$user_id' order by note_title asc ";
$res = mysqli_query($dbconection,$sql);

$note_content = [];
while($rows = mysqli_fetch_array($res)) {
    $note_title[] = $rows['note_title'];
    $note_content[] = $rows['note'];
    $id_note[] = $rows['id_note'];

}


$nota = new Notas(null,null,'1');
echo $m->render("head", ['title' => 'meu site']); // title
echo $m->render("navbar", ['user_name' => $user_name]); // navbar

if(isset($_POST['more'])){
    echo $m->render("index",[]);
}


for($i = 0; $i<sizeof($note_content); $i++){
    if(!is_null($note_content[$i])){

        $context=[
            'note' =>   $note_content[$i],
            'title' =>   $note_title[$i],
            'id' => $id_note[$i],
            'url' => "index.php?id_note=$id_note[$i]"

        ];

        echo $m->render("index",$context);
    }
}
echo $m->render("js",[]);

//echo $m->render("index",['cards'=>$t, 'note'=>$g]); // "Hello, World!"

