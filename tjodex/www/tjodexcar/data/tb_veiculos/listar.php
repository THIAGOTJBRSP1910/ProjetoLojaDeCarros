<?php

//permite o acesso a qualquer protocolo(https, http, file)

header("Access-Control-Allow-Origin:*"); // permitir o acesso controlado de todos os protocolos

//formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php"; // incluindo uma vez o arquivo database

include_once "../../domain/tb_veiculos.php"; //incluindo os dmls(CRUDS)

$database = new Database();
$db = $database->getConnection(); // efetua a conexao com o banco

$tb_veiculos = new tb_veiculos($db);

$stmt =$tb_veiculos->listar();

if($stmt->rowCount()>0){
    $tb_veiculos_arr = array();
    $tb_veiculos_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){ // pegar todas a linhas que retornaram do banco e formar um novo array
        extract($linha);
        $array_item = array(
            "codigoVeiculo"=>$codigoVeiculo,
            "marca"=>$marca,
            "modelo"=>$modelo,
            "ano"=>$ano,
            "preco"=>$preco,
            "kilometragem"=>$kilometragem,
            "cambio"=>$cambio,
            "carroceria"=>$carroceria,
            "combustivel"=>$combustivel,
            "finalPlaca"=>$finalPlaca,
            "cor"=>$cor,
            "ipvaPago"=>$ipvaPago,
            "estoque"=>$estoque,
            "imagem1"=>$imagem1,
            "imagem2"=>$imagem2,
            "imagem3"=>$imagem3
            
        );
        
        array_push($tb_veiculos_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($tb_veiculos_arr);
}
else{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há veiculos$tb_veiculos cadastrados"));
}

?>