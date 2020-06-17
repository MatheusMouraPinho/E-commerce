<?php

//atributos
class Conexao{
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private static $pdo;
    
	//contrutor
    public function __construct(){
        $this->servidor = "sql105.epizy.com";
        $this->banco = "epiz_26020624_site";
        $this->usuario = "epiz_26020624";
        $this->senha = "G09Jo3JwLrfOeC";
    }
    
    public function conectar(){
        try{
            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
            }
            return self::$pdo;
        } catch (PDOException $ex) {
			echo $ex->getMessage();
        }
    }
    
}

?>