<?php
include ('../site/php/login.php');

$result = "SELECT * FROM compras";
$resultado = mysqli_query($conn, $result);

if($_SESSION['UsuarioId'] != "1"){
	header("Location: index.php");
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

        if(isset($_SESSION['produ_efetu'])) {
        echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['produ_efetu']. "</div>";
        unset($_SESSION['produ_efetu']); 
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
                        <li class="active"><a href="admin.php">Produtos</a></li>
                        <li><a href="admin2.php">Funcionarios</a></li>
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
                        <h2>Produtos</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br/>

<div class="container" align="center">
<H2>Cadastro de Produtos</h2><br/>
<div class="col-md-6">

	<form action="../site/php/cadastro.php" method="POST" enctype="multipart/form-data">
		
		<label>nome: </label><br>
		<input type="text" class="form-control"  placeholder="Digite aqui..."  name="nome" /> <br></br>
		
		<label>Preço: </label><br>
		<input type="text" class="form-control" placeholder="Digite aqui..." name="valor" /><br><br><br><br><br>
		
		<label>Imagem:</label><br>
        <input type="file" name="img"/> <br><br>
        
</div>
		<div class="col-md-6">
			<label>Descrição do produto:</label><br>
			<textarea type="text" class="form-control" placeholder="Digite aqui..."  name="descrição" cols="30" rows="7"></textarea> <br><br>
		
		
			<label>Caracteristicas:</label> <br>
			<textarea type="text" class="form-control" placeholder="Digite aqui..." name="caracteristica" cols="30" rows="7" ></textarea> <br><br>
		</div>
		
		<input type="submit" name="envia3" value="Cadastrar Produto"/>
    </form>
		
</div>
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


