<?php

/*
Permitir que essa api seja acessada por qualquer
protocolo como: file, https, http, ftp
*/

header("Access-Control-Allow-Origin:");

header("Content-type:application/json;charset=utf-8");

include_once "../config/database.php";
include_once "../domain/evento.php";

$database = new Database();
$db = $database->getConnection();

$curso = new Evento($db);

$stmt = $curso->listar();

if ($stmt->rowCount()>0) {
    $evento_arr = array();
    $evento_arr["saida"] = array();
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($linha);
        $array_item = array(
            "id"=>$id,
            "tituloevento"=>$tituloevento,
            "atracao"=>$atracao,
            "descricao"=>$descricao,
            "censura"=>$censura,
            "endereco"=>$endereco,
            "lotacao"=>$lotacao,
            "dataevento"=>$dataevento,
            "hora"=>$hora
        );
        array_push($evento_arr["saida"],$array_item);
    }
    header("HTTP/1.0 200");
    echo json_encode($evento_arr);
}
else {
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Bad Request: Não ha eventos cadastrados"));
}

?>