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
	
	

?>


<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Tela de Boas Vindas</title>
		<link rel="stylesheet" type="text/css" href="TelaDeBoasVindas.css">

	</head>

	<body>
		
		
		 <table width="100%" align="center" bgcolor="black">
			<tr>
				<?php
				echo "<td align=\"left\" class=\"titulo\" width=\"43%\">Mesa: ".$mesa->getNome()."</td>"; ?>
				<td align="left" class="titulo">Boas Vindas</td>
			</tr>
		</table>
		</br>
		</br>
		</br>
		<p>Olá cliente,</br>Vamos começar?</p>
		</br>
		</br>

		<form action="TelaDePedido.php" method="POST">
		
		<p align="center"><a href="TelaDePedido.php"><input type="submit" name="botao" value="Começar" id="bnt" ></a></p>

		</form>


	</body>

	<script script languagem="javascript">


	</script>

</html>