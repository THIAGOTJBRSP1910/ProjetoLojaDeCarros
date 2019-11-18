<?php

#Vamos definir os cabeçalhos acesso e escrita de informações
#para a api
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600");//Quanto tempo leva para processoar o cadastro(1minuto)

//importação da conexão com o banco de dados
include_once "../../config/database.php";

//importação da classe profissional
include_once "../../domain/profissional.php";

//Iniciar a instância do banco de dados 
$database = new Database();

//chamada da função de conexao com o banco de dados
$db = $database->getConnection();

//Instância da classe profissional
$profissional = new Profissional($db);

/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo profissional
Utilizaremos o comando php://input 
*/
$data = json_decode(file_get_contents("php://input"));

//Verificar se os dados enviados pelo usuário estão realmente com dados, se não há nada vazio
if(
    !empty($data->nome) && 
    !empty($data->funcao) && 
    !empty($data->idendereco) && 
    !empty($data->idcontato) && 
    !empty($data->idusuario)    
    {

    $profissional->nome = $data->nome;
    $profissional->funcao = $data->funcao;
    $profissional->idendereco = $data->idendereco;
    $profissional->idcontato = $data->idcontato;
    $profissional->idusuario = $data->idusuario;

    if($profissional->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Usuário cadastrado com sucesso"));
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