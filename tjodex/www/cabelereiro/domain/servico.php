<?php

class Servico{
    public $idservico;
    public $tiposervico;
    public $idpreco;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from servico";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function cadastro(){
        $query = "insert into servico set tiposervico=:t, idpreco=:i";
        
        $stmt=$this->conn->prepare($query);

        $this->tiposervico = htmlspecialchars(strip_tags($this->tiposervico));
        $this->idpreco = htmlspecialchars(strip_tags($this->idpreco));

        
        $stmt->bindParam(":t",$this->tiposervico);
        $stmt->bindParam(":i",$this->idpreco);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update servico set tiposervico=:t, idpreco=:i where id=:is";
        
        $stmt=$this->conn->prepare($query);

        $this->tiposervico = htmlspecialchars(strip_tags($this->tiposervico));
        $this->idpreco = htmlspecialchars(strip_tags($this->idpreco));
        $this->idservico = htmlspecialchars(strip_tags($this->idservico));

        
        $stmt->bindParam(":t",$this->tiposervico);
        $stmt->bindParam(":i",$this->idpreco);
        $stmt->bindParam(":is",$this->idservico);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from servico where id=?";

        $stmt = $this->conn->prepare($query);

        $this->idservico=htmlspecialchars(strip_tags($this->idservico));

        $stmt->bindParam(1,$this->idservico);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


