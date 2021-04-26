
<?php

	include_once("ComidaMesa.php");
	$comida = new Comida();
	$comida->TamanhoArray();
	$comida->PegarDados();

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


	// ------------ criar pedido ---------------


	if(isset($_POST['botao'])){

		include_once("PedidoMesa.php");
		$pedido = new Pedido();
		$pedido->PegarDados($mesa->getIDMesa());

		if($pedido->getEncerrarPedido() == 1){
			
			$pedido->CadastrarDados($mesa->getIDMesa());
		}

		header("Refresh: 0");
	}


	include_once("PedidoMesa.php");
	$pedido = new Pedido();
	$pedido->PegarDados($mesa->getIDMesa());
	

	include_once("ItensDoPedidoMesa.php");
	$itensPedido = new ItensDoPedido();
	$itensPedido->TamanhoArray($pedido->getIDPedido());
	$itensPedido->PegarDados($pedido->getIDPedido());

	$Titulo = ["REFEIÇÃO", "LANCHE", "BEBIDA", "SOBREMESA"];
	$Categoria = ["Refeição", "Lanche", "Bebida", "Sobremesa"];
	$PrimeiroEnvio = 0;

	//------------------- cadastra os itens do pedido ----------------------

	
	for($b=1, $c=0; $b<5; $b++){
		
		for($i=0; $i< $comida->tamanhoArray; $i++){

			if($comida->getCategoria()[$i] == $Categoria[$b-1]  &&  isset($_POST['quantidade'.$b.'5'.$i.''])  &&  $_POST['quantidade'.$b.'5'.$i.''] != 0){

				$a =  $_POST['quantidade'.$b.'5'.$i.''];
				$c = 'quantidade'.$b.'5'.$i.'';

				$itensPedido->CadastrarDados($comida->getIDComida()[$i], $a);

			}
		}
	}


	if(isset($_POST[$c])){

		header("Refresh: 0");

	}

	//------------------- Alterar total ----------------------

	$valorTotalTemp = 0;

	for($i = 0; $i < $itensPedido->tamanhoArray; $i++){
		$valorTotalTemp = $valorTotalTemp + ($itensPedido->getPreco()[$i] * $itensPedido->getQuantidade()[$i]);
	}

	$pedido->AlterarValorTotal($valorTotalTemp);	

	$pedido->PegarDados($mesa->getIDMesa());


?>



<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Conta</title>
		<link rel="stylesheet" type="text/css" href="TelaDePedido.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



		<form action="EscolherPedido.php" method="POST">

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<?php
				echo "<td align=\"left\" class=\"titulo\" width=\"43%\">Mesa: ".$mesa->getNome()."</td>";
				?>
				<td align="left" class="titulo" width="10%">Conta</td>
				<td align="right" id="texPequeno">Quantas pessoas</br>tem na mesa?</td>
				
				<td width="6%" align="right"><input type="button" id="bntEsq" value="<" onclick="diminui()" class="bnt"></td>

				<?php
				echo "<td width=\"3%\" align=\"center\"><input type=\"text\" id=\"quantPessoa\" name=\"quantPessoa\" placeholder=\"".$pedido->getQntPessoa()."\" value=\"".$pedido->getQntPessoa()."\" size=\"1\"  disabled ></td>";
				?>

				<td width="3%" align="right"><input type="button" id="bntDir" value=">" onclick="aumenta()" class="bnt"></td>
				
			</tr>
		</table>



		</br>
		</br>
		</br>

		

		<table width="100%" align="center" id="table2" border="0" height="450px">
			<tr>
				<td width="1%"></td>
				<td align="left" width="70%" bgcolor="#c4c4c4"  valign="top">
					<table width="100%" align="center" bgcolor="#c4c4c4" id="table3">
						<tr bgcolor="#c4c4c4">
							<td colspan="4"></td>
						</tr>
						<?php

						for($i = 0; $i< $itensPedido->tamanhoArray; $i++){
							echo "<tr bgcolor=\"white\">
								<td>".$itensPedido->getNome()[$i]."</td>
								<td>".$itensPedido->getTamanho()[$i]."</td>
								<td align=\"center\" width=\"7%\">x".$itensPedido->getQuantidade()[$i]."</td>
								<td width=\"17%\">
								<table width=\"100%\"><tr><td align=\"left\">R$ </td><td align=\"right\">".str_replace('.00', '', number_format(($itensPedido->getPreco()[$i] * $itensPedido->getQuantidade()[$i]), 2, ',', ''))."</td></tr></table>
								</td>
							</tr>";
						}
						?>
					</table>
					
				</td>
				<td align="center"></br>O cardápio esta</br>aqui dentro</br></br><a href="EscolherPedido.php"><input type="submit" value="Fazer Pedido" class="bnt2" onclick="abilitarQuantidade()"></a>
				</br></br></br></br></br></br></br></br>Só feche a conta</br>quando for ir embora</br></br>
				<a href="#fecharConta"><input type="button" value="Fechar Conta" class="bnt2"></a>
				</td>
				<td width="1%"></td>
			</tr>
			<tr>
				<td width="1%"></td>
				<td align="left" width="70%" valign="button" bgcolor="black">
					<table width="100%" align="center" bgcolor="black" height="30px">
						<tr bgcolor="black" class="linhaPetra" style="font-size: 20px">
							<td colspan="2" width="77%"></td>
							<td align="left">Total &nbsp; R$   </td>
							<?php echo "<td align=\"right\" width=\"13%\">".str_replace('.00', '', number_format($pedido->getValorTotal(), 2, ',', ''))."</td>"; ?>
						</tr>
					</table>

					<td align="center">    </td>
				</td>
			</tr>

		</table>

		</form>







		<div id="fecharConta" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="3" bgcolor="black" align="center" class="tituloModel">Fechar Conta</td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="center">Você tem certeza que quer fechar a conta?</td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="ContaEncerrada.php"><input type="button" value="Sim" class="bnt2"></a></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Não" class="bnt2"></a></td>
				</tr>
			</table>
		</div>

	</body>

	<script script languagem="javascript">

		function diminui(){
			var  num = document.getElementById("quantPessoa").placeholder;
			if(!(num-1 < 0)){
				num --;
			}
			
			document.getElementById("quantPessoa").placeholder = "" + num;
			document.getElementById("quantPessoa").value = num;
			
		}


		function aumenta(){
			var  num = document.getElementById("quantPessoa").placeholder;
			num ++;
			document.getElementById("quantPessoa").placeholder = "" + num;
			document.getElementById("quantPessoa").value = num;
			
		}

		function abilitarQuantidade(){
			<?php
			echo "$(\"#quantPessoa\").removeAttr('disabled');";
			?>
		}



	</script>

</html>