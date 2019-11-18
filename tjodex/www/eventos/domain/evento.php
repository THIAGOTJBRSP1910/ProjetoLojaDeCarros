<?php

class Evento{
    public $id;
    public $tituloevento;
    public $atracao;
    public $descricao;
    public $censura;
    public $endereco;
    public $lotacao;
    public $dataevento;
    public $hora;

    /*
    Construtor da classe Curso
    */
    public function __construct($db){
        $this->conn = $db;
    }
    public function listar(){
        $query = "Select * from tbeventos order by id desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    

    public function cadastro(){
        $query = "insert into tbeventos set tituloevento=:t,atracao=:a,descricao=:de,censura=:c,endereco=:e,lotacao=:l,dataevento=:da,hora=:h";

        $stmt = $this->conn->prepare($query);
        /*
        Vamos preparar os dados que estão vindo no formato json
        para serem inseridos no banco de dados.

        */
        $this->tituloevento = htmlspecialchars(strip_tags($this->tituloevento));
        $this->atracao = htmlspecialchars(strip_tags($this->atracao));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->censura = htmlspecialchars(strip_tags($this->censura));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->lotacao = htmlspecialchars(strip_tags($this->lotacao));
        $this->dataevento = htmlspecialchars(strip_tags($this->dataevento));
        $this->hora = htmlspecialchars(strip_tags($this->hora));

        /*
        passagem dos parametros para a consulta de insert
        */
        $stmt->bindParam(":t",$this->tituloevento);
        $stmt->bindParam(":a",$this->atracao);
        $stmt->bindParam(":de",$this->descricao);
        $stmt->bindParam(":c",$this->censura);
        $stmt->bindParam(":e",$this->endereco);
        $stmt->bindParam(":l",$this->lotacao);
        $stmt->bindParam(":da",$this->dataevento);
        $stmt->bindParam(":h",$this->hora);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}



?>