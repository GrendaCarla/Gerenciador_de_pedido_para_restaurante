<?php

require_once '../conexao.php';

class Mesa{
	private $IDMesa;
	private $Mac;
	private $Nome;


	public function Verificar($enderecoMAC){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Mesa where MAC =:id and DesativarMesa=0");
		$st->bindValue(":id",$enderecoMAC);
		$st->execute();	
		
		$conteudo = $st->fetchAll();

		if($conteudo == array()){
			// Não Cadastrado
			return 1;
		}
		else{
			// Não Cadastrado
			return 0;
		}

	}

	public function PegarDados($enderecoMAC){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Mesa where MAC =:id  and DesativarMesa=0");
		$st->bindValue(":id",$enderecoMAC);
		$st->execute();	
		

		$conteudo = $st->fetchAll();	


		$this->setIDMesa($conteudo[0][0]);
		$this->setMac($conteudo[0][1]);
		$this->setNome($conteudo[0][2]);
		

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