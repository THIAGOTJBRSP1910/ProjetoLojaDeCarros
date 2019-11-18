<?php
/*
Esta classe representa a tabela do banco de dados
na camada da aplicação.
Aqui, nós também iremos adicionar os comandos
 de DML para a execução do CRUD

    C -> Create(insert)
    R -> Read(Select)
    U -> Update(Atualização)
    D -> Delete(Apagar)
*/
class Unidade{
    public $idunidade;
    public $idendereco;
    public $idcontato;

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
        $query = "Select * from unidade";

        //Vamos preparar a consulta para ser executada
        $stmt = $this->conn->prepare($query);

        //Agora vamos executar a consulta
        $stmt->execute();

        return $stmt;
    }

    public function cadastro(){
        $query = "insert into unidade
                    set idendereco=:ie,
                        idcontato=:ic";
        
        $stmt=$this->conn->prepare($query);

        $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
        $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));

        $stmt->bindParam(":ie",$this->idendereco);
        $stmt->bindParam(":ic",$this->idcontato);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $query = "update unidade
                    set idendereco=:ie,
                        idcontato=:ic where id=:i";
        
        $stmt=$this->conn->prepare($query);

        $this->idendereco = htmlspecialchars(strip_tags($this->idendereco));
        $this->idcontato = htmlspecialchars(strip_tags($this->idcontato));
        $this->idunidade = htmlspecialchars(strip_tags($this->idunidade));


        $stmt->bindParam(":ie",$this->idendereco);
        $stmt->bindParam(":ic",$this->idcontato);
        $stmt->bindParam(":i",$this->idunidade);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagar(){
        $query = "delete from unidade where id=?";

        $stmt = $this->conn->prepare($query);

        $this->idunidade=htmlspecialchars(strip_tags($this->idunidade));

        $stmt->bindParam(1,$this->idunidade);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}
?>