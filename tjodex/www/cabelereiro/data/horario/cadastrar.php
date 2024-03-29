<?php
#Vamos definir os cabeçalhos acesso e escrita de informaçoes para a api
header("Access-Control-Allow-Origin");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600"); //Quanto tempo leva para processar o cadastro(1minuto)

//importação da conexão com o banco de dados
include_once "../../config/database.php";
//importação da classe usuario
include_once "../../domain/horario.php";
//Iniciar a instancia do banco de dados
$database = new Database();
//chamada da função de conexão com o banco de dados
$db = $database->getConnection();
//Instancia da classe usuario
$horario = new Horario($db);
/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo usuario
Utilizaremos o comando php://input
*/
$data = json_decode(file_get_contents("php://input"));
//Verificar se os dados enviados pelo usuario estão realmente com dados, se não há nada vazio
if (!empty($data->idcliente) 
    && !empty($data->idservico)
    && !empty($data->idprofissinal)
    && !empty($data->idunidade)
    && !empty($data->dia)
    && !empty($data->hora)) {
    $horario->idcliente = $data->idcliente;
    $horario->idservico = $data->idservico;
    $horario->idprofissinal = $data->idprofissinal;
    $horario->idunidade = $data->idunidade;
    $horario->dia = $data->dia;
    $horario->hora = $data->hora;
    

    if($horario->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"horario cadastrado com sucesso"));
    }
    else {
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel cadastrar"));
    }
} 
else {
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você deve passar todos os dados"));
}



?>