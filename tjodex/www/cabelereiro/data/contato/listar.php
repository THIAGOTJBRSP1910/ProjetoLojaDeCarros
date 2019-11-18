<?php
//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");
//Formato de transito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/contato.php";

$database = new Database();
$db = $database->getConnection();//getConnection efetua a conexão cm o banco

$contato = new Contato($db);

$stmt = $contato->listar();

if ($stmt->rowCount()>0) {
    $contato_arr = array();
    $contato_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idcontato"=>$id,
            "telefone"=>$telefone,
            "email"=>$email
        );

        array_push($contato_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($contato_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há contatos cadastrados"));
} 

?>