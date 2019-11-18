<?php

/*
Está classe realiza o CRUD da tabela pedidos de acordo com o que
usuário desejar fazer.Sendo: 
    C -> CREATE (INSERT)
    R -> RETRIVER | READ (SELECTS)
    U -> UPDATES (ATUALIZAÇÕES)
    D -> DELETE (APAGAR DADOS)
*/

Class Pedidos{
    public $idpedido;
    public $idusuario;
    public $datapedido;


public function __construct($db){
    $this->conn = $db;
}
/*
Vamos criar o primeiro elementos relacionados ao crud 
para a classe pedidos .
*/

public function listar(){
    $query = "Select * from pedidos order by idpedido desc";

    $stmt = $this->conn->prepare($query);
    //vamos executar efetivamente a consulta
    $stmt->execute();

    return $stmt;

}
public function listarIdPedido(){
    $query = "Select * from pedidos where idpedido=?";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1,$this->idpedido);

    $stmt->execute();

    //vamos executar o retorno dos dados localizados
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    //PASSAR os dados encontrados no banco de dados para o objeto
    //de pedidos

    $this->idusuario = $linha['idusuario'];
    $this->datapedido = $linha['datapedido'];

}
public function cadastro(){
    $query = "insert into pedidos set idusuario=:us";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":us",$this->idusuario);

    $this->idusuario = htmlspecialchars(strip_tags($this->idusuario));

    if($stmt->execute()){
        return true;
    }
    return false;

}

}







?>