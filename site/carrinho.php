   <?php   
   include ('../site/php/login.php');
   if($_SESSION['UsuarioId'] > "0"){
   
	
	if(!isset($_SESSION['carrinho'])){ 
		$_SESSION['carrinho'] = array(); 
	} //adiciona produto 
	
	if(isset($_GET['acao'])){ 
		//ADICIONAR CARRINHO 
		if($_GET['acao'] == 'add'){ 
			$id = intval($_GET['id']); 
			if(!isset($_SESSION['carrinho'][$id])){ 
				$_SESSION['carrinho'][$id] = 1; 
			} else { 
				$_SESSION['carrinho'][$id] += 1; 
			} 
		} //REMOVER CARRINHO 
	
		if($_GET['acao'] == 'del'){ 
			$id = intval($_GET['id']); 
			if(isset($_SESSION['carrinho'][$id])){ 
				unset($_SESSION['carrinho'][$id]); 
			} 
		} //ALTERAR QUANTIDADE 
		if($_GET['acao'] == 'up'){ 
			if(is_array($_POST['prod'])){ 
				foreach($_POST['prod'] as $id => $qtd){
						$id  = intval($id);
						$qtd = intval($qtd);
						if(!empty($qtd) || $qtd <> 0){
							$_SESSION['carrinho'][$id] = $qtd;
						}else{
							unset($_SESSION['carrinho'][$id]);
						}
				}
			}
		}
		
		header("location: carrinho.php");  
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
    <form action="../site/php/finalizar.php" method="_SESSION">
        <?php

            if(isset($_SESSION['compra_efetu'])) {
            echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['compra_efetu']. "</div>";
            unset($_SESSION['compra_efetu']); 
            }
        ?>
    </form>
   
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
                        <h2>Meu carrinho</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<br/>
	
<div class="container" align="center">
<div class="col-md-12"> 
  
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th width="244">Produto</th>
				<th width="100">Quantidade</th>
				<th width="89">Preço</th>
				<th width="100">SubTotal</th>
				<th width="64">Remover</th>
			</tr>
		</thead>
		<form action="?acao=up" method="post">
		<tfoot>
			<tr>
				<td colspan="5"><input type="submit" name="prod" value="Atualizar Carrinho" /></td>
			<tr>
			<td colspan="5"=><a class="btn btn-primary" href="produtos.php">Continuar Comprando</a>
			&nbsp;&nbsp; ou &nbsp;&nbsp;
			<a class="btn btn-primary" href="../site/php/finalizar.php">Finalizar Pedido</a></td>
		</tfoot>
		<tbody>
     <?php
        if(count($_SESSION['carrinho']) == 0){
          echo '
				<tr>
					<td colspan="5">Não há produto no carrinho</td>
				</tr>
			';
          } else {
                require("../site/php/conexao.php");
                
				$_SESSION['dados'] = array();
				
				$total = 0;
                foreach($_SESSION['carrinho'] as $id => $qtd){
                        $sql   = "SELECT *  FROM produtos WHERE id= '$id'";
                        $query = mysqli_query($conn, $sql) ;
                        $ln    = mysqli_fetch_assoc($query);
                        $nome  = $ln['nome'];
                        $preco = number_format($ln['valor'], 2, ',', '.');
                        $sub   = number_format($ln['valor'] * $qtd, 2, ',', '.');
						$preço = $ln['valor'];
                        $total += $ln['valor'] * $qtd;
                         echo '
							<tr>       
								<td>'.$nome.'</td>
								<td><input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'" /></td>
								<td>R$ '.$preco.'</td>
								<td>R$ '.$sub.'</td>
								<td><a href="?acao=del&id='.$id.'">Remove</a></td>
                            </tr>';
							
		  array_push($_SESSION['dados'],array('nome' => $nome,'quantidade' => $qtd,'preço' => $preço,'total' => $total));
									
                }
                $total = number_format($total, 2, ',', '.');
                echo '<tr>                         
							<td colspan="4">Total</td>
							<td>R$ '.$total.'</td>
                    </tr>';
					$_SESSION['total'] = $total;
					$_SESSION['quantidade'] = $qtd;
          
		  }   ?>
   
   
   
         </tbody>
    </form>
 </table>
</div>
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

  <?php }else{	
  session_destroy(); 	
  header('Location: aviso.php');
			}	?>