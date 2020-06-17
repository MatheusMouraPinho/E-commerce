<?php
	session_start();
	include("conexao.php");
	include("login.php");
	
	$regiao = $_SESSION['Regiao'];
	$cidade = $_SESSION['Cidade'];
	$endereço = $_SESSION['Endereço'];
	$cliente = $_SESSION['User'];
	
	foreach($_SESSION['dados'] as $produtos){
		
	$nome = $produtos['nome'];
	$quantidade = $produtos['quantidade'];
	$preço = $produtos['preço'];
	$total = $produtos['total'];
	$usuario_id = $_SESSION['UsuarioId'];
	
	$insert = "INSERT INTO compras (produto,quantidade,preço,total,regiao,cidade,endereço,cliente,usu_id,Data) VALUES ('$nome','$quantidade','$preço','$total','$regiao','$cidade','$endereço','$cliente','$usuario_id',CURDATE())";  
	mysqli_query($conn, $insert);

	$_SESSION['compra_efetu'] = 'Compra efetuada com sucesso!';
	
	unset(
        $_SESSION['dados'],
        $_SESSION['carrinho']
    );
	
	header('Location: ../carrinho.php');
	}
	
	?>