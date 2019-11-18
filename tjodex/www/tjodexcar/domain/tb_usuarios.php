<?php

class Usuario{
    public $id;
    public $login;
    public $senha;
    
    

    public function __construct($db){
        $this->conn = $db;
    }


    public function logar(){
        $query = "select * from tb_usuarios where loginUsuario=? and senhaUsuario=?";

        $stmt->bindParam(1,$this->login);
        $stmt->bindParam(2,md5($this->senha));

        $stmt->execute();

        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $linha['id'];
        $this->login = $linha['login'];

        return $Usuario;
    }

    public function listar(){
        $query = "select * from tb_usuarios";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();   

        return $stmt;
    }

    public function cadastrar(){
        $query = "insert into tb_usuarios set loginUsuario=:l, senhaUsuario=:s";
        
        $stmt=$this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        
        $this->senha = md5($this->senha);

        $stmt->bindParam(":l",$this->login);
        $stmt->bindParam(":s",$this->senha);
        
        

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update tb_usuarios set loginUsuario=:l, senhaUsuario=:s where id=:id";
        
        $stmt=$this->conn->prepare($query);

        
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $this->senha= md5($this->senha);
        
      
        $stmt->bindParam(":l",$this->login);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":id",$this->id);
        
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function apagar(){
        $query = "delete from tb_usuarios where id=?";

        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1,$this->id);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}


