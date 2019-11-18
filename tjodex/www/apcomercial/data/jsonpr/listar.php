<?php

//vamos usar o formato de json para selecionar 
//os dados vindos do banco de dados 
// A requisição a essa pagina pode ser feita por 
//meio de varios protocolos diferentes:
    //http ; https ; file ; ftp
//precisamos permitir o ascesso. Para isso vamos 
//usar cabeçalho de permição e controle 
header("Acess-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//vamos importar as informações de conexão com o banco 
//de dados por meio do comando include_one
include_once "../../config/database.php";

//Agora importaremos a classe usuário com suas funções 
//de crud 
include_once "../../objects/produtos.php";

//Instância da classe Database que possui as informações 
//de conexão com o banco de dados 
$database = new Database();
$db = $database->getConnection();

//iniciando o objeto da classe usuarios 
$produtos = new Produtos($db);

//chamando a função listar presente na classe usuario 
$stmt = $produtos->listar();
//Contar a quantidade de linhas que retornam da consulta 
$num = $stmt->rowCount();

/*
Se a quantidade de linhas for maior que 0(zero),então
nos as exibiremos em tela no formato de json .
Caso contrario, será exibida uma mensagem de nao localizado
*/

if($num > 0){
    //organizar os dados em formatos de array
    $produtos_arr = array();
    $produtos_arr["dados"]=array();
    
    
    while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
        //EXTRAIR o conteudo que esta retornando da 
        //linha e montar o array com os dados 
        extract($linha);
        $array_item = array(
            "idproduto"=>$idproduto,
            "nomeproduto"=>$nomeproduto,
            "descricao"=>$descricao,
            "preco"=>$preco,
            "img1"=>$img1,
            "img2"=>$img2,
            "img3"=>$img3,
            "img4"=>$img4
        );
        //Vamos Colocar os dados retornados em uma lista
        //de array(que chamamos de dados ) e preparar para 
        // a saida 

        array_push($produtos_arr["dados"],$array_item);

    } //Fim do laço while 
        //responder com o codigo de status postivo (200)
        http_response_code(200);
        //exibir os dados em formato de json
        echo json_encode($produtos_arr);
    }
    else{
        //responder que não foi encontrado com 
        //o status code 404 - not found
        http_response_code(404);
        echo json_encode(array("mensagem"=>"Não possivel localizar nenhum produto"));
    }


?>