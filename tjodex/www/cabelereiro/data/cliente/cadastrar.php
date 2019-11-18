<?php

#Vamos definir os cabeçalhos acesso e escrita de informações
#para a api
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600");//Quanto tempo leva para processoar o cadastro(1minuto)

//importação da conexão com o banco de dados
include_once "../../config/database.php";

//importação da classe cliente
include_once "../../domain/cliente.php";

//Iniciar a instância do banco de dados 
$database = new Database();

//chamada da função de conexao com o banco de dados
$db = $database->getConnection();

//Instância da classe cliente
$cliente = new Cliente($db);

/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo cliente
Utilizaremos o comando php://input 
*/
$data = json_decode(file_get_contents("php://input"));

//Verificar se os dados enviados pelo usuário estão realmente com dados, se não há nada vazio
if(
    !empty($data->nome) && 
    !empty($data->cpf) && 
    !empty($data->sexo) && 
    !empty($data->idendereco) && 
    !empty($data->idcontato) && 
    !empty($data->idusuario) 
    )
    {
    $cliente->nome = $data->nome;
    $cliente->cpf = $data->cpf;
    $cliente->sexo = $data->sexo;
    $cliente->idendereco = $data->idendereco;
    $cliente->idcontato = $data->idcontato;
    $cliente->idusuario = $data->idusuario;
    
    if($cliente->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Cliente cadastrado com sucesso"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você deve passar todos os dados"));
}










?>