<?php
	include("conexao.php");
	include("login.php");
	
$id_usuario = $_SESSION['UsuarioId'];

	
if ($_GET['id_produto']){
		

$id_produto = $_GET['id_produto'];
	
	$result = "SELECT * FROM favoritos WHERE usuario='$id_usuario'";
	$resultado = mysqli_query($conn, $result);
	$row = mysqli_fetch_assoc($resultado);

		if ($row['produto'] == $id_produto){
		
		header("location: ../detalhes.php?id_pagina=$id_produto ");
		
		//aqui se ja estiver no fav
		
		}else{
			$result2 = "INSERT INTO favoritos (produto, usuario) VALUES ('$id_produto', '$id_usuario')";
			mysqli_query($conn, $result2);

			$_SESSION['fav'] = "Produto favoritado com sucesso!";

			header("location: ../detalhes.php?id_pagina=$id_produto ");
			}
}

	
	
if ($_GET['remov']){
	
		$id_remov = $_GET['remov'];
		
		$del = "DELETE FROM favoritos WHERE produto ='$id_remov' and usuario= '$id_usuario' ";
		mysqli_query($conn, $del);
		header("location:../conta.php");
}
	
	?>