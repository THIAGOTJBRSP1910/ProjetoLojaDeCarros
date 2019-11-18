<?php
//Estabelecendo conexão com o banco
class Database{
    public $conn;

    public function getConnection(){
        try {
            $conn = new PDO("mysql:host=localhost;port=3306;dbname=EventosDb","root","");
            $conn->exec("set names utf8");
        } catch (PDOException $ex) {
            echo "Erro ao tentar estabelecer a comunicação com o banco. ".$ex->getMessage();
        }
        return $conn;
    }
    
}



?>