<?php
//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");
//Formato de transito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/preco.php";

$database = new Database();
$db = $database->getConnection();//getConnection efetua a conexão cm o banco

$preco = new Preco($db);

$stmt = $preco->listar();

if ($stmt->rowCount()>0) {
    $preco_arr = array();
    $preco_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idpreco"=>$id,
            "preco"=>$preco
        );

        array_push($preco_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($preco_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há precos cadastrados"));
} 

?>