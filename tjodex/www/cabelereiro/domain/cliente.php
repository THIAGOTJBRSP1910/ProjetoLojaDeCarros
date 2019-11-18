<?php
    class Cliente{
        public $idcliente;
        public $nome;
        public $cpf;
        public $sexo;
        public $idendereco;
        public $idcontato;
        public $idusuario;
    
        //Vamos criar o construtor da classe
        public function __construct($db){
            $this->conn = $db;
        }

        public function listar(){
            //Vamos criar uma consulta para listar os usuarios
            $query = "Select * from cliente";
    
            //Vamos preparar a consulta para ser executada
            $stmt = $this->conn->prepare($query);
    
            //Agora vamos executar a consulta
            $stmt->execute();
    
            return $stmt;
        }
        public function cadastro(){
            $query = "insert into cliente
                        set nome=:n,
                            cpf=:c,
                            sexo=:s,
                            idendereco=:ide,
                            idcontato=:idc,
                            idusuario=:idu";
            $stmt = $this->conn->prepare($query);
            
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->cpf = htmlspecialchars(strip_tags($this->cpf));
            $this->sexo = htmlspecialchars(strip_tags($this->sexo));
            $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
            $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
            $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
    
            $stmt->bindParam(":n",$this->nome);
            $stmt->bindParam(":c",$this->cpf);
            $stmt->bindParam(":s",$this->sexo);
            $stmt->bindParam(":ide",$this->idendereco);
            $stmt->bindParam(":idc",$this->idcontato);
            $stmt->bindParam(":idu",$this->idusuario);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }

        public function atualizar(){
            $query = "update cliente set insert into cliente
            set nome=:n,
                cpf=:c,
                sexo=:s,
                idendereco=:ide,
                idcontato=:idc,
                idusuario=:idu where id=:i";
    
            $stmt = $this->conn->prepare($query);
    
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->cpf = htmlspecialchars(strip_tags($this->cpf));
            $this->sexo = htmlspecialchars(strip_tags($this->sexo));
            $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
            $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
            $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));
            $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
    
    
            $stmt->bindParam(":n",$this->nome);
            $stmt->bindParam(":c",$this->cpf);
            $stmt->bindParam(":s",$this->sexo);
            $stmt->bindParam(":ide",$this->idendereco);
            $stmt->bindParam(":idc",$this->idcontato);
            $stmt->bindParam(":idu",$this->idusuario);
            $stmt->bindParam(":i",$this->idcliente);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }
        public function apagar(){
            $query = "delete from cliente where id=?";
    
            $stmt = $this->conn->prepare($query);
    
            $this->idcliente = htmlspecialchars(strip_tags($this->idcliente));
    
            $stmt->bindParam(1,$this->idcliente);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
            
        }
    }
?>