<?php
    class Endereco{
        public $idendereco;
        public $tipo;
        public $logradouro;
        public $numero;
        public $complemento;
        public $cep;
        public $bairro;
        public $cidade;
        public $estado;
    
        //Vamos criar o construtor da classe
        public function __construct($db){
            $this->conn = $db;
        }

        public function listar(){
            //Vamos criar uma consulta para listar os usuarios
            $query = "Select * from endereco";
    
            //Vamos preparar a consulta para ser executada
            $stmt = $this->conn->prepare($query);
    
            //Agora vamos executar a consulta
            $stmt->execute();
    
            return $stmt;
        }
        public function cadastro(){
            $query = "insert into endereco
                        set tipo=:t,
                            logradouro=:l,
                            numero=:n,
                            complemento=:co,
                            cep=:ce,
                            bairro=:b,
                            cidade=:ci,
                            estado=:e";
            $stmt = $this->conn->prepare($query);
            
            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->logradouro = htmlspecialchars(strip_tags($this->logradouro));
            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->complemento = htmlspecialchars(strip_tags($this->complemento));
            $this->cep = htmlspecialchars(strip_tags($this->cep));
            $this->bairro = htmlspecialchars(strip_tags($this->bairro));
            $this->cidade = htmlspecialchars(strip_tags($this->cidade));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
    
    
            $stmt->bindParam(":t",$this->tipo);
            $stmt->bindParam(":l",$this->logradouro);
            $stmt->bindParam(":n",$this->numero);
            $stmt->bindParam(":co",$this->complemento);
            $stmt->bindParam(":ce",$this->cep);
            $stmt->bindParam(":b",$this->bairro);
            $stmt->bindParam(":ci",$this->cidade);
            $stmt->bindParam(":e",$this->estado);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }

        public function atualizar(){
            $query = "update endereco set tipo=:t,
            logradouro=:l,
            numero=:n,
            complemento=:co,
            cep=:ce,
            bairro=:b,
            cidade=:ci,
            estado=:e where id=:i";
    
            $stmt = $this->conn->prepare($query);
    
            $this->tipo = htmlspecialchars(strip_tags($this->tipo));
            $this->logradouro = htmlspecialchars(strip_tags($this->logradouro));
            $this->numero = htmlspecialchars(strip_tags($this->numero));
            $this->complemento = htmlspecialchars(strip_tags($this->complemento));
            $this->cep = htmlspecialchars(strip_tags($this->cep));
            $this->bairro = htmlspecialchars(strip_tags($this->bairro));
            $this->cidade = htmlspecialchars(strip_tags($this->cidade));
            $this->estado = htmlspecialchars(strip_tags($this->estado));
            $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
    
    
            $stmt->bindParam(":t",$this->tipo);
            $stmt->bindParam(":l",$this->logradouro);
            $stmt->bindParam(":n",$this->numero);
            $stmt->bindParam(":co",$this->complemento);
            $stmt->bindParam(":ce",$this->cep);
            $stmt->bindParam(":b",$this->bairro);
            $stmt->bindParam(":ci",$this->cidade);
            $stmt->bindParam(":e",$this->estado);
            $stmt->bindParam(":i",$this->idendereco);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }
        public function apagar(){
            $query = "delete from endereco where id=?";
    
            $stmt = $this->conn->prepare($query);
    
            $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
    
            $stmt->bindParam(1,$this->idendereco);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
            
        }
    }
?>