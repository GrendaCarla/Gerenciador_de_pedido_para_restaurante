<?php
	include_once("EnderecoMacCliente.php");
	$mac = new MacCliente();
	$mac->PegarMac();

	include_once("MesaMesa.php");
	$mesa = new Mesa();

	if($mac->getEnderecoMac() == null){
		$mesa->PegarDados("Servidor");
	} else{
		if($mesa->Verificar($mac->getEnderecoMac()) == 0){
			$mesa->PegarDados($mac->getEnderecoMac());
		}
		else{
			header('Location: TelaDeErro.php');
		}
	}

	include_once("PedidoMesa.php");
	$pedido = new Pedido();
	$pedido->PegarDados($mesa->getIDMesa());

	
	$pedido->setEncerrarPedido(1);
	$pedido->AlterarDados();
	
?>

<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="refresh" content="20; URL=TelaDeBoasVindas.php">

	<head>
		<title>Encerramento da Conta</title>
		<link rel="stylesheet" type="text/css" href="ContaEncerrada.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


		<?php
		

		echo "<table width=\"100%\" align=\"center\" bgcolor=\"black\">
			<tr>
				<td align=\"left\" class=\"titulo\" width=\"37%\">Mesa: ".$mesa->getNome()."</td>
				<td align=\"left\" class=\"titulo\">Encerramento da Conta</td>
			</tr>
		</table>";

		?>

		</br></br></br></br></br>
		<p>Obrigado por comer aqui,</br>dirija-se ao caixa para efetuar o pagamento</p>
		</br>
		

	</body>


</html>