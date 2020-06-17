<?php
include ('../site/php/login.php');


$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
if(!isset($_GET['pesquisar'])){
	header("Location: ../produtos.php");
}else{
	$valor_pesquisar = $_GET['pesquisar'];
}


$result = "SELECT * FROM produtos WHERE nome LIKE '%$valor_pesquisar%'";
$resultado = mysqli_query($conn, $result);

$total_pesquisa = mysqli_num_rows($resultado);

$quantidade_pg = 9;

$num_pagina = ceil($total_pesquisa/$quantidade_pg);

$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

$result = "SELECT * FROM produtos WHERE nome LIKE '%$valor_pesquisar%' limit $incio, $quantidade_pg";
$resultado = mysqli_query($conn, $result);
$total_pesquisa = mysqli_num_rows($resultado);
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
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-menu">
                        <ul>
                            
                            <?php	if($_SESSION == true){ ?>
								<li>	
									<form action="../site/php/logout.php" method="post">
										<?php	echo ' Bem vindo ' . $_SESSION['User']. ' ! '?>
										<button name="logout" type="submit" class="button is-block is-link is-large is-fullwidth">Sair</button>
									</form>
								</li>
							<?php }else{ ?>
							<li><a href="conta.php"><i class="fa fa-user"></i>Cadastro / Login</a></li>
							<?php } ?>
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
				<?php	if($_SESSION == true && $_SESSION['quantidade'] > 0 ){ ?>
				<div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="carrinho.php">Carrinho - <span class="cart-amunt"><?php echo $_SESSION['total']; ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $_SESSION['quantidade']; ?></span></a>
                    </div>
                </div>
				<?php }elseif($_SESSION != true || $_SESSION['quantidade'] == 0){ ?>
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="carrinho.php">Carrinho - <span class="cart-amunt">R$0</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">0</span></a>
                    </div>
                </div>
				<?php } ?>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="produtos.php">Produtos da loja</a></li>
                        <?php if($_SESSION == true){ ?>
						    <li><a href="conta.php">Minha Conta</a></li>
						<?php } ?>
                        <?php if($_SESSION['UsuarioId'] == "1"){ ?>
						    <li><a href="admin.php">Painel Admin</a></li>
						<?php } ?>
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

		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<div class="row">
					
					<div align="center" class="col-sm-12 col-md-12">
						<form class="form-inline" method="GET" action="pesquisar.php">
							<div class="form-group">
								<label for="exampleInputName2">Pesquisar</label>
								<input type="text" name="pesquisar" class="form-control" id="exampleInputName2" placeholder="Digitar...">
							</div>
							<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<?php while($rows_pesquisa = mysqli_fetch_assoc($resultado)){ 
				$preco = number_format($rows_pesquisa['valor'], 2, ',', '.');
				?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src= <?php echo'data:image/jpeg;base64,'.base64_encode( $rows_pesquisa['IMG'] )?> Height= "150" width="150" ;/>
							<div class="caption text-center">
								<p><h3><?php echo $rows_pesquisa['nome']; ?></h3></p>
								<p><h4><?php echo $preco; ?></h4></p>
								<p><a href="../site/detalhes.php?id_pagina=<?php echo $rows_pesquisa['id']; ?>" class="btn btn-primary" role="button">Ver Detalhes</a> </p>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>
			<nav class="text-center">
				<ul class="pagination">
					<li>
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="pesquisar.php?pagina=<?php echo $pagina_anterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&laquo;</span>
					<?php }  ?>
					</li>
					<?php
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="pesquisar.php?pagina=<?php echo $i; ?>&pesquisar=<?php echo $valor_pesquisar; ?>"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="pesquisar.php?pagina=<?php echo $pagina_posterior; ?>&pesquisar=<?php echo $valor_pesquisar; ?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>
		</div>
		
		
		
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
                            <li><a href="#">Minha conta</a></li>
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
                            <li><a href="pagina2.php">Asus</a></li>
                            <li><a href="pagina4.php">Asrock</a></li>
                            <li><a href="pagina1.php">Galax</a></li>
                            <li><a href="pagina5.php">Gigabyte</a></li>
                            <li><a href="pagina3.php">Msi</a></li>
                            <li><a href="pagina6.php">Zotac</a></li>
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