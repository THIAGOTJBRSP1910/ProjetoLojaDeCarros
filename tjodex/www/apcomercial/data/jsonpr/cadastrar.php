<?php

#Vamos definir os cabeçalhos para receber as infromações 
#no formato de json de diversas origens

header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Max-Age: 3600");
header("Acess-Control-Allow-Headers: Content-Type,Acess-Control-Allow-Headers, Authorization,X-Requested-With");

//Vamos importar a conexao com o bacon de dados
include_once "../../config/database.php";

//vamos importar a classe Usuarios
include_once "../../objects/produtos.php";

//instancia da classe Database 
$database = new Database();
$db = $database->getConnection();

//instancia da classe Usuarios
$produtos = new Produtos($db);

//vamos pegar os dados postados(enviados)

$data = json_decode(file_get_contents("php://input"));

//vamos verificar se os dados mais importantes
//foram preenchidos

if(
    
    !empty($data->nomeproduto) &&
    !empty($data->descricao) &&
    !empty($data->preco) &&
    !empty($data->img1) &&
    !empty($data->img2) &&
    !empty($data->img3) &&
    !empty($data->img4)
){
    //Se os dados nao estão preenchidos, então 
    //iremos passar para a api cadastrar 
    //em banco 


    $produtos->nomeproduto = $data->nomeproduto;
    $produtos->descricao = $data->descricao;
    $produtos->preco = $data->preco;
    $produtos->img1 = $data->img1;
    $produtos->img2 = $data->img2;
    $produtos->img3 = $data->img3;
    $produtos->img4 = $data->img4;

    //vamos tebtar executar o cadastro
    if($produtos->cadastro()){
        //iremos retornar ao internalta
        //a mensagem de cadastro realizado
        //e o codigo de sgatus de 201 de criado
        http_response_code(201);
        echo json_encode(array("mensagem"=>"Cadastro realizado"));   

    }
    else{
        http_response_code(503);//erro do servidor 
        echo json_encode(array("mensagem"=>"Não foi possivel cadastrar"));
    }
    
}
else{
    //mensagem para o usuario que os campos estao vazios
    http_response_code(400);//bad resquest
    echo json_encode(array("mensagem"=>"Preencha os dados"));
}



?>