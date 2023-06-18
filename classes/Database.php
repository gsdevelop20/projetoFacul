<?php

class Database{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '1234';
    private $table = 'notes';

    private $conection;

    public function __construct(){
    }
    public function conectDB(){
        $dbconection = mysqli_connect($this->hostname,$this->username,$this->password,$this->table) or die('erro de conexão');
        $this->conection = $dbconection;
        return $this->conection;
    }
    public function disconectDB(){
        mysqli_close($this->conection);
    }

}
