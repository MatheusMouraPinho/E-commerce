<?php
include ('../site/php/login.php');
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
    if(isset($_SESSION['efetu'])){  
        echo "<div class='alert alert-success alert-dismissible' align='center' role=alert>" .$_SESSION['efetu']. "</div>";
        unset($_SESSION['efetu']); // depois de imprimir o que queremos apagamos esta var da sessão
        }
    ?>
    
    <?php
        if(isset($_SESSION['logged_invalido'])) {
        echo "<div class='alert alert-warning alert-dismissible' align='center' role=alert>" .$_SESSION['logged_invalido']. "</div>";
        unset($_SESSION['logged_invalido']); // depois de imprimir o que queremos apagamos esta var da sessão
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
	
    <?php
	if($_SESSION == true){ // esta logado
	?>
	
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Minha conta</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br>
	
	 <?php 
	 $usuario = $_SESSION['UsuarioId'];
	
	$result = "SELECT * FROM compras WHERE usu_id='$usuario' ";
	$resultado = mysqli_query($conn, $result);
	
	 ?>
	<div class="container" align="center">
                <div class="col-md-12">
				
				<H2>Meus Pedidos</H2>
				
	<table id="example" class="table table-striped table-bordered" style="width:100%">
		<thead>
            <tr>
				<th>Data</th>
                <th>Produto</th>
				<th>Quantidade</th>
				
            </tr>
        </thead>
				
				<?php while($rows = mysqli_fetch_assoc($resultado)){ 
				$preço = number_format($rows['preço'], 2, ',', '.');
				?>
					
        <tbody>
            <tr>
				<td><?php echo $rows['Data'];?></td>
                <td><?php echo $rows['produto'];?></td>
				<td><?php echo $rows['quantidade'];?></td>
            </tr>
        </tbody>		
				<?php } ?>
    </table>
	<br>
					<H2>Favoritos</H2>
				</div>
            </div>
		<?php 
		
		$usuario = $_SESSION['UsuarioId'];
	$result = "SELECT * FROM favoritos WHERE usuario='$usuario'";
	$resultado = mysqli_query($conn, $result);
	?>
	 
			<div class="container theme-showcase" role="main">
			<div class="row">
				<?php
				while($rows = mysqli_fetch_assoc($resultado)){
				$id_prod = $rows['produto'];
	
			$sql = "SELECT * FROM produtos WHERE id='$id_prod'";
			$fav = mysqli_query($conn, $sql);
	 

				while($rows = mysqli_fetch_assoc($fav)){ 
				$preco = number_format($rows['valor'], 2, ',', '.');
				?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							  <div class="bottomremov"><a href="../site/php/fav.php?remov=<?php echo $rows['id']; ?>" title="Fav"><img src="img/removefav.jpg" width="40" height="40" alt="Fav"></a></div>
							  <img src= <?php echo'data:image/jpeg;base64,'.base64_encode( $rows['IMG'] )?> Height= "150" width="150" ;/> 
							<div class="caption text-center">
								<p><h3><?php echo $rows['nome']; ?></h3></p>
								<p><h4><?php echo "R$" . $preco ?></h4></p>
								<p><a href="../site/detalhes.php?id_pagina=<?php echo $rows['id']; ?>" class="btn btn-primary" role="button">Ver Detalhes</a> </p>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php } ?>
				
			</div>
		</div>
	 
	 <?php 
		}else { //se não esta logado
		?>
		
		<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Minha conta</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	<br></br>
	
	
	<div class="container">
        <div class="row">
            <div class="col-md-5"> 
				<H2>Login</H2><br/>
				<form action="../site/php/login.php" method="POST">
                    <label>Email</label><br/>
                    <input type="text" class="form-control" placeholder="adm@adm.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br/></br>
                
                    <label>Senha</label><br/>
                    <input type="password" class="form-control" placeholder="12345" name="senha" required><br/></br>
                    
                    <button name="login" type="submit" class="button is-block is-link is-large is-fullwidth">Login</button>
                </form>
               
            </div>
			 <div class="col-md-1"> 
                <div class="vl"></div>
				</div>
            <div class="col-md-6"> 
			<H2>cadastro</H2><br/>
                <form action="../site/php/cadastro.php" method="post">
                    <label>Nome</label><br/>
                    <input type="text" class="form-control" placeholder="Nome" name="nome" required> <br>
                    
                    <label>Email</label><br/>
                    <input type="mail" class="form-control" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required> <br>
                    
                    <label>Senha</label><br/>
                    <input type="password" class="form-control" placeholder="Senha" name="senha" required><br>
					
					<label>Cidade</label><br/>
					 <input type="text" class="form-control" placeholder="Cidade" name="cidade" required><br>
					
					<label>Endereço</label><br/>
					 <input type="text" class="form-control" placeholder="Endereço" name="endereço" required> <br>
					
					<label>Região</label>
					<select name="regiao" class="lista">
						<option>  </option><option>AC</option><option>AL</option><option>AP</option>
						<option>AM</option><option>BA</option><option>CE</option><option>DF</option>
						<option>ES</option><option>GO</option><option>MA</option><option>MT</option>
						<option>MS</option><option>MG</option><option>PA</option><option>PB</option>
						<option>PR</option><option>PE</option><option>PI</option><option>RJ</option>
						<option>RN</option><option>RS</option><option>RO</option><option>RR</option>
						<option>SC</option><option>SP</option><option>SE</option><option>TO</option>
					</select> 
					<br></br>
					<button name="enviar" type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
	
	
	<br></br>
		
		<?php
		} //fim
		?>
 
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