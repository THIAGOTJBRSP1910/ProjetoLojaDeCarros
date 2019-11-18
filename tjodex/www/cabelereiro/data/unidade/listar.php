<?php


//Permite o acesso a qualquer protocolo(https, http, file)
header("Access-Control-Allow-Origin:*");

//Formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php";

include_once "../../domain/usuario.php";

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

$stmt =$usuario->listar();

if($stmt->rowCount()>0){
    $usuario_arr = array();
    $usuario_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($linha);
        $array_item = array(
            "idusuario"=>$id,
            "login"=>$login,
            "senha"=>$senha
        );

        array_push($usuario_arr["saida"],$array_item);
    
    }
    header('HTTP/1.0 200');
    echo json_encode($usuario_arr);
}
else
{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há usuarios cadastrados"));
}



?>

