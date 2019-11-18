<?php
header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     
     //Vamos importar as informações de conexão com o banco
     //de dados por meio do comando include_one
     include_once "../../config/database.php";

     include_once "../../objects/detalhes.php";

     $database = new Database();
     $db = $database->getConnection();

     $detalhespedidos = new Detalhespedidos($db);

     $stmt = $detalhespedidos->listar();

     
     $num = $stmt->rowCount();

     if($num > 0){
        //ORganizar os dados em formato de array
        $detalhespedidos_arr = array();
        $detalhespedidos_arr["dados"]=array();

        
        while($linhas = $stmt->fetch(PDO::FETCH_ASSOC)){
            //extraor o conteudo que está retornando da
            //linha e montar o array com todos os dados
            extract($linhas);
            $array_item = array(
                "iddetalhespedido"=>$iddetalhespedido,
                "idpedido"=>$idpedido,
                "idproduto"=>$idproduto,
                "quantidade"=>$quantidade
            );

            array_push($detalhespedidos_arr["dados"],$array_item);

        }
        http_response_code(200);
        //exibir os dados em formato de json
        echo json_encode($detalhespedidos_arr);
    }

    else{
        //responder que não foi encontrado com
        //o status code 404 - not found
        http_response_code(404);
        echo json_encode(array("mensagem"=>"Não foi possível localizar nenhum detalhe"));
    }

?>
