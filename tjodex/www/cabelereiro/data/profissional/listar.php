<?php


//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");

//Formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/profissional.php";

$database = new Database();
$db = $database->getConnection();

$profissional = new Profissional($db);

$stmt =$profissional->listar();

if($stmt->rowCount()>0){
    $profissional_arr = array();
    $profissional_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idprofissional"=>$id,
            "nome"=>$nome,
            "funcao"=>$funcao,
            "idendereco"=>$idendereco,
            "idcontato"=>$idcontato,
            "idusuario"=>$idusuario
        );

        array_push($profissional_arr["saida"],$array_item);
    
    }
    header('HTTP/1.0 200');
    echo json_encode($profissional_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há profissionals cadastrados"));
}



?>

