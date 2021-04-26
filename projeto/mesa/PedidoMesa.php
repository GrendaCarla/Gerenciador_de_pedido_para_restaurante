<?php

require_once '../conexao.php';

class Pedido{
	private $IDPedido;
	private $IDMesa;
	private $ValorTotal;
	private $QntPessoa;
	private $EncerrarPedido;
	

	public $tamanhoArray = 0;
	

	public function TamanhoArray(){
		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ID_Pedido from Pedido");
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}


	public function CadastrarDados($idMesa){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"insert into Pedido (ID_Mesa, ValorTotal, QntPessoa, EncerrarPedido) ".
		"values(:m,:v,:q, :e)");
		$st->bindValue(":m",$idMesa);
		$st->bindValue(":v",0);
		$st->bindValue(":q",0);
		$st->bindValue(":e",0);
		return $st->execute();	

	}



	public function PegarDados($idMesa){



		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Pedido where ID_Mesa=:id ORDER BY ID_Pedido DESC LIMIT 1");
		$st->bindValue(":id",$idMesa);
		$st->execute();	

		$conteudo = $st->fetch();

		$this->setIDPedido($conteudo[0]);
		$this->setIDMesa($conteudo[1]);
		$this->setValorTotal($conteudo[2]);
		$this->setQntPessoa($conteudo[3]);
		$this->setEncerrarPedido($conteudo[4]);
		
		
	}

	public function AlterarDados(){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"update Pedido set EncerrarPedido=:m, QntPessoa=:n where ID_Pedido=:id");
		$st->bindValue(":m",$this->getEncerrarPedido());
		$st->bindValue(":n",$this->getQntPessoa());
		$st->bindValue(":id",$this->getIDPedido());

		return $st->execute();	

	}


	public function AlterarValorTotal($valorTotalTemp){

		$conectado = new conexao();
		$st=$conectado->conn->prepare(
		"update Pedido set ValorTotal=:n where ID_Pedido=:id");
		$st->bindValue(":id",$this->getIDPedido());
		$st->bindValue(":n",$valorTotalTemp);
		$st->execute();	
	}



	//----------------------------- SET ---------------------------------

	public function setIDPedido($idPedido) {

		$this->IDPedido = $idPedido;
	}

	public function setIDMesa($idMesa){

		$this->IDMesa = $idMesa;
	}

	public function setValorTotal($valorTotal) {

		$this->ValorTotal = $valorTotal;
	
	}

	public function setQntPessoa($qntPessoa){

		$this->QntPessoa = $qntPessoa;
	}

	public function setEncerrarPedido($encerrarPedido) {

		$this->EncerrarPedido = $encerrarPedido;
	}

	

	//----------------------------- GET ---------------------------------


	public function getIDPedido() {
		return $this->IDPedido;
	}

	public function getIDMesa() {
		return $this->IDMesa;
	}

	public function getValorTotal() {
		return $this->ValorTotal;
	}

	public function getQntPessoa() {
		return $this->QntPessoa;
	}

	public function getEncerrarPedido() {
		return $this->EncerrarPedido;
	}


}

