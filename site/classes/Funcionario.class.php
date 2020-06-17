<?php

include_once "Conexao.class.php";
include_once "Funcoes.class.php";

//atributos

class Funcionario {
    
    private $con;
    private $objfc;
    private $idFuncionario;
    private $nome;
	private $Salario;
    private $email;
    private $senha;
    private $dataCadastro;

	//contrutor
    public function __construct(){
        $this->con = new Conexao();
        $this->objfc = new Funcoes();
    }
    
	//metodos get e set
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    
	//metodos
    public function querySeleciona($dado){
        try{
            $this->idFuncionario = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT idFuncionario, nome, salario, email, data_cadastro FROM `funcionario` WHERE `idFuncionario` = :idFunc;");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function querySelect(){
        try{
            $cst = $this->con->conectar()->prepare("SELECT `idFuncionario`, `nome`, `salario`, `email`, `data_cadastro` FROM `funcionario`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }
    
    public function queryInsert($dados){
        try{
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
            $this->salario = $dados['salario'];
			$this->email = $dados['email'];
            $this->senha = sha1($dados['senha']);
            $this->dataCadastro = $this->objfc->dataAtual(1);
            $cst = $this->con->conectar()->prepare("INSERT INTO `funcionario` (`nome`, `salario`, `email`, `senha`, `data_cadastro`) VALUES (:nome, :salario, :email, :senha, :dt);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
			$cst->bindParam(":salario", $this->salario, PDO::PARAM_INT);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $cst->bindParam(":dt", $this->dataCadastro, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function queryUpdate($dados){
        try{
            $this->idFuncionario = $this->objfc->base64($dados['func'], 2);
            $this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
			$this->salario = $dados['salario'];
            $this->email = $dados['email'];
			
            $cst = $this->con->conectar()->prepare("UPDATE `funcionario` SET  `nome` = :nome, `salario` = :salario, `email` = :email WHERE `idFuncionario` = :idFunc;");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
			$cst->bindParam(":salario", $this->salario, PDO::PARAM_INT);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function queryDelete($dado){
        try{
            $this->idFuncionario = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `funcionario` WHERE `idFuncionario` = :idFunc;");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }
    
}

?>
