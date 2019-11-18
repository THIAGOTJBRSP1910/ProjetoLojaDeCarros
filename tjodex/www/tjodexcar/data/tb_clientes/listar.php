<?php

//permite o acesso a qualquer protocolo(https, http, file)

header("Access-Control-Allow-Origin:*"); // permitir o acesso controlado de todos os protocolos

//formato de trânsito, json com acentuação
header("Content-Type: application/json;charset=utf-8");

include_once "../../config/database.php"; // incluindo uma vez o arquivo database

include_once "../../domain/tb_clientes.php"; //incluindo os dmls(CRUDS)

$database = new Database();
$db = $database->getConnection(); // efetua a conexao com o banco

$tb_clientes = new tb_clientes($db);

$stmt =$tb_clientes->listar();

if($stmt->rowCount()>0){
    $tb_clientes_arr = array();
    $tb_clientes_arr["saida"]=array();
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){ // pegar todas a linhas que retornaram do banco e formar um novo array
        extract($linha);
        $array_item = array(
            "idCliente"=>$idCliente,
            "nomeCliente"=>$nomeCliente,
            "foneCliente"=>$foneCliente,
            "cpf"=>$cpf,
            "rg"=>$rg,
            "email"=>$email,
            "cep"=>$cep,
            "endereco"=>$endereco,
            "numero"=>$numero,
            "complemento"=>$complemento,
            "estado"=>$estado,
            "cidade"=>$cidade,
            "bairro"=>$bairro
            
        );
        
        array_push($tb_clientes_arr["saida"],$array_item);
    }
    header('HTTP/1.0 200');
    echo json_encode($tb_clientes_arr);
}
else{
    header('HTTP/1.0 400');
    echo json_encode(array("mensagem"=>"Não há clientes cadastrados"));
}

?>