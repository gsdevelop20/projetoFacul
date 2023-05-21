<?php

Mustache_Autoloader::register();
class Notas{
    private $notas_title;
    private $notas_description;
    private $notas_content;

    public function __construct($notas_title = 'Sem titulo',$notas_description = 'Sem descrição',$notas_content ='')
    {
        $this->notas_title = $notas_title;
        $this->notas_description = $notas_description;
        $this->notas_content= $notas_content;
    }

    public function insertResgister(){
        session_start();
        $user_id = $_SESSION['user_id'];

        $dbconection = mysqli_connect('localhost','root','1234') or die('erro de conexão');
        mysqli_select_db($dbconection,'notes');
        $sql ="insert into note (id_user, note_title, note_description,note) values
        ('$user_id','$this->notas_title','$this->notas_description','$this->notas_content')";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }
        return false;
    }

    public function updateNotes($tile,$note){
        session_start();
        $id = $_SESSION['id_note1'];
        $dbconection = mysqli_connect('localhost','root','1234') or die('erro de conexão');
        mysqli_select_db($dbconection,'notes');
        $sql ="UPDATE note SET note_title = '$tile', note = '$note' where id_note ='$id'";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }
        return false;

    }

}