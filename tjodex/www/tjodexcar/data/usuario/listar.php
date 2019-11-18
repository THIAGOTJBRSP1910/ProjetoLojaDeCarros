<?php

//permite o acesso a qualquer protocolo(https, http, file)

header("Access-Control-Allow-Origin:*"); // permitir o acesso controlado de todos os protocolos

//formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php"; // incluindo uma vez o arquivo database

include_once "../../domain/usuario.php"; //incluindo os dmls(CRUDS)

$database = new Database();
$db = $database->getConnection(); // efetua a conexao com o banco

$usuario = new usuario($db);

$stmt =$usuario->listar();

if($stmt->rowCount()>0){
    $usuario_arr = array();
    $usuario_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){ // pegar todas a linhas que retornaram do banco e formar um novo array
        extract($linha);
        $array_item = array(
            "id"=>$id,
            "login"=>$login,
            "senha"=>$senha
        );
        
        array_push($usuario_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($usuario_arr);
}
else{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há usuarios cadastrados"));
}

?>