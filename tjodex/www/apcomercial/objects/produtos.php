<?php

/*
Esta classe guarda suas informações sobre os usuarios .
    - Suas propiedades e metodos do CRUD
    C - CREATE (INSERT)
    R - RETRIVER | READ (SELECTS)
    U - UPDATES (ATUALIZAÇÕES)
    D - DELETE (APAGAR DADOS)

*/

Class Produtos{

public $idproduto;
public $nomeproduto;
public $descricao;
public $preco;
public $img1;
public $img2;
public $img3;
public $img4;

//abaixo é apresentado o construto da classe produtos
//ele é responsavel por iniciar a classe 
// em php usamos o termo __construct para declarar
//um construtor

public function __construct($db){
    $this->conn = $db;
}

/*
Vamos criar o primeiro elementos relacionado ao 
crud para a classe produtos.
Listaremos os produtos cadastrados
*/

public function listar(){
    // vamos criar uma variavel para guardar 
    // a string da consulta do sql 
    $query = "Select * from produtos";

    //preparar a execução da consulta 
    // A Variavel stmt(Statement(contexto)) irá guardar 
    // o resultado da execução da consulta

    $stmt = $this->conn->prepare($query);

    //vamos executar efetivamente a consulta
    $stmt->execute();

    //retornar os dados que foram selecionados

    return $stmt;
}
// ----- Retornar os dados do usuario por id -----

public function listarPorNome(){
    $query = "Select * from produtos where nomeproduto like %?%";

    $stmt=$this->conn->prepare($query);

    //vamos fazer um bind(ligação) do nomeproduto
    //pesquisado com o paramêtro da consulta

    $stmt->bindParam(1,$this->nomeproduto);

    //executar efetivamente a consulta

    $stmt ->execute();

    //Organizar os dados retornados da consulta para
    //a exibição em formato de json
    //vamos usar uma variavel e um array para associar 
    //os campos da tabela 

    $linha = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->idproduto = $linha['idproduto'];
    $this->nomeproduto = $linha['nomeproduto'];
    $this->descricao = $linha['descricao '];
    $this->preco = $linha['preco'];
    $this->img1 = $linha['img1'];
    $this->img2 = $linha['img2'];
    $this->img3 = $linha['img3'];
    $this->img3 = $linha['img4'];

}

public function cadastro(){

    $query = "insert into produtos 
    set
           nomeproduto=:n,
           descricao=:d,
           preco=:p,
           img1=:i1,
           img2=:i2,
           img3=:i3,
           img4=:i4";
    $stmt = $this->conn->prepare($query);   
    //vamos usar uma função para retirar 
    //todos os caracteres especiais vindos de 
    //uma pagina html
    //isso fará com que você evite a execução 
    //de comandos maliciosos no banco de dados
    //comandos de sqlinject
    
    
    $this->nomeproduto = htmlspecialchars(strip_tags($this->nomeproduto));
    $this->descricao = htmlspecialchars(strip_tags($this->descricao));
    $this->preco = htmlspecialchars(strip_tags($this->preco));
    $this->img1 = htmlspecialchars(strip_tags($this->img1));
    $this->img2 = htmlspecialchars(strip_tags($this->img2));
    $this->img3 = htmlspecialchars(strip_tags($this->img3));
    $this->img4 = htmlspecialchars(strip_tags($this->img4));


    $stmt->bindParam(":n",$this->nomeproduto);
    $stmt->bindParam(":d",md5($this->descricao));
    $stmt->bindParam(":p",$this->preco);
    $stmt->bindParam(":i1",$this->img1);
    $stmt->bindParam(":i2",$this->img2);
    $stmt->bindParam(":i3",$this->img3);
    $stmt->bindParam(":i4",$this->img4);
    if ($stmt->execute()){
        return true;

    }
    return false;

}

}

?>