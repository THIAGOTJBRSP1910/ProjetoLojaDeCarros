<?php
#arquivo de configuração da conexão php 
#ao banco de dados

//vamos criar uma variavel para representar a 
//conexao com o banco de dados 

class Database{
public $conn;

//agora vamos criar uma funcao para estabelecer a conexao com o banco 
//de dados . Para isso será nescessario passar seguintes informacoes:
//usuario do banco de dados : root
//nome ou ip do servidor de dados : local host 
//porta de comunicação  : 3307
//senha do banco : "" (em branco)
function getConnection(){
    try{
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=apdatabase","root","");
    }
 catch(PDOException $ex){
  echo "Erro ao tentar estabelecer a conexao com o bancoo. ".$ex->getMessage();
}
 return $conn;
}
}

?>