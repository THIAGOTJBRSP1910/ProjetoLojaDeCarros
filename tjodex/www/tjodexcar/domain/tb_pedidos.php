<?php

class tb_pedidos{
    public $notaFis;
    public $dataPed;
    public $dataEnv;
    public $idCliente;
    public $precoNota;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from tb_pedidos";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();   

        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tb_pedidos set idCliente=:idc, precoNota=:pn";
        
        $stmt=$this->conn->prepare($query);

    
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->precoNota = htmlspecialchars(strip_tags($this->precoNota));

        $stmt->bindParam(":idc",$this->idCliente);
        $stmt->bindParam(":pn",$this->precoNota);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tb_pedidos set idCliente=:idc, precoNota=:pn where notaFis=:n";
        
        $stmt=$this->conn->prepare($query);

       
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->precoNota = htmlspecialchars(strip_tags($this->precoNota));
        $this->notaFis = htmlspecialchars(strip_tags($this->notaFis));

        $stmt->bindParam(":idc",$this->idCliente);
        $stmt->bindParam(":pn",$this->precoNota);
        $stmt->bindParam(":n",$this->notaFis);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from tb_pedidos where notaFis=?";

        $stmt = $this->conn->prepare($query);

        $this->notaFis=htmlspecialchars(strip_tags($this->notaFis));

        $stmt->bindParam(1,$this->notaFis);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


