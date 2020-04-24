<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


//LISTAGEM DOS GASTOS

if($postjson['requisicao'] == 'listar'){

    $query = mysqli_query($mysqli, "select * from gastos order by data desc limit $postjson[start], $postjson[limit]");

 	while($row = mysqli_fetch_array($query)){ 
 		$dados[] = array(
 			'id' => $row['id'], 
 			'motivo' => $row['motivo'],
			'valor' => $row['valor'],
			'funcionario' => $row['funcionario'],
            'data' => $row['data'],
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
    
    $query = mysqli_query($mysqli, "select * from gastos where data = '$postjson[dataBuscar]' order by data desc limit $postjson[start], $postjson[limit]");
    
    while($row = mysqli_fetch_array($query)){ 
        $dados[] = array(
            'id' => $row['id'], 
            'motivo' => $row['motivo'],
            'valor' => $row['valor'],
            'funcionario' => $row['funcionario'],
            'data' => $row['data'],
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


}elseif($postjson['requisicao'] == 'add'){

    $query = mysqli_query($mysqli, "INSERT INTO gastos SET motivo = '$postjson[motivo]', valor = '$postjson[valor]', funcionario = '$postjson[usuario]', data = curDate()");

     $id = mysqli_insert_id($mysqli);
     

    $query_mov = mysqli_query($mysqli, "INSERT INTO movimentacoes (tipo, movimento, valor, funcionario, data, id_movimento) VALUES ('Saída', 'Gasto', '$postjson[valor]', '$postjson[usuario]', curDate(), '$id')");

 	

 	if($query){
 		$result = json_encode(array('success'=>true, 'id'=>$id));

 	}else{
 		$result = json_encode(array('success'=>false));

 	}
	 echo $result;

}elseif($postjson['requisicao'] == 'editar'){

    $query = mysqli_query($mysqli, "UPDATE gastos SET motivo = '$postjson[motivo]' WHERE id = '$postjson[id]' ");

    $id = mysqli_insert_id($mysqli);
 if($query){
     $result = json_encode(array('success'=>true, 'id'=>$id));

 }else{
     $result = json_encode(array('success'=>false));

 }
 echo $result;



}elseif($postjson['requisicao'] == 'excluir'){

    $query = mysqli_query($mysqli, "DELETE FROM gastos where id='$postjson[id]' ");
    $query = mysqli_query($mysqli, "DELETE FROM movimentacoes where id_movimento='$postjson[id]' and movimento = 'Gasto' ");

	if($query){
		$result = json_encode(array('success'=>true, 'result'=>'success'));

	}else{
		$result = json_encode(array('success'=>false, 'result'=>'error'));

	}
	echo $result;


}