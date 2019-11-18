<?php
    class Contato{
        public $idcontato;
        public $telefone;
        public $email;
    
        //Vamos criar o construtor da classe
        public function __construct($db){
            $this->conn = $db;
        }

        public function listar(){
            //Vamos criar uma consulta para listar os usuarios
            $query = "Select * from contato";
    
            //Vamos preparar a consulta para ser executada
            $stmt = $this->conn->prepare($query);
    
            //Agora vamos executar a consulta
            $stmt->execute();
    
            return $stmt;
        }
        public function cadastro(){
            $query = "insert into contato
                        set telefone=:t,
                            email=:e";
            $stmt = $this->conn->prepare($query);
            
            $this->telefone = htmlspecialchars(strip_tags($this->telefone));
            $this->email = htmlspecialchars(strip_tags($this->email));
    
    
            $stmt->bindParam(":t",$this->telefone);
            $stmt->bindParam(":e",$this->email);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }

        public function atualizar(){
            $query = "update contato set telefone=:t, email=:e where id=:i";
    
            $stmt = $this->conn->prepare($query);
    
            $this->telefone = htmlspecialchars(strip_tags($this->telefone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
    
    
            $stmt->bindParam(":t",$this->telefone);
            $stmt->bindParam(":e",$this->email);
            $stmt->bindParam(":i",$this->idcontato);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
        }
        public function apagar(){
            $query = "delete from contato where id=?";
    
            $stmt = $this->conn->prepare($query);
    
            $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
    
            $stmt->bindParam(1,$this->idcontato);
    
            if ($stmt->execute()) {
                return true;
            } 
            else {
                return false;
            }
            
        }
    }
?>