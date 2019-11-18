<?php
//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");
//Formato de transito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/horario.php";

$database = new Database();
$db = $database->getConnection();//getConnection efetua a conexão cm o banco

$horario = new Horario($db);

$stmt = $horario->listar();

if ($stmt->rowCount()>0) {
    $horario_arr = array();
    $horario_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idhorario"=>$id,
            "idcliente"=>$idcliente,
            "idservico"=>$idservico,
            "idprofissinal"=>$idprofissinal,
            "idunidade"=>$idunidade,
            "dia"=>$dia,
            "hora"=>$hora
        );

        array_push($horario_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($horario_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há horarios cadastrados"));
} 

?>