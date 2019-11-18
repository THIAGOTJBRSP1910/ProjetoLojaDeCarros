<?php

header("Access-Control-Allow-Origin:*");
header("Content-type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");

include_once "../config/database.php";
include_once "../domain/evento.php";

$database = new Database();
$db = $database->getConnection();

$evento = new Evento($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->tituloevento)&
    !empty($data->atracao)&
    !empty($data->descricao)&
    !empty($data->censura)&
    !empty($data->endereco)&
    !empty($data->lotacao)&
    !empty($data->dataevento)&
    !empty($data->hora)) {
    $evento->tituloevento = $data->tituloevento;
    $evento->atracao = $data->atracao;
    $evento->descricao = $data->descricao;
    $evento->censura = $data->censura;
    $evento->endereco = $data->endereco;
    $evento->lotacao = $data->lotacao;
    $evento->dataevento = $data->dataevento;
    $evento->hora = $data->hora;

    if($evento->cadastro()) {
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Evento cadastrado com sucesso"));
    }
    else {
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel cadastrar"));
    }
}

?>