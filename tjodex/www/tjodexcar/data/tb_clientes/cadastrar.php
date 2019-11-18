<?php

#Vamos definir os cabeçalhos de acesso e escrita de informações para a API

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600"); // foneClienteo tempo leva para processar o cadastro(1minutocpf

// Importação da conexão como banco e dados
include_once "../../config/database.php";

// Importação da classe usuario
include_once "../../domain/tb_clientes.php";

// Iniciar a instancia do banco de dados
$database = new Database();

// Chamada da função de conexão com o banco de dados
$db = $database->getConnection();

// Instancia da classe usuario
$tb_clientes = new tb_clientes($db);

/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo usuario
Utilizaremos o comando php:/input
*/

$data = json_decode(file_get_contents("php://input"));

//Verificar se os dados enviados pelo usuario estão realmente com dados, se nao há nada vazio

if (!empty($data->nomeCliente) && !empty($data->foneCliente) && 
!empty($data->cpf) && !empty($data->rg) && !empty($data->email) && !empty($data->cep) && !empty($data->endereco) &&
 !empty($data->numero) && !empty($data->complemento) && !empty($data->estado) && !empty($data->cidade)
  && !empty($data->bairro)){ //"!" - é uma negação 

    $tb_clientes->nomeCliente = $data->nomeCliente;
    $tb_clientes->foneCliente = $data->foneCliente;
    $tb_clientes->cpf = $data->cpf;
    $tb_clientes->rg = $data->rg;
    $tb_clientes->email = $data->email;
    $tb_clientes->cep = $data->cep;
    $tb_clientes->endereco = $data->endereco;
    $tb_clientes->numero = $data->numero;
    $tb_clientes->complemento = $data->complemento;
    $tb_clientes->estado = $data->estado;
    $tb_clientes->cidade = $data->cidade;
    $tb_clientes->bairro = $data->bairro;

    

if($tb_clientes->cadastrar()){
    header("HTTP/1.0 201");
    echo json_encode(array("mensagem"=>"Cliente cadastrado com sucesso"));
}

 
else {
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Nao foi possivel cadastrar"));
     }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Voce deve passar todos os dados"));
}
?>