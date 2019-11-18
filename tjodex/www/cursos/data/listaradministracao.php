<?php

/*
Permitir que essa api seja acessada por qualquer
protocolo como: file, https, http, ftp
*/

header("Access-Control-Allow-Origin:");

header("Content-type:application/json;charset=utf-8");

include_once "../config/database.php";
include_once "../domain/curso.php";

$database = new Database();
$db = $database->getConnection();

$curso = new Curso($db);

$stmt = $curso->listarAdministracao();

if ($stmt->rowCount()>0) {
    $curso_arr = array();
    $curso_arr["saida"] = array();
    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($linha);
        $array_item = array(
            "id"=>$id,
            "titulocurso"=>$titulocurso,
            "area"=>$area,
            "datacurso"=>$datacurso,
            "diasemana"=>$diasemana,
            "horario"=>$horario
        );
        array_push($curso_arr["saida"],$array_item);
    }
    header("HTTP/1.0 200");
    echo json_encode($curso_arr);
}
else {
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Bad Request: Não ha cursos cadastrados"));
}

?>