<?php

class Mesa{
	private $IDMesa;
	private $Mac;
	private $Nome;



	public function PegarDados($idMesa){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Mesa where ID_Mesa =:id");
		$st->bindValue(":id",$idMesa);
		$st->execute();	
		

		$conteudo = $st->fetchAll();	

		$this->setIDMesa($conteudo[0][0]);
		$this->setMac($conteudo[0][1]);
		$this->setNome($conteudo[0][2]);

	}


	public function AlterarDados(){

	}


	//----------------------------- SET ---------------------------------

	
	public function setIDMesa($idMesa) {

		$this->IDMesa = $idMesa;
	
	}

	public function setMac($mac){

		$this->Mac = $mac;
		
	}

	public function setNome($nome) {

		$this->Nome = $nome;

	}

	//----------------------------- GET ---------------------------------


	public function getIDMesa() {
		return $this->IDMesa;
	}

	public function getMac() {
		return $this->Mac;
	}

	public function getNome() {
		return $this->Nome;
	}

}


?>