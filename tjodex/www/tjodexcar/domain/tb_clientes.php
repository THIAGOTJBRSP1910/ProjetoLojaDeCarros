<?php

class tb_clientes{
    public $idCliente;
    public $nomeCliente;
    public $foneCliente;
    public $cpf;
    public $rg;
    public $email;
    public $cep;
    public $endereco;
    public $numero;
    public $complemento;
    public $estado;
    public $cidade;
    public $bairro;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from tb_clientes";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();   

        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tb_clientes set nomeCliente=:nc, foneCliente=:fc,
        cpf=:c,rg=:r,email=:e,cep=:ce,endereco=:en,numero=:n,complemento=:com,estado=:es,
        cidade=:cid,bairro=:bai";
        
        $stmt=$this->conn->prepare($query);

        
        $this->nomeCliente = htmlspecialchars(strip_tags($this->nomeCliente));
        $this->foneCliente = htmlspecialchars(strip_tags($this->foneCliente));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->rg = htmlspecialchars(strip_tags($this->rg));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->complemento = htmlspecialchars(strip_tags($this->complemento));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));



        
        $stmt->bindParam(":nc",$this->nomeCliente);
        $stmt->bindParam(":fc",$this->foneCliente);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":r",$this->rg);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":ce",$this->cep);
        $stmt->bindParam(":en",$this->endereco);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":com",$this->complemento);
        $stmt->bindParam(":es",$this->estado);
        $stmt->bindParam(":cid",$this->cidade);
        $stmt->bindParam(":bai",$this->bairro);

        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tb_clientes set nomeCliente=:nc, foneCliente=:fc,
        cpf=:c,rg=:r,email=:e,cep=:ce,endereco=:en,numero=:n,complemento=:com,estado=:es,
        cidade=:cid,bairro=:bai where idCliente=:idc";
        
        $stmt=$this->conn->prepare($query);

        
        $this->nomeCliente = htmlspecialchars(strip_tags($this->nomeCliente));
        $this->foneCliente = htmlspecialchars(strip_tags($this->foneCliente));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
        $this->rg = htmlspecialchars(strip_tags($this->rg));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->cep = htmlspecialchars(strip_tags($this->cep));
        $this->endereco = htmlspecialchars(strip_tags($this->endereco));
        $this->numero = htmlspecialchars(strip_tags($this->numero));
        $this->complemento = htmlspecialchars(strip_tags($this->complemento));
        $this->estado = htmlspecialchars(strip_tags($this->estado));
        $this->cidade = htmlspecialchars(strip_tags($this->cidade));
        $this->bairro = htmlspecialchars(strip_tags($this->bairro));
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));



        
        $stmt->bindParam(":nc",$this->nomeCliente);
        $stmt->bindParam(":fc",$this->foneCliente);
        $stmt->bindParam(":c",$this->cpf);
        $stmt->bindParam(":r",$this->rg);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":ce",$this->cep);
        $stmt->bindParam(":en",$this->endereco);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":com",$this->complemento);
        $stmt->bindParam(":es",$this->estado);
        $stmt->bindParam(":cid",$this->cidade);
        $stmt->bindParam(":bai",$this->bairro);
        $stmt->bindParam(":idc",$this->idCliente);


        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from tb_clientes where idCliente=?";

        $stmt = $this->conn->prepare($query);

        $this->idCliente=htmlspecialchars(strip_tags($this->idCliente));

        $stmt->bindParam(1,$this->idCliente);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


