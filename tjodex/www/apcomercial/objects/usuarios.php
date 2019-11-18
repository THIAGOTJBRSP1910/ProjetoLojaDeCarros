<?php

/*
Esta classe guarda suas informações sobre os usuarios .
    - Suas propiedades e metodos do CRUD
    C - CREATE (INSERT)
    R - RETRIVER | READ (SELECTS)
    U - UPDATES (ATUALIZAÇÕES)
    D - DELETE (APAGAR DADOS)

*/

class Usuario{
    //abaixo são apresentadas os atributos da
    //classe usuario. Veja que eles refletem 
    //os campos da tabela usuarios do banco 
    //de dados 
    public $idusuario;
    public $email;
    public $senha;
    public $nome;
    public $cpf;
    public $telefone;
    public $foto;

//Abaixo é apresentado o construtor da classe 
//Usuario. Ele responsavel por iniciar a classe 
//Em php usamos o termo __construct para declarar
//um construtor 
public function __construct($db){
    $this ->conn = $db;
}
/*
Vamos criar o primeiro elementos relacionado ao 
crud para a classe usuarios.
Listaremos os usuarios cadastrados
*/

public function listar(){
    // vamos criar uma variavel para guardar 
    // a string da consulta do sql 
    $query = "Select * from usuario";

    //preparar a execução da consulta 
    // A Variavel stmt(Statement(contexto)) irá guardar 
    // o resultado da execução da consulta

    $stmt = $this->conn->prepare($query);

    //vamos executar efetivamente a consulta 
    $stmt->execute();

    //retornar os dados que foram selecionados
    return $stmt;

}
// -------- Retornar os dados do usuarios por id -------------//

    public function listarPorId(){
        $query = "select * from usuario where idusuario=?";

        //preparando a consulta para a execução
        $stmt=$this->conn->prepare($query);

        //vamos fazer um blind(ligação) do id pesquisado
        //com o paramêtro da consulta, neste caso é o 
        //ponto de interrogação
        $stmt ->bindParam(1,$this->idusuario);

        //executar efetivamente a consulta 
        $stmt ->execute();

        //Organizar os dados retornados da consulta para 
        // a exibição em formato de json
        // Vamos usar uma variavel e um array para associar 
        // os campos da tabela
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        //organizar no objeto usuario(aqrquivo usuario.php)
        //os dados retornados
        //da tabela usuario que está no banco de dados
        
        $this->email = $linha['email'];
        $this->senha = $linha['senha'];
        $this->nome = $linha['nome'];
        $this->cpf = $linha['cpf'];
        $this->telefone = $linha['telefone'];
        $this->foto = $linha['foto'];

    }

    //------------retornar usuarios por cpf //

    public function listarPorCpf(){
        $query = "select * from usuario where cpf=?";

        //preparando a consulta para a execução
        $stmt=$this->conn->prepare($query);

        //vamos fazer um blind(ligação) do cpf pesquisado
        //com o paramêtro da consulta, neste caso é o 
        //ponto de interrogação
        $stmt ->bindParam(1,$this->cpf);

        //executar efetivamente a consulta 
        $stmt ->execute();

        //Organizar os dados retornados da consulta para 
        // a exibição em formato de json
        // Vamos usar uma variavel e um array para associar 
        // os campos da tabela
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        //organizar no objeto usuario(aqrquivo usuario.php)
        //os dados retornados
        //da tabela usuario que está no banco de dados
        
        $this->idusuario = $linha['idusuario'];
        $this->email = $linha['email'];
        $this->senha = $linha['senha'];
        $this->nome = $linha['nome'];
        $this->cpf = $linha['cpf'];
        $this->telefone = $linha['telefone'];
        $this->foto = $linha['foto'];


    }

    //----Cadastro do usuario //

    public function cadastro(){

        $query = "insert into usuario
                 set
                  email=:e,
                  senha=:s,
                  nome=:n,
                  telefone=:t,
                  cpf=:c,
                  foto=:f";
    
    $stmt = $this->conn->prepare($query);

    
    //vamos usar uma função para retirar 
    //todos os caracteres especiais vindos de 
    //uma pagina html
    //isso fará com que você evite a execução 
    //de comandos maliciosos no banco de dados
    //comandos de sqlinject

    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->senha = htmlspecialchars(strip_tags($this->senha));
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->telefone = htmlspecialchars(strip_tags($this->telefone));
    $this->cpf = htmlspecialchars(strip_tags($this->cpf));
    $this->foto = htmlspecialchars(strip_tags($this->foto));

    //Vamos fazer i, bindParam(ligação de parametros) entre os dados
    //enviado pelo usuario no navegador ou smartphone para o banco 
    //da dados

    $stmt->bindParam(":e",$this->email);
    $stmt->bindParam(":s",md5($this->senha));
    $stmt->bindParam(":n",$this->nome);
    $stmt->bindParam(":c",$this->cpf);
    $stmt->bindParam(":t",$this->telefone);
    $stmt->bindParam(":f",$this->foto);

    //executar a comsulta e verificar se cadastrou 
    if ($stmt->execute()){
        return true;

    }
    return false;

}

}



?>