<?php

class Horario{
    public $idhorario;
    public $idcliente;
    public $idservico;
    public $idprofissinal;
    public $idunidade;
    public $dia;
    public $hora;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from horario";

        $stmt = $this->conn->prepare($query);

        $stmt->execute()

        return $stmt;
    }

    public function cadastro(){
        $query = "insert into horario set idcliente=:ic, idservico=:is, idprofissinal=:ip, idunidade=:iu, dia=:d, hora=:h";
        
        $stmt=$this->conn->prepare($query);

        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->idservico = htmlspecialchars(strip_tags($this->idservico));
        $this->idprofissinal = htmlspecialchars(strip_tags($this->idprofissinal));
        $this->iduniade = htmlspecialchars(strip_tags($this->idunidade));
        $this->dia = htmlspecialchars(strip_tags($this->dia));
        $this->hora = htmlspecialchars(strip_tags($this->hora));


        $stmt->bindParam(":ic",$this->idcliente));
        $stmt->bindParam(":is",$this->idservico));
        $stmt->bindParam(":ip",$this->idprofissinal));
        $stmt->bindParam(":iu",$this->idunidade));
        $stmt->bindParam(":d",$this->dia));
        $stmt->bindParam(":h",$this->hora));


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update horario set idcliente=:ic, idservico=:is, idprofissinal=:ip, idunidade=:iu, dia=:d, hora=:h where idhorario=:ih";
        
        $stmt=$this->conn->prepare($query);

        $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
        $this->idservico = htmlspecialchars(strip_tags($this->idservico));
        $this->idprofissinal = htmlspecialchars(strip_tags($this->idprofissinal));
        $this->iduniade = htmlspecialchars(strip_tags($this->idunidade));
        $this->dia = htmlspecialchars(strip_tags($this->dia));
        $this->hora = htmlspecialchars(strip_tags($this->hora));
        $this->idhorario = htmlspecialchars(strip_tags($this->idhorario));


        $stmt->bindParam(":ic",$this->idcliente));
        $stmt->bindParam(":is",$this->idservico));
        $stmt->bindParam(":ip",$this->idprofissinal));
        $stmt->bindParam(":iu",$this->idunidade));
        $stmt->bindParam(":d",$this->dia));
        $stmt->bindParam(":h",$this->hora));
        $stmt->bindParam(":ih",$this->idhorario));


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from horario where id=?";

        $stmt = $this->conn->prepare($query);

        $this->idhorario=htmlspecialchars(strip_tags($this->idhorario));

        $stmt->bindParam(1,$this->idcliente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


