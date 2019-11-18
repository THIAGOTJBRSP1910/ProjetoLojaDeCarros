<?php

class tb_carrinho{
    public $notaFis;
    public $codigoVeiculo;
    public $quant;
    public $prcUnitario;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from tb_carrinho";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();   

        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tb_carrinho set notaFis=:n, codigoVeiculo=:cv, quant=:q, prcUnitario=:prc";
        
        $stmt=$this->conn->prepare($query);

        $this->notaFis = htmlspecialchars(strip_tags($this->notaFis));
        $this->codigoVeiculo = htmlspecialchars(strip_tags($this->codigoVeiculo));
        $this->quant = htmlspecialchars(strip_tags($this->quant));
        $this->prcUnitario = htmlspecialchars(strip_tags($this->prcUnitario));


        $stmt->bindParam(":n",$this->notaFis);
        $stmt->bindParam(":cv",$this->codigoVeiculo);
        $stmt->bindParam(":q",$this->quant);
        $stmt->bindParam(":prc",$this->prcUnitario);
        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tb_carrinho set codigoVeiculo=:cv, quant=:q, prcUnitario=:prc where notaFis=:n";
        
        $stmt=$this->conn->prepare($query);

        $this->codigoVeiculo = htmlspecialchars(strip_tags($this->codigoVeiculo));
        $this->quant = htmlspecialchars(strip_tags($this->quant));
        $this->prcUnitario = htmlspecialchars(strip_tags($this->prcUnitario));
        $this->notaFis = htmlspecialchars(strip_tags($this->notaFis));


        
        $stmt->bindParam(":cv",$this->codigoVeiculo);
        $stmt->bindParam(":q",$this->quant);
        $stmt->bindParam(":prc",$this->prcUnitario);
        $stmt->bindParam(":n",$this->notaFis);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from tb_carrinho where notaFis=?";

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


