<?php
include('conexao.php');
session_start();
if(isset($_POST['login'])){
	 
	if(empty($_POST['email']) || empty($_POST['senha'])) {
	header("Location: ../site/conta.php");
	
	}
	 else
    {

 
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
 
		$query = "select * from usuario where email = '{$email}' and senha = md5('{$senha}')";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);
		
		mysqli_num_rows($result);
 
        if(isset($resultado)){
            $_SESSION['UsuarioId'] = $resultado['id'];
            $_SESSION['User'] = $resultado['nome'];
			$_SESSION['Regiao'] = $resultado['regiao'];
			$_SESSION['Cidade'] = $resultado['cidade'];
			$_SESSION['Endereço'] = $resultado['endereço'];

			$_SESSION['logged_success'] = 'Você foi logado com sucesso!';
			
            
			if($_SESSION['UsuarioId'] == "1"){
                header("Location: ../admin.php");
            }elseif($_SESSION['UsuarioId'] > "1"){
                header("Location: ../index.php");
			} 
 
 
 
		
        }
        else{
	        $_SESSION['logged_invalido'] = 'Senha ou usuário digitados são inválidos!';
				?>
				<script>location.href='../conta.php';</script>
				<?php
        }
    }
}
 
?>