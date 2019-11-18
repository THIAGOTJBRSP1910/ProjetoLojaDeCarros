<?php

class Detalhespedidos{
    public $iddetalhespedido;
    public $idpedido;
    public $idproduto;
    public $quantidade;

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "Select * from detalhespedido order by iddetalhespedido desc";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function listarIdDetalhes(){
        $query="Select * from detalhespedido iddetalhespedido=?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->iddetalhespedido);

        $stmt->execute();

        $linha = $stmt->fetcj(PDO::FETCH_ASSOC);

        $this ->iddetalhespedido = $linha['iddetalhespedido'];
        $this ->idpedido = $linha['idpedido'];
        $this ->idproduto = $linha['idproduto'];
        $this ->quantidade = $linha['quantidade'];
    }

    public function cadastro(){
        $query = "insert into detalhespedido set 
        iddetalhespedido=:idd,
        idpedido=:id,
        idproduto=:ip,
        quantidade=:qd
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":ip",$this->idpedido);


        $this->idpedido = htmlspecialchars(strip_tags($this->idpedido));
        $this->idproduto = htmlspecialchars(strip_tags($this->idproduto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        
        if($stmt->execute()){
            return true;

        }
        return false;
    }

}

















?>
