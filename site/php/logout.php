<?php
include('conexao.php');

session_start();
//deleta registro adm
	$id_del = $_GET['id_del'];
	$del = "DELETE FROM compras WHERE id ='$id_del'";
	mysqli_query($conn, $del);
	header("location:../admin.php");
   

//sai da conta
   if(isset($_POST['logout'])){
        session_destroy();
        header("location:../index.php");
    }
?>