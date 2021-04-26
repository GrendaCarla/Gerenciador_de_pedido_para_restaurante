<?php

require_once '../conexao.php';

class PedidoFeito{
	private $IDPedido = array();
	private $IDMesa = array();
	private $QntPessoa = array();


	public $tamanhoArray = 0;


	public function TamanhoArray(){
		$conectado= new conexao();
		$st=$conectado->conn->prepare("select DISTINCT Pedido.ID_Pedido
		from Pedido INNER JOIN ItensPedido ON Pedido.ID_Pedido = ItensPedido.ID_Pedido
		where ItensPedido.PedidoFeito = 1 and Pedido.EncerrarPedido = 0");
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}


	public function PegarDados(){

		$conectado= new conexao();
		$st=$conectado->conn->prepare("select DISTINCT Pedido.ID_Pedido, Pedido.ID_Mesa, Pedido.QntPessoa
		from Pedido INNER JOIN ItensPedido ON Pedido.ID_Pedido = ItensPedido.ID_Pedido
		where ItensPedido.PedidoFeito = 1 and Pedido.EncerrarPedido = 0");
		$st->execute();	

		$conteudo = $st->fetchAll();

		for($i=0; $i<$this->tamanhoArray; $i++){
			$this->setIDPedido($conteudo[$i][0]);
			$this->setIDMesa($conteudo[$i][1]);
			$this->setQntPessoa($conteudo[$i][2]);
		}


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

	public function setQntPessoa($qntPessoa){

		if(sizeof($this->getQntPessoa()) == 0){
			$this->QntPessoa = array($qntPessoa);
		} 
		else{
			array_push($this->QntPessoa, $qntPessoa);
		}
	}


	//----------------------------- GET ---------------------------------


	public function getIDPedido() {
		return $this->IDPedido;
	}

	public function getIDMesa() {
		return $this->IDMesa;
	}

	public function getQntPessoa() {
		return $this->QntPessoa;
	}

}

?>
