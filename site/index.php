<?php
include("../site/php/conexao.php");
include ('../site/php/login.php');

// organiza por item mais coma mias click
$sql = mysqli_query ($conn, "SELECT * FROM produtos ORDER BY click DESC LIMIT 3");
//organiza poer order de id os produtos mais recentes
$rec = mysqli_query ($conn, "SELECT * FROM produtos ORDER BY id DESC LIMIT 5");
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
    if(isset($_SESSION['logged_success'])) {
        echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['logged_success']. "</div>";
        unset($_SESSION['logged_success']); // depois de imprimir o que queremos apagamos esta var da sessão
    }
    ?>
   
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
    
	
	
    <div class="slider-area">
	<div style= 'text-align:center'><h1>Destaques</h1></div>
        <div class="slide">
			<ul class="" id="bxslider-home4">
				<?php while($data = mysqli_fetch_array($sql)){ ?>	
					<div class="block-slider img">
						<img src= <?php echo'data:image/jpeg;base64,'.base64_encode ($data['IMG'])?>  ;/> 
					</div>
				
				<?php } ?>	
			
			</ul>
		</div>
    </div> 
   
	<br><br><br><br><br><br><br><br>
	
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>Retorno de 30 dias</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Frete grátis</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Pagamento seguro</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>Novos Produtos</p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Produtos mais recentes</h2>
                        <div class="product-carousel">
						
					<?php while($data = mysqli_fetch_array($rec)){ 
					$preco = number_format($data['valor'], 2, ',', '.');
					?>
						
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src= <?php echo'data:image/jpeg;base64,'.base64_encode ($data['IMG'])?>  ;/>
                                    <p><a href="../site/detalhes.php?id_pagina=<?php echo $data['id']; ?>" class="btn btn-primary" role="button">Ver Detalhes</a> </p>
                                </div>
                                
                                <h2><?php echo $data['nome'];?></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><h4><?php echo "R$" . $preco;?></h4></ins>
                                </div> 
                            </div>
                           
					<?php } ?>
						   
                         </div>                            
                      </div>
                   </div>
                </div>
            </div>
       </div>
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="img/brand1.png" alt="">
                            <img src="img/brand2.png" alt="">
                            <img src="img/brand3.png" alt="">
                            <img src="img/brand4.png" alt="">
                            <img src="img/brand5.png" alt="">
                            <img src="img/brand6.png" alt="">
                            <img src="img/brand1.png" alt="">
                            <img src="img/brand2.png" alt="">                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <li><a href="#">Página inicial</a></li>
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
    
    <script type="text/javascript" src="js/bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.slider.js"></script>
  </body>
</html>