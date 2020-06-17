<?php

include ('../site/php/login.php');

if($_SESSION['UsuarioId'] != "1"){
	header("Location: index.php");
}

require_once 'classes/Funcionario.class.php';
require_once 'classes/Funcoes.class.php';

$objFcn = new Funcionario();
$objFcs = new Funcoes();

if(isset($_POST['btCadastrar'])){
    if($objFcn->queryInsert($_POST) == 'ok'){
        $_SESSION['cadas_efetu'] = 'Cadastro efetuado com sucesso!';
        header('location: admin2.php');
    }else{
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

if(isset($_POST['btAlterar'])){
    if($objFcn->queryUpdate($_POST) == 'ok'){
        header('location: ?acao=edit&func='.$objFcs->base64($_POST['func'],1));
    }else{
        echo '<script type="text/javascript">alert("Erro em alterar");</script>';
    }
}

if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit': $func = $objFcn->querySeleciona($_GET['func']); break;
        case 'delet':
            if($objFcn->queryDelete($_GET['func']) == 'ok'){
                header('location: admin2.php');
            }else{
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
                break;
    }
}


?>
<!DOCTYPE html>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Integrado</title>
    
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

  </head>
  <body>
    <?php

        if(isset($_SESSION['cadas_efetu'])) {
        echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['cadas_efetu']. "</div>";
        unset($_SESSION['cadas_efetu']); 
        }
    ?>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div> 
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="index.php"><img src="img/logo.png"></a></h1>
                    </div>
                </div>
			</div> 
        </div>
    </div> 
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Alternador de navegaçao</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="admin.php">Produtos</a></li>
                        <li class="active"><a href="admin2.php">Funcionarios</a></li>
						<li><a href="admin3.php">Encomendas</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> 
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Funcionarios</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br>
	
		<div class="container" align="center">
	<H2>Cadastro de Funcionarios</h2><br/>
		<div class="col-md-6">
	<form name="formCad" action="" method="post">
			<label>Nome: </label><br>
			<input type="text" class="form-control" placeholder="Digite aqui..." name="nome" required="required" value="<?=$objFcs->tratarCaracter((isset($func['nome']))?($func['nome']):(''), 2)?>"><br><br>
			<label>E-mail: </label><br>
			<input type="text" class="form-control" placeholder="Digite aqui..." name="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?=$objFcs->tratarCaracter((isset($func['email']))?($func['email']):(''), 2)?>"><br><br>
		</div>
		<div class="col-md-6">
			<?php if(isset($_GET['acao']) <> 'edit'){ ?>
			<label>Senha: </label><br>
			<input type="password" class="form-control" placeholder="Digite aqui..." name="senha" required="required"><br><br>
			<?php } ?>
			<label>Salario: </label><br>
			<input type="text" class="form-control" placeholder="Digite aqui..." name="salario" required="required"><br>
			<br>
		</div>
		<div class="col-md-12">
			<input type="submit" name="<?=(isset($_GET['acao']) == 'edit')?('btAlterar'):('btCadastrar')?>" value="<?=(isset($_GET['acao']) == 'edit')?('Alterar'):('Cadastrar Funcionario')?>">
			<input type="hidden" name="func" value="<?=(isset($func['idFuncionario']))?($objFcs->base64($func['idFuncionario'], 1)):('')?>">
		</div>
	</form>
			
</div>
<br/>
	
	<br>
	
<div class="container" align="center">
	<div class="col-md-12">
	<H2>Tabela Funcionarios</h2><br/>
		<table id="example" class="table table-striped table-bordered" style="width:80%">
			<thead>
				<td>Data</td>
				<td width="300">nome</td>
				<td width="150">Email</td>
				<td>Salario</td>
				<td width="50">Editar</td>
				<td width="50">Excluir</td>
			</thead>
			<?php foreach($objFcn->querySelect() as $rst){ 
			$salario = number_format($rst['salario'], 2, ',', '.');
			?>
			<tr>
				<td width="100"><?=$rst['data_cadastro']?></td>  
				<td width="200"><?=$objFcs->tratarCaracter($rst['nome'], 2)?></td>
				<td width="100"><?=$rst['email']?></td> 
				<td ><?=$salario?></td>
				<td>&nbsp;&nbsp;<a href="?acao=edit&func=<?=$objFcs->base64($rst['idFuncionario'], 1)?>" title="Editar dados"><img src="img/ico-editar.png" width="16" height="16" alt="Editar"></a> </td>
				<td>&nbsp;&nbsp;<a href="?acao=delet&func=<?=$objFcs->base64($rst['idFuncionario'], 1)?>" title="Excluir esse dado"><img src="img/ico-excluir.png" width="16" height="16" alt="Excluir"></a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<br/><br/><br/>
	
	
		<br/>
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>E<span>Commerce</span></h2>
                        <p>Colocar informações do grupo depois...</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Navegação do usuário </h2>
                        <ul>
                            <li><a href="conta.html">Minha conta</a></li>
                            <li><a href="#">Histórico de pedidos</a></li>
                            <li><a href="#">Lista de desejos</a></li>
                            <li><a href="#">Contato do fornecedor</a></li>
                            <li><a href="index.html">Página inicial</a></li>
                        </ul>                         
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Marcas</h2>
                        <ul>
                            <li><a href="#">Asus</a></li>
                            <li><a href="#">Asrock</a></li>
                            <li><a href="#">Galax</a></li>
                            <li><a href="#">Gigabyte</a></li>
                            <li><a href="#">Msi</a></li>
                            <li><a href="#">Zotac</a></li>
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2019 Projeto integrado. Todos os direitos reservados. </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <script src="js/main.js"></script>
  </body>
</html>
