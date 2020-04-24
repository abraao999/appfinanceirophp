<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);

if($postjson['requisicao'] == 'login'){
	$query = mysqli_query($mysqli, "select * from usuarios where usuario = '$postjson[usuario]' and senha = '$postjson[senha]'");
	$row = mysqli_num_rows($query);
	if($row>0){
		$data = mysqli_fetch_array($query);
		$datauser = array(
			'id' => $data['id'],
			'nome' => $data['nome'],
			'usuario' => $data['usuario'],
			'senha' => $data['senha'],
		);

		if($data['cargo'] == 'Administrador' or $data['cargo'] == 'Gerente' or $data['cargo'] == 'Tesoureiro'){
			$result = json_encode(array('success'=>true, 'result'=>$datauser));
		}else{
			$result = json_encode(array('success'=>false, 'msg'=>'Usuário sem Permissão'));
		}
	}else{
		$result = json_encode(array('success'=>false, 'msg'=>'Dados Incorretos!'));
	}

	echo $result;
}



?>
