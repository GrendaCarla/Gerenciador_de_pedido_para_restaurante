<?php

require_once '../conexao.php';

class ItensDoPedido{
	private $IDItensPedido = array();
	private $IDComida = array();
	private $IDPedido;
	private $Quantidade = array();
	private $PedidoFeito = array();

	public $tamanhoArray = 0;

	private $Nome = array();
	private $Tamanho = array();
	private $Preco = array();


	public function TamanhoArray($idPedido){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ID_ItensPedido from ItensPedido where ID_Pedido =:id");
		$st->bindValue(":id",$idPedido);
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}


	public function CadastrarDados($idComida, $quantidade){

		$conectado = new conexao();
		$st=$conectado->conn->prepare(
		"insert into ItensPedido (ID_Comida, ID_Pedido, Quantidade, PedidoFeito) ".
		"values(:n,:i,:t,:p)");
		$st->bindValue(":n",$idComida);
		$st->bindValue(":i",$this->getIDPedido());
		$st->bindValue(":t",$quantidade);
		$st->bindValue(":p",0);
		$st->execute();	
	}


	public function PegarDados($idPedido){


		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ItensPedido.ID_Comida, ItensPedido.ID_ItensPedido, ItensPedido.ID_Pedido,
		Comida.Nome, Comida.Tamanho, Comida.Preco, ItensPedido.Quantidade, ItensPedido.PedidoFeito
		from Comida INNER JOIN ItensPedido ON Comida.ID_Comida = ItensPedido.ID_Comida
		where ItensPedido.ID_Pedido =:id;");
		$st->bindValue(":id",$idPedido);
		$st->execute();	
		

		$conteudo = $st->fetchAll();

		for($i = 0; $i < $this->tamanhoArray; $i++){
			$this->setIDItensPedido($conteudo[$i][0]);
			$this->setIDComida($conteudo[$i][1]);
			$this->setNome($conteudo[$i][3]);
			$this->setTamanho($conteudo[$i][4]);
			$this->setPreco($conteudo[$i][5]);
			$this->setQuantidade($conteudo[$i][6]);
			$this->setPedidoFeito($conteudo[$i][7]);
		}

		$this->setIDPedido($idPedido);

	}


	//----------------------------- SET ---------------------------------

	public function setIDItensPedido($idItensPedido){

		if(sizeof($this->getIDItensPedido()) == 0){
			$this->IDItensPedido = array($idItensPedido);
		} 
		else{
			array_push($this->IDItensPedido, $idItensPedido);
		}
	}

	public function setIDComida($idComida) {

		if(sizeof($this->getIDComida()) == 0){
			$this->IDComida = array($idComida);
		} 
		else{
			array_push($this->IDComida, $idComida);
		}
		
	}

	public function setIDPedido($idPedido){
		$this->IDPedido = $idPedido;
	}

	public function setQuantidade($quantidade) {

		if(sizeof($this->getQuantidade()) == 0){
			$this->Quantidade = array($quantidade);
		} 
		else{
			array_push($this->Quantidade, $quantidade);
		}
		
	}

	public function setPedidoFeito($pedidoFeito) {

		if(sizeof($this->getPedidoFeito()) == 0){
			$this->PedidoFeito = array($pedidoFeito);
		} 
		else{
			array_push($this->PedidoFeito, $pedidoFeito);
		}
	}

	//------------------------------------------



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


	//----------------------------- GET ---------------------------------

	public function getIDItensPedido() {
		return $this->IDItensPedido;
	}

	public function getIDComida() {
		return $this->IDComida;
	}

	public function getIDPedido() {
		return $this->IDPedido;
	}

	public function getQuantidade() {
		return $this->Quantidade;
	}

	public function getPedidoFeito() {
		return $this->PedidoFeito;
	}

	//------------------------------------------



	public function getNome() {
		return $this->Nome;
	}

	public function getTamanho() {
		return $this->Tamanho;
	}

	public function getPreco() {
		return $this->Preco;
	}

}

?>
