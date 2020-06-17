<?php
	include("conexao.php");
	session_start();

//cadastro usuario	
	if(isset($_POST['enviar'])){
		$nome = $_POST ['nome'];
		$email = $_POST ['email'];
		$senha =  md5 ($_POST ['senha']);
		$regiao = $_POST ['regiao'];
		$cidade = $_POST ['cidade'];
		$endereço = $_POST ['endereço'];
		$cartão = $_POST ['cartão'];
		$senhaC = md5 ($_POST ['SenhaC']);
		$_SESSION['efetu'] = 'Cadastro efetuado com sucesso!';

		$sqlInsert = "INSERT INTO usuario(nome,email,senha,regiao,cidade,endereço)VALUES('$nome','$email','$senha','$regiao','$cidade','$endereço')";
		$insere = mysqli_query($conn, $sqlInsert);
	
	header('Location: ../conta.php');
	}
	
//cadastro produto
if(isset($_POST['envia3'])){
	$nome = $_POST ['nome'];
	$valor = $_POST ['valor'];
	$desc = $_POST ['descrição'];
	$carac = $_POST ['caracteristica'];
 
 
	$image = addslashes(file_get_contents($_FILES['img']['tmp_name']));


	$query = "INSERT INTO produtos (nome,valor,IMG,descrição,caracteristicas) VALUES('$nome','$valor','$image','$desc','$carac')";  

	$qry = mysqli_query($conn, $query);

	$_SESSION['produ_efetu'] = 'Produto cadastrado com sucesso!';

	header('Location: ../admin.php');
	}
?>
