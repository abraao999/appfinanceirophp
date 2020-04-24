<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


//LISTAGEM DOS MOVIMENTAÇÕES

if($postjson['requisicao'] == 'listar'){

    $query = mysqli_query($mysqli, "select * from movimentacoes order by id desc limit $postjson[start], $postjson[limit]");
    
    while($row = mysqli_fetch_array($query)){ 
        $dados[] = array(
            'id' => $row['id'], 
            'tipo' => $row['tipo'],
            'movimento' => $row['movimento'],
            'valor' => $row['valor'],
            'data' => $row['data'],
            'funcionario' => $row['funcionario'],
            'data2' => implode('/', array_reverse(explode('-', $row['data'])))
        );
            
    }
            
    if($query){
        $result = json_encode(array('success'=>true, 'result'=>$dados));
            
    }else{
        $result = json_encode(array('success'=>false));        
    }
        echo $result;
}elseif($postjson['requisicao'] == 'buscar'){
    $valor = 0;
            
    $query = mysqli_query($mysqli, "select * from movimentacoes 
    where data >= '$postjson[dataBuscarInicial]' 
    and data <= '$postjson[dataBuscarFinal]' 
    order by id desc 
    limit $postjson[start], $postjson[limit]");
            
    while($row = mysqli_fetch_array($query)){ 
        $dados[] = array(
            'id' => $row['id'], 
            'tipo' => $row['tipo'],
            'movimento' => $row['movimento'],
            'valor' => $row['valor'],
            'data' => $row['data'],
            'funcionario' => $row['funcionario'],
            'data2' => implode('/', array_reverse(explode('-', $row['data'])))
    );
        $valor = 1;
        
}
        
               if($valor == 1){
                       $result = json_encode(array('success'=>true, 'result'=>$dados));
        
                   }else{
                    $result = json_encode(array('success'=>false));
                   }
                   
                 
                   echo $result;

                }

        