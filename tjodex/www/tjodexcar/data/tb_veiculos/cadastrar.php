<?php

#Vamos definir os cabeçalhos de acesso e escrita de informações para a API

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600"); // foneClienteo tempo leva para processar o cadastro(1minutocpf

// Importação da conexão como banco e dados
include_once "../../config/database.php";

// Importação da classe usuario
include_once "../../domain/tb_veiculos.php";

// Iniciar a instancia do banco de dados
$database = new Database();

// Chamada da função de conexão com o banco de dados
$db = $database->getConnection();

// Instancia da classe usuario
$tb_veiculos = new tb_veiculos($db);

/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo usuario
Utilizaremos o comando php:/input
*/

$data = json_decode(file_get_contents("php://input"));

//Verificar se os dados enviados pelo usuario estão realmente com dados, se nao há nada vazio

if (!empty($data->marca) && !empty($data->modelo) && !empty($data->ano) 
&& !empty($data->preco) && !empty($data->kilometragem) && !empty($data->cambio) &&
 !empty($data->carroceria) && !empty($data->combustivel) && !empty($data->finalPlaca) 
 && !empty($data->cor)&& !empty($data->ipvaPago) && !empty($data->estoque) && 
 !empty($data->imagem1) && !empty($data->imagem2) && !empty($data->imagem3)){ //"!" - é uma negação 

    $tb_veiculos->marca = $data->marca;
    $tb_veiculos->modelo = $data->modelo;
    $tb_veiculos->ano = $data->ano;
    $tb_veiculos->preco = $data->preco;
    $tb_veiculos->kilometragem = $data->kilometragem;
    $tb_veiculos->cambio = $data->cambio;
    $tb_veiculos->carroceria = $data->carroceria;
    $tb_veiculos->combustivel = $data->combustivel;
    $tb_veiculos->finalPlaca = $data->finalPlaca;
    $tb_veiculos->cor = $data->cor;
    $tb_veiculos->ipvaPago = $data->ipvaPago;
    $tb_veiculos->estoque = $data->estoque;
    $tb_veiculos->imagem1 = $data->imagem1;
    $tb_veiculos->imagem2 = $data->imagem2;
    $tb_veiculos->imagem3 = $data->imagem3;

    

if($tb_veiculos->cadastrar()){
    header("HTTP/1.0 201");
    echo json_encode(array("mensagem"=>"Veiculo cadastrado com sucesso"));
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