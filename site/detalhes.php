<?php 
include_once("../site/php/conexao.php");
include ('../site/php/login.php');

$id_pagina = $_GET['id_pagina'];

$sql = "UPDATE produtos SET click = click + 1 WHERE id='$id_pagina'";
mysqli_query($conn, $sql);

$result = "SELECT * FROM produtos WHERE id='$id_pagina'";
$resultado = mysqli_query($conn, $result);
$row_pesquisa = mysqli_fetch_assoc($resultado);

$preco = number_format($row_pesquisa['valor'], 2, ',', '.');

//usuario
if($_SESSION == true){
    $id_pagina = $_GET['id_pagina'];
    $usuario = $_SESSION['UsuarioId'];
// Consultando o banco se o usuário já tem avaliação cadastrada
    $query_consulta = "SELECT * FROM avaliacoes WHERE produto = '{$id_pagina}' and id_usuario = '{$usuario}'";
    $resultado_consult = mysqli_query($conn, $query_consulta);
    $result_consult = mysqli_fetch_assoc($resultado_consult) ;
}
    if(isset($result_consult)){
        $_SESSION['Qnt_estrelas'] = $result_consult['qnt_estrelas'];
        $_SESSION['Usuarioid'] = $result_consult['id_usuario'];
        $_SESSION['Produto'] = $result_consult['produto'];
    }
        //Media das avaliações de cada produto
    $query_media = "SELECT avg(qnt_estrelas) from avaliacoes where produto = '{$id_pagina}'";
    $result_media = mysqli_query($conn, $query_media);
    $resultado_media = mysqli_fetch_array($result_media) ;

    //Contagem de quantas avaliações foram feitas
    $query_soma = "SELECT count(id) from avaliacoes where produto = '{$id_pagina}'";
    $result_soma = mysqli_query($conn, $query_soma);
    $resultado_soma = mysqli_fetch_array($result_soma);

?>


<!DOCTYPE html>

<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Integrado - Produto</title>
    

    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="estrelas.css.css">
    <link rel="stylesheet" href="estrelas.css">


  </head>
  <body>
    <form action="../site/php/fav.php" method="_SESSION">
        <?php

            if(isset($_SESSION['fav'])) {
            echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['fav']. "</div>";
            unset($_SESSION['fav']); 
            }
        ?>
    </form>
    
    <form action="../site/php/dados.php" method="_SESSION">
        <?php

            if(isset($_SESSION['compra_efetu'])) {
            echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['compra_efetu']. "</div>";
            unset($_SESSION['compra_efetu']); 
            }
        ?>
    </form>
	
    <form action="../site/php/processa" method="_SESSION">
        <?php
            if(isset($_SESSION['avalia_error'])){
                echo "<div class='alert alert-warning alert-dismissible' align='center' role=alert>" .$_SESSION['avalia_error']. "</div>";
                unset($_SESSION['avalia_error']); 
            }

            elseif(isset($_SESSION['avalia_efetu'])){
                echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['avalia_efetu']. "</div>";
                unset($_SESSION['avalia_efetu']); 
                            }
        ?>
    </form>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-menu">
                        <ul>
                            
                            <?php if($_SESSION == true){ ?>
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
                        <h2>Informação do produto</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Procurar produtos</h2>
                        <form class="form-inline" method="GET" action="pesquisar.php">
                            <input type="text" name="pesquisar" placeholder="Procurar produtos...">
                            <input type="submit" value="Procurar">
                        </form>
                    </div>
                </div>
				
				<div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Home</a>
                            <a href="">Placa de vídeo</a>
                            <a href=""><?php echo $row_pesquisa['nome']; ?></a>
                        </div>
					</div>
                    <div class="col-sm-6">
                        <div class="conatiner">
                            <img src= <?php echo'data:image/jpeg;base64,'.base64_encode( $row_pesquisa['IMG'] )?> Height= "300" width="300" ;/>
                            <?php if($_SESSION == true){ ?>
                            <div class="bottomleft"><a href="../site/php/fav.php?id_produto=<?php echo $row_pesquisa['id']; ?>" title="Fav"><img src="img/favoritos.jpg" width="50" height="50" alt="Fav"></a></div>
                            <?php }else{ ?>
                            <div class="bottomleft"><a href="aviso.php" title="Fav"><img src="img/favoritos.jpg" width="50" height="50" alt="Fav"></a></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="product-inner">
                            <div class="caption text-center">
                                <h2 class="product-name"><?php echo $row_pesquisa['nome']; ?></h2>
                                
                                <div class="product-inner-price">
                                    <ins><h4><?php echo $preco ; ?></h4></ins>
                                </div>
                                
                                <?php	if($_SESSION == true){ ?> 
                                    
                                <p><a href="../site/php/dados.php?id_compra=<?php echo $row_pesquisa['id']; ?>" class="btn btn-primary" role="button">Comprar</a></p><br/>
                                
                                
                                        <div class="col-sm-12">
                                        <a href="carrinho.php?acao=add&id=<?php echo $row_pesquisa['id']; ?>" class="add_to_cart_button" role="button">Adicionar ao carrinho</a>
                                        </div>
                                        
                                        <br></br><br></br>	
                                <?php
                                }else {   //sem usuario
                                ?>
                            
                                    <a href="aviso.php" class="btn btn-primary" role="button">Comprar</a></p><br/> <br/>
                                        <div class="col-sm-12">
                                        <a href="aviso.php" class="add_to_cart_button" role="button">Adicionar ao carrinho</a>
                                        </div>
                                        
                                        <br></br><br></br>
                                        
                                        
                                <?php } //fim ?>
                            </div>
                            <div role="tabpanel">
                                <ul class="product-tab" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descrição</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <h2>Descrição do produto</h2>  
                                        <p><?php echo $row_pesquisa['descrição']; ?></p>
                                        
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Caracteristicas</a></li>
                                        <?php echo $row_pesquisa['caracteristicas']; ?>
                                    </div>
                                </div>
                            </div>
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