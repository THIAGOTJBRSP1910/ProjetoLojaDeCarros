<?php
/*
Esta classe representa a tabela do banco de dados
na camada de aplicação.
Aqui, nós tambem iremos adicionar os comandos
de DML para a execução do CRUD

    C -> Create(insert)
    R -> Read(Select)
    U -> Update(Atualização)
    D -> Delete(Apagar)
    Tudo que tiver $ é variavel   
*/
class Usuario{
    public $idusuario;
    public $login;
    public $senha;

    //Vamos criar o construtor da classe
    public function __construct($db){
        $this->conn = $db;
    }

    /*
    Vamos criar uma estrutura de listagem de dados cadastrados
    no banco e na tabela usuarios
    */
    public function listar(){
        //Vamos criar uma consulta para listar os usuarios
        $query = "Select * from usuario";

        //Vamos preparar a consulta para ser executada
        $stmt = $this->conn->prepare($query);

        //Agora vamos executar a consulta
        $stmt->execute();

        return $stmt;
    }

    public function logar(){
        $query = "select * from usuario where login=? and senha=?";

        $stmt->bindParam(1,$this->login);
        $stmt->bindParam(2,md5($this->senha));

        $stmt->execute();

        $linha = $stmt->fetch(PDO::FETCH_ASSOC);//FETCH cria o array

        $this->idusuario = $linha["id"];
        $this->login = $linha["login"];

        return Usuario;
    }

    public function cadastro(){
        $query = "insert into usuario
                    set login=:l,
                        senha=:s";
        $stmt = $this->conn->prepare($query);
        
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->senha = htmlspecialchars(strip_tags($this->senha));

        $this->senha = md5($this->senha);

        $stmt->bindParam(":l",$this->login);
        $stmt->bindParam(":s",$this->senha);

        if ($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function atualizar(){
        $query = "update usuario set login=:l, senha=:s where id=:i";

        $stmt = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->senha = htmlspecialchars(strip_tags($this->senha));
        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $this->senha = md5($this->senha);

        $stmt->bindParam(":l",$this->login);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":i",$this->idusuario);

        if ($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function apagar(){
        $query = "delete from usuario where id=?";

        $stmt = $this->conn->prepare($query);

        $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

        $stmt->bindParam(1,$this->idusuario);

        if ($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
        
    }
}
?>