<?php
$host = "sql105.epizy.com";
$usuario = "epiz_26020624";
$senha = "G09Jo3JwLrfOeC";
$banco = "epiz_26020624_site";

$conn = mysqli_connect($host, $usuario, $senha, $banco);
mysqli_set_charset($conn, 'utf8');

error_reporting(0);
ini_set('display_errors', 0);


?>


<style>
.bottomleft {
  position: relative;
  bottom:285px;
  left: 240px;
}

.bottomremov {
  position: relative;
  top:10px;
  left: 130px;
}

.vl {
  border-left: 5px solid blue;
  height: 580px;
  position: absolute;
  left: 50%;
  margin-left: -3px;
  top: 0;
}

.slide{
	width: 1000px ;
	height: 333px;
  margin: auto;
}
</style>

<style type="text/css">
#borda {
    width: 580px;
    text-align: center;
}
</style>

