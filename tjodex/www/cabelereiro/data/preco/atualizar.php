<?php
#Vamos definir os cabeçalhos acesso e escrita de informaçoes para a api
header("Access-Control-Allow-Origin");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age:3600"); //Quanto tempo leva para processar o cadastro(1minuto)

//importação da conexão com o banco de dados
include_once "../../config/database.php";
//importação da classe usuario
include_once "../../domain/preco.php";
//Iniciar a instancia do banco de dados
$database = new Database();
//chamada da função de conexão com o banco de dados
$db = $database->getConnection();
//Instancia da classe usuario
$preco = new Preco($db);
/*
Vamos preparar o php para receber os dados que estão sendo enviados pelo usuario
Utilizaremos o comando php://input
*/
$data = json_decode(file_get_contents("php://input"));
//Verificar se os dados enviados pelo usuario estão realmente com dados, se não há nada vazio
if (!empty($data->preco) && !empty($data->idpreco)) {
    $preco->preco = $data->preco;
    $preco->idpreco = $data->idpreco;

    if($preco->atualizar()){
        header("HTTP/1.0 200");
        echo json_encode(array("mensagem"=>"preco atualizado com sucesso!"));
    }
    else {
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Erro ao tentar atualizar"));
    }
}
else {
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Você não pode enviar dados vazios"));
}
?>