<?php

class MacCliente{
	private $EnderecoMac;


	public function PegarMac(){

		$ipAddress=$_SERVER['REMOTE_ADDR'];
		$macAddr=false;

		$arp=`arp -a $ipAddress`;
		$lines=explode("\n", $arp);

		foreach($lines as $line)
		{
		   $cols=preg_split('/\s+/', trim($line));
		   if ($cols[0]==$ipAddress)
		   {
		       $macAddr=$cols[1];
		   }
		}

		$this->setEnderecoMac($macAddr);

	}


	//----------------------------- SET ---------------------------------

	public function setEnderecoMac($enderecoMac) {
		$this->EnderecoMac = $enderecoMac;
	}

	//----------------------------- GET ---------------------------------


	public function getEnderecoMac() {
		return $this->EnderecoMac;
	}

}

?>
