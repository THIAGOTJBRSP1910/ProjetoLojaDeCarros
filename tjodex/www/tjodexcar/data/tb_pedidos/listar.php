<?php

//permite o acesso a qualquer protocolo(https, http, file)

header("Access-Control-Allow-Origin:*"); // permitir o acesso controlado de todos os protocolos

//formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php"; // incluindo uma vez o arquivo database

include_once "../../domain/tb_pedidos.php"; //incluindo os dmls(CRUDS)

$database = new Database();
$db = $database->getConnection(); // efetua a conexao com o banco

$tb_pedidos = new tb_pedidos($db);

$stmt =$tb_pedidos->listar();

if($stmt->rowCount()>0){
    $tb_pedidos_arr = array();
    $tb_pedidos_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){ // pegar todas a linhas que retornaram do banco e formar um novo array
        extract($linha);
        $array_item = array(
            "notaFis"=>$notaFis,
            "dataPed"=>$dataPed,
            "dataEnv"=>$dataPed,
            "idCliente"=>$idCliente,
            "precoNota"=>$precoNota
        );
        
        array_push($tb_pedidos_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($tb_pedidos_arr);
}
else{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há pedidos cadastrados"));
}

?>