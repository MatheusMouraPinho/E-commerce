<?php
	include("conexao.php");
	include("login.php");
	
	
	
	$id_compra = $_GET['id_compra'];
		
		
	$result = "SELECT * FROM produtos WHERE id='$id_compra'";
	$resultado = mysqli_query($conn, $result);
 	$row = mysqli_fetch_assoc($resultado);
	
	if ($row['id'] = $id_compra){
	$produto = $row['nome'];
	$preço = $row['valor'];
	$total = $row['valor'];
	}
	$regiao = $_SESSION['Regiao'];
	$cidade = $_SESSION['Cidade'];
	$endereço = $_SESSION['Endereço'];
	$cliente = $_SESSION['User'];
	$registro = $_SESSION['Registro'];
	$usuario_id = $_SESSION['UsuarioId'];
	
		
	$sql3 = "INSERT INTO compras (produto,preço,total,regiao,cidade,endereço,cliente,usu_id,Data) VALUES ('$produto','$preço','$total','$regiao','$cidade','$endereço','$cliente','$usuario_id',CURDATE())";	
		mysqli_query($conn, $sql3);

		$_SESSION['compra_efetu'] = 'Compra efetuada com sucesso!';
		
		header('Location: ../detalhes.php?id_pagina='.$id_compra);
	
?>