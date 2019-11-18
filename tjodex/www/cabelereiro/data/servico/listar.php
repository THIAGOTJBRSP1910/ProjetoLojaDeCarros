<?php


//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");

//Formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/servico.php";

$database = new Database();
$db = $database->getConnection();

$servico = new Servico($db);

$stmt =$servico->listar();

if($stmt->rowCount()>0){
    $servico_arr = array();
    $servico_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idservico"=>$id,
            "tiposervico"=>$tiposervico,
            "idpreco"=>$idpreco
        );

        array_push($servico_arr["saida"],$array_item);
    
    }
    header('HTTP/1.0 200');
    echo json_encode($servico_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há serviço cadastrados"));
}



?>

