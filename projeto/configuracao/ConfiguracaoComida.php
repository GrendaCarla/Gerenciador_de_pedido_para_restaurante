<?php

require_once '../conexao.php';

class Comida{
	private $IDComida = array();
	private $Nome = array();
	private $Tamanho = array();
	private $Preco = array();
	private $Categoria = array();
	private $Ingredientes = array();
	private $DesativarComida = array();

	public $tamanhoArray = 0;
	

	public function TamanhoArray(){
		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ID_Comida from Comida");
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}

	public function CadastrarDados($Nome, $Tamanho, $Preco, $Categoria, $Ingredientes){
		$resposta;

		switch ($Categoria) {
		    case 1:
		        $resposta = "Refeição";
		        break;
		    case 2:
		        $resposta = "Lanche";
		        break;
		    case 3:
		        $resposta = "Bebida";
		        break;
	        case 4:
		        $resposta = "Sobremesa";
		        break;
		}


		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"insert into Comida (Nome, Tamanho, Preco, Categoria, Ingredientes, DesativarComida) ".
		"values(:n,:t,:p,:c,:i,0)");
		$st->bindValue(":n",$Nome);
		$st->bindValue(":t",$Tamanho);
		$st->bindValue(":p",$Preco);
		$st->bindValue(":c",$resposta);
		$st->bindValue(":i",$Ingredientes);
		return $st->execute();
	}


	public function PegarDados(){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Comida");
		$st->execute();	


		$conteudo = $st->fetchAll();

		for($i = 0; $i < $this->tamanhoArray; $i++){
			$this->setIDComida($conteudo[$i][0]);
			$this->setNome($conteudo[$i][1]);
			$this->setTamanho($conteudo[$i][2]);
			$this->setPreco($conteudo[$i][3]);
			$this->setCategoria($conteudo[$i][4]);
			$this->setIngredientes($conteudo[$i][5]);
			$this->setDesativarComida($conteudo[$i][6]);
		}
			
	}


	public function AlterarDados($Nome, $Tamanho, $Preco, $Categoria, $Ingredientes, $Id, $Ativo){

		$resposta;

		switch ($Categoria) {
		    case 1:
		        $resposta = "Refeição";
		        break;
		    case 2:
		        $resposta = "Lanche";
		        break;
		    case 3:
		        $resposta = "Bebida";
		        break;
	        case 4:
		        $resposta = "Sobremesa";
		        break;
		}


		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"update Comida set Nome=:n, Tamanho=:t, Preco=:p, Categoria=:c, Ingredientes=:i, DesativarComida=:d where ID_Comida=:id");
		$st->bindValue(":n",$Nome);
		$st->bindValue(":t",$Tamanho);
		$st->bindValue(":p",$Preco);
		$st->bindValue(":c",$resposta);
		$st->bindValue(":i",$Ingredientes);
		$st->bindValue(":d",$Ativo);
		$st->bindValue(":id",$Id);
		return $st->execute();

	}


	//----------------------------- SET ---------------------------------

	public function setIDComida($idComida) {
		
		if(sizeof($this->getIDComida()) == 0){
			$this->IDComida = array($idComida);
		} 
		else{
			array_push($this->IDComida, $idComida);
		}
	}

	public function setNome($nome){

		if(sizeof($this->getNome()) == 0){
			$this->Nome = array($nome);
		} 
		else{
			array_push($this->Nome, $nome);
		}
	}

	public function setTamanho($tamanho) {

		if(sizeof($this->getTamanho()) == 0){
			$this->Tamanho = array($tamanho);
		} 
		else{
			array_push($this->Tamanho, $tamanho);
		}
	}

	public function setPreco($preco) {

		if(sizeof($this->getPreco()) == 0){
			$this->Preco = array($preco);
		} 
		else{
			array_push($this->Preco, $preco);
		}
	}

	public function setCategoria($categoria) {

		if(sizeof($this->getCategoria()) == 0){
			$this->Categoria = array($categoria);
		} 
		else{
			array_push($this->Categoria, $categoria);
		}
	}

	public function setIngredientes($ingredientes) {

		if(sizeof($this->getIngredientes()) == 0){
			$this->Ingredientes = array($ingredientes);
		} 
		else{
			array_push($this->Ingredientes, $ingredientes);
		}
	}

	public function setDesativarComida($desativarComida) {

		if(sizeof($this->getIngredientes()) == 0){
			$this->DesativarComida = array($desativarComida);
		} 
		else{
			array_push($this->DesativarComida, $desativarComida);
		}
	}

	//----------------------------- GET ---------------------------------


	public function getIDComida() {
		return $this->IDComida;
	}

	public function getNome() {
		return $this->Nome;
	}

	public function getTamanho() {
		return $this->Tamanho;
	}

	public function getPreco() {
		return $this->Preco;
	}

	public function getCategoria() {
		return $this->Categoria;
	}

	public function getIngredientes() {
		return $this->Ingredientes;
	}
	
	public function getDesativarComida() {
		return $this->DesativarComida;
	}
}


?>
