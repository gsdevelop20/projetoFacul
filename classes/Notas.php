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
        $DB = new Database();
        $dbconection = $DB->conectDB();
        $sql ="insert into note (id_user, note_title, note_description,note_content) values
        ('$user_id','$this->notas_title','$this->notas_description','$this->notas_content')";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }
        return false;
    }

    public function updateNotes($title,$note,$id_note){

        $DB = new Database();
        $dbconection = $DB->conectDB();
        $sql ="UPDATE note SET note_title = '$title', note_content = '$note' where id_note ='$id_note'";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }
        return false;


    }

    public function deleteNota($id_note){
        $DB = new Database();
        $dbconection = $DB->conectDB();

        $sql ="DELETE FROM note WHERE id_note ='$id_note';";

        if (mysqli_query($dbconection, $sql)) {
            return true;
        }else {
            return false;
        }

    }

}
