<?php

class Curso{
    public $id;
    public $titulocurso;
    public $area;
    public $datacurso;
    public $diasemana;
    public $horario;

    /*
    Construtor da classe Curso
    */
    public function __construct($db){
        $this->conn = $db;
    }
    public function listar(){
        $query = "Select * from tbcurso order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function listarInformatica(){
        $query = "Select * from tbcurso where area = 'Informatica' order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function listarAdministracao(){
        $query = "Select * from tbcurso where area = 'Administração' order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function listarFotografia(){
        $query = "Select * from tbcurso where area = 'Fotografia' order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function cadastro(){
        $query = "insert into tbcurso set titulocurso=:t,area=:a,datacurso=:d,diasemana=:s,horario=:h";

        $stmt = $this->conn->prepare($query);
        /*
        Vamos preparar os dados que estão vindo no formato json
        para serem inseridos no banco de dados.

        */
        $this->titulocurso = htmlspecialchars(strip_tags($this->titulocurso));
        $this->area = htmlspecialchars(strip_tags($this->area));
        $this->datacurso = htmlspecialchars(strip_tags($this->datacurso));
        $this->diasemana = htmlspecialchars(strip_tags($this->diasemana));
        $this->horario = htmlspecialchars(strip_tags($this->horario));

        /*
        passagem dos parametros para a consulta de insert
        */
        $stmt->bindParam(":t",$this->titulocurso);
        $stmt->bindParam(":a",$this->area);
        $stmt->bindParam(":d",$this->datacurso);
        $stmt->bindParam(":s",$this->diasemana);
        $stmt->bindParam(":h",$this->horario);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}



?>