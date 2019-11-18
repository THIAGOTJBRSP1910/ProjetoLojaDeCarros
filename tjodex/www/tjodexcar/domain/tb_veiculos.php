<?php

class tb_veiculos{
    public $codigoVeiculo;
    public $marca;
    public $modelo;
    public $ano;
    public $preco;
    public $kilometragem;
    public $cambio;
    public $carroceria;
    public $combustivel;
    public $finalPlaca;
    public $cor;
    public $ipvaPago;
    public $estoque;
    public $imagem1;
    public $imagem2;
    public $imagem3;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function listar(){
        $query = "select * from tb_veiculos";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();   

        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tb_veiculos set marca=:m, modelo=:mo, ano=:a, preco=:p,
         kilometragem=:k, cambio=:cam, carroceria=:car, combustivel=:comb, finalPlaca=:fp, cor=:cor,
          ipvaPago=:ip, estoque=:es, imagem1=:i,imagem2=:img,imagem3=:imgg";
        
        $stmt=$this->conn->prepare($query);

    
        $this->marca = htmlspecialchars(strip_tags($this->marca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->ano = htmlspecialchars(strip_tags($this->ano));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->kilometragem = htmlspecialchars(strip_tags($this->kilometragem));
        $this->cambio = htmlspecialchars(strip_tags($this->cambio));
        $this->carroceria = htmlspecialchars(strip_tags($this->carroceria));
        $this->combustivel = htmlspecialchars(strip_tags($this->combustivel));
        $this->finalPlaca = htmlspecialchars(strip_tags($this->finalPlaca));
        $this->cor = htmlspecialchars(strip_tags($this->cor));
        $this->ipvaPago = htmlspecialchars(strip_tags($this->ipvaPago));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->imagem1 = htmlspecialchars(strip_tags($this->imagem1));
        $this->imagem2 = htmlspecialchars(strip_tags($this->imagem2));
        $this->imagem3 = htmlspecialchars(strip_tags($this->imagem3));



        $stmt->bindParam(":m",$this->marca);
        $stmt->bindParam(":mo",$this->modelo);
        $stmt->bindParam(":a",$this->ano);
        $stmt->bindParam(":p",$this->preco);
        $stmt->bindParam(":k",$this->kilometragem);
        $stmt->bindParam(":cam",$this->cambio);
        $stmt->bindParam(":car",$this->carroceria);
        $stmt->bindParam(":comb",$this->combustivel);
        $stmt->bindParam(":fp",$this->finalPlaca);
        $stmt->bindParam(":cor",$this->cor);
        $stmt->bindParam(":ip",$this->ipvaPago);
        $stmt->bindParam(":es",$this->estoque);
        $stmt->bindParam(":i",$this->imagem1);
        $stmt->bindParam(":img",$this->imagem2);
        $stmt->bindParam(":imgg",$this->imagem3);

        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tb_veiculos set marca=:m, modelo=:mo, ano=:a, preco=:p,
        kilometragem=:k, cambio=:cam, carroceria=:car, combustivel=:comb, finalPlaca=:fp, cor=:cor,
         ipvaPago=:ip, estoque=:es, imagem1=:i,imagem2=:img,imagem3=:imgg where codigoVeiculo=:cv";
       
       $stmt=$this->conn->prepare($query);

       
       $this->marca = htmlspecialchars(strip_tags($this->marca));
       $this->modelo = htmlspecialchars(strip_tags($this->modelo));
       $this->ano = htmlspecialchars(strip_tags($this->ano));
       $this->preco = htmlspecialchars(strip_tags($this->preco));
       $this->kilometragem = htmlspecialchars(strip_tags($this->kilometragem));
       $this->cambio = htmlspecialchars(strip_tags($this->cambio));
       $this->carroceria = htmlspecialchars(strip_tags($this->carroceria));
       $this->combustivel = htmlspecialchars(strip_tags($this->combustivel));
       $this->finalPlaca = htmlspecialchars(strip_tags($this->finalPlaca));
       $this->cor = htmlspecialchars(strip_tags($this->cor));
       $this->ipvaPago = htmlspecialchars(strip_tags($this->ipvaPago));
       $this->estoque = htmlspecialchars(strip_tags($this->estoque));
       $this->imagem1 = htmlspecialchars(strip_tags($this->imagem1));
       $this->imagem2 = htmlspecialchars(strip_tags($this->imagem2));
       $this->imagem3 = htmlspecialchars(strip_tags($this->imagem3));
       $this->codidoVeiculo = htmlspecialchars(strip_tags($this->codigoVeiculo));



       
       $stmt->bindParam(":m",$this->marca);
       $stmt->bindParam(":mo",$this->modelo);
       $stmt->bindParam(":a",$this->ano);
       $stmt->bindParam(":p",$this->preco);
       $stmt->bindParam(":k",$this->kilometragem);
       $stmt->bindParam(":cam",$this->cambio);
       $stmt->bindParam(":car",$this->carroceria);
       $stmt->bindParam(":comb",$this->combustivel);
       $stmt->bindParam(":fp",$this->finalPlaca);
       $stmt->bindParam(":cor",$this->cor);
       $stmt->bindParam(":ip",$this->ipvaPago);
       $stmt->bindParam(":es",$this->estoque);
       $stmt->bindParam(":i",$this->imagem1);
       $stmt->bindParam(":img",$this->imagem2);
       $stmt->bindParam(":imgg",$this->imagem3);
       $stmt->bindParam(":cv",$this->codigoVeiculo);

       
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from tb_veiculos where codigoVeiculo=?";

        $stmt = $this->conn->prepare($query);

        $this->codigoVeiculo=htmlspecialchars(strip_tags($this->codigoVeiculo));

        $stmt->bindParam(1,$this->codigoVeiculo);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


