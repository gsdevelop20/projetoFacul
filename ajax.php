<?php

$id_note = '';
$user_id = '';

if(isset($_GET['id_note'])){
    session_start();
    $id_note = $_GET['id_note'];
    $user_id = $_SESSION['user_id'];
    session_abort();
}

echo oi;