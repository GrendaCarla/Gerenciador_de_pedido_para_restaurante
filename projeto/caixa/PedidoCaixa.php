<?php

require_once '../conexao.php';

class Pedido{
	private $IDPedido = array();
	private $IDMesa = array();
	private $ValorTotal = array();
	private $QntPessoa = array();
	private $EncerrarPedido = array();
	private $PedidoPago = array();

	public $tamanhoArray = 0;
	

	public function TamanhoArray(){
		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ID_Pedido from Pedido where EncerrarPedido=1  and PedidoPago=0");
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}


	public function PegarDados(){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Pedido where EncerrarPedido=1 and PedidoPago=0");
		$st->execute();	


		$conteudo = $st->fetchAll();

		for($i = 0; $i < $this->tamanhoArray; $i++){
			$this->setIDPedido($conteudo[$i][0]);
			$this->setIDMesa($conteudo[$i][1]);
			$this->setValorTotal($conteudo[$i][2]);
			$this->setQntPessoa($conteudo[$i][3]);
			$this->setEncerrarPedido($conteudo[$i][4]);
			$this->setPedidoPago($conteudo[$i][5]);
		}
	}

	
	public function FecharConta($idPedido){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"update Pedido set PedidoPago=1 where ID_Pedido=:id");
		$st->bindValue(":id",$idPedido);
		return $st->execute();	

	}



	//----------------------------- SET ---------------------------------

	public function setIDPedido($idPedido) {

		if(sizeof($this->getIDPedido()) == 0){
			$this->IDPedido = array($idPedido);
		} 
		else{
			array_push($this->IDPedido, $idPedido);
		}
	}

	public function setIDMesa($idMesa){

		if(sizeof($this->getIDMesa()) == 0){
			$this->IDMesa = array($idMesa);
		} 
		else{
			array_push($this->IDMesa, $idMesa);
		}
	}

	public function setValorTotal($valorTotal) {

		if(sizeof($this->getValorTotal()) == 0){
			$this->ValorTotal = array($valorTotal);
		} 
		else{
			array_push($this->ValorTotal, $valorTotal);
		}
	}

	public function setQntPessoa($qntPessoa){

		if(sizeof($this->getQntPessoa()) == 0){
			$this->QntPessoa = array($qntPessoa);
		} 
		else{
			array_push($this->QntPessoa, $qntPessoa);
		}
	}

	public function setEncerrarPedido($encerrarPedido) {

		if(sizeof($this->getEncerrarPedido()) == 0){
			$this->EncerrarPedido = array($encerrarPedido);
		} 
		else{
			array_push($this->EncerrarPedido, $encerrarPedido);
		}
	}

	public function setPedidoPago($pedidoPago) {

		if(sizeof($this->getPedidoPago()) == 0){
			$this->PedidoPago = array($pedidoPago);
		} 
		else{
			array_push($this->PedidoPago, $pedidoPago);
		}
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

	public function getPedidoPago() {
		return $this->PedidoPago;
	}

}

?>
