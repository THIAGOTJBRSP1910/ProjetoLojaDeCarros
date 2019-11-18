<?php

header("Access-Control-Allow-Origin:*");
header("Content-type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age:3600");

include_once "../config/database.php";
include_once "../domain/curso.php";

$database = new Database();
$db = $database->getConnection();

$curso = new Curso($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->titulocurso)&
    !empty($data->area)&
    !empty($data->datacurso)&
    !empty($data->diasemana)&
    !empty($data->horario)) {
    $curso->titulocurso = $data->titulocurso;
    $curso->area = $data->area;
    $curso->datacurso = $data->datacurso;
    $curso->diasemana = $data->diasemana;
    $curso->horario = $data->horario;

    if($curso->cadastro()) {
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Curso cadastrado com sucesso"));
    }
    else {
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possivel cadastrar"));
    }
}

?>