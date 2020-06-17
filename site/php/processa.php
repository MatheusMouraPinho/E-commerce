<?php
require_once("conexao.php");
require_once("login.php");

	//produto
	$id_compra = $_GET['id_compra'];

 	//usuario
 	$usuario = $_SESSION['UsuarioId'];


if(!empty($_POST['estrela'])){
	$estrela = $_POST['estrela'];

	//Salvando no banco
	$result_avalia = "INSERT INTO avaliacoes (qnt_estrelas, criado, id_usuario, produto) VALUES ('$estrela', NOW(), '$usuario', '$id_compra')";
	$resultado_avalia = mysqli_query($conn, $result_avalia);

	if(mysqli_insert_id($conn)){
		$_SESSION['avalia_efetu'] = 'Avaliação cadastrada com sucesso!';
		header('Location: ../detalhes.php?id_pagina='.$id_compra);
	}else{
		$_SESSION['avalia_error'] = 'Erro ao cadastrar avaliação!';
		header('Location: ../detalhes.php?id_pagina='.$id_compra);
	}
}else{	
	$_SESSION['msg'] = 'Necessário selecionar ao menos uma estrela!';
	header('Location: ../detalhes.php?id_pagina='.$id_compra);
}
?>