<?php

class Profissional{
    public $idprofissional;
    public $nome;
    public $funcao;
    public $idendereco;
    public $idcontato;
    public $idusuario;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from profissional";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function cadastro(){
        $query = "insert into profissional set nome=:n, funcao=:f, idendereco=:ie, idcontato=:ic, idusuario=:iu";
        
        $stmt=$this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->funcao = htmlspecialchars(strip_tags($this->funcao));
        $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
        $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));


        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":f",$this->funcao);
        $stmt->bindParam(":ie",$this->idendereco);
        $stmt->bindParam(":ic",$this->idcontato);
        $stmt->bindParam(":iu",$this->idusuario);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "insert into profissional set nome=:n, funcao=:f, idendereco=:ie, idcontato=:ic, idusuario=:iu where id=:idp";
        
        $stmt=$this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->funcao = htmlspecialchars(strip_tags($this->funcao));
        $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
        $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
        $this->idprofissional = htmlspecialchars(strip_tags($this->idprofissional));


        $stmt->bindParam(":n",$this->nome);
        $stmt->bindParam(":f",$this->funcao);
        $stmt->bindParam(":ie",$this->idendereco);
        $stmt->bindParam(":ic",$this->idcontato);
        $stmt->bindParam(":iu",$this->idusuario);
        $stmt->bindParam(":idp",$this->idprofissional);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from profissional where id=?";

        $stmt = $this->conn->prepare($query);

        $this->idprofissional=htmlspecialchars(strip_tags($this->idprofissional));

        $stmt->bindParam(1,$this->idprofissional);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


