<?php

require_once '../conexao.php';

class Mesa{
	private $IDMesa = array();
	private $Mac = array();
	private $Nome = array();
	private $DesativarMesa = array();

	public $tamanhoArray = 0;
	

	public function TamanhoArray(){
		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select ID_Mesa from Mesa");
		$st->execute();	

		$this->tamanhoArray = count($st->fetchAll());
	}
	

	public function CadastrarDados($mac, $nome){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"insert into Mesa (MAC, NomeMesa, DesativarMesa) ".
		"values(:i,:t,0)");
		$st->bindValue(":i",$mac);
		$st->bindValue(":t",$nome);
		return $st->execute();

	}


	public function PegarDados(){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"select * from Mesa");
		$st->execute();	


		$conteudo = $st->fetchAll();

		for($i = 0; $i < $this->tamanhoArray; $i++){
			$this->setIDMesa($conteudo[$i][0]);
			$this->setMac($conteudo[$i][1]);
			$this->setNome($conteudo[$i][2]);
			$this->setDesativarMesa($conteudo[$i][3]);
		}

	}


	public function AlterarDados($mac, $nome, $ativo){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"update Mesa set NomeMesa=:n, DesativarMesa=:a  where MAC=:id");
		$st->bindValue(":id", $mac);
		$st->bindValue(":n", $nome);
		$st->bindValue(":a", $ativo);
		return $st->execute();	

	}


	public function ExcluirDados($mac){

		$conectado= new conexao();
		$st=$conectado->conn->prepare(
		"delete from Mesa where MAC=:id");
		$st->bindValue(":id", $mac);
		return $st->execute();

	}


	//----------------------------- SET ---------------------------------

	public function setIDMesa($idMesa) {

		if(sizeof($this->getIDMesa()) == 0){
			$this->IDMesa = array($idMesa);
		} 
		else{
			array_push($this->IDMesa, $idMesa);
		}
	}

	public function setMac($mac){

		if(sizeof($this->getMac()) == 0){
			$this->Mac = array($mac);
		} 
		else{
			array_push($this->Mac, $mac);
		}
	}

	public function setNome($nome) {

		if(sizeof($this->getNome()) == 0){
			$this->Nome = array($nome);
		} 
		else{
			array_push($this->Nome, $nome);
		}
	}

	public function setDesativarMesa($desativarMesa) {

		if(sizeof($this->getDesativarMesa()) == 0){
			$this->DesativarMesa = array($desativarMesa);
		} 
		else{
			array_push($this->DesativarMesa, $desativarMesa);
		}
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

	public function getDesativarMesa() {
		return $this->DesativarMesa;
	}

}

?>