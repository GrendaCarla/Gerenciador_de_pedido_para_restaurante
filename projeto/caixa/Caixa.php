<?php
	include_once("ComidaCaixa.php");
	$comida = new Comida();
	$comida->TamanhoArray();
	$comida->PegarDados();

	include_once("MesaCaixa.php");
	$mesa = new Mesa();

	include_once("PedidoCaixa.php");
	$pedido = new Pedido();
	$pedido->TamanhoArray();
	$pedido->PegarDados();

	include_once("ItensDoPedidoCaixa.php");
	$itensPedido = new ItensDoPedido();


	for($i = 0; $i<$pedido->tamanhoArray; $i++){
		if(isset($_POST['check'.$i.''])  && $_POST['check'.$i.''] == "ativo"){
			print_r($i);

			$pedido->FecharConta($pedido->getIDPedido()[$i]);

			header("Refresh: 0");
		}
	}

?>


<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="refresh" content="120" /><!--segundo-->

	<head>
		<title>Caixa</title>
		<link rel="stylesheet" type="text/css" href="Caixa.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<td align="center" class="titulo">Contas Encerradas</td>
			</tr>
		</table>
		</br>
		</br>
		<form action="Caixa.php" method="POST">

		<table width="100%" align="left" border="0">
			<tr height="500px">
				<td width="1%"></td>
				<td align="left" width="75%" bgcolor="#c4c4c4"  valign="top">
					<?php
					for($i = 0; $i<$pedido->tamanhoArray; $i++){
						$mesa->PegarDados($pedido->getIDMesa()[$i]);
						echo "<table width=\"100%\" align=\"center\" bgcolor=\"#c4c4c4\"  style=\"padding-top: 8px\">
							<tr bgcolor=\"black\" class=\"linhaPetra\" >
								
								<td colspan=\"3\" align=\"center\" width=\"80%\">Mesa: ".$mesa->getNome()."</td>
								<td align=\"center\"  width=\"4%\">  <a href=\"#fecharConta\"><input type=\"checkbox\" id=\"check".$i."\" onclick='window.location.assign(\"#fecharConta\")' value=\"inativo\" name=\"check".$i."\"></a>  </td>
							</tr>
							</table>";

							echo "<table width=\"100%\" align=\"center\" bgcolor=\"#c4c4c4\">";

								$itensPedido->TamanhoArray($pedido->getIDPedido()[$i]);

								$itensPedido->PegarDados($pedido->getIDPedido()[$i]);

								for($a = 0; $a< $itensPedido->tamanhoArray; $a++){
									
									echo "<tr bgcolor=\"white\" class=\"linhaTabela\">
									<td width=\"60%\">".$itensPedido->getNome()[$a]."</td>
									<td>".$itensPedido->getTamanho()[$a]."</td>
									<td width=\"5%\" align=\"center\">x".$itensPedido->getQuantidade()[$a]."</td>
									<td width=\"13%\">
										<table width=\"100%\"><tr><td align=\"left\">R$ </td><td align=\"right\">".str_replace('.00', '', number_format(($itensPedido->getPreco()[$a] * $itensPedido->getQuantidade()[$a]), 2, ',', ''))."</td></tr></table>
									</td></tr>";
								}

							echo "<tr bgcolor=\"black\" class=\"linhaTabela\" >
									<td colspan=\"4\">
										<table width=\"100%\" align=\"center\" id=\"table1\">
										<tr>
											<td align=\"right\" width=\"91%\">Total: R$ </td>
											<td align=\"right\">".str_replace('.00', '', number_format($pedido->getValorTotal()[$i], 2, ',', ''))."</td>
										</tr>
										</table>
									</td>
								</tr> ";

							$itensPedido->ReiniciarArray();
							
						echo "</table>";
					
					}
					?>
				</td>
				<td width="1%"></td>
			</tr>

		</table>





		<div id="fecharConta" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="3" bgcolor="black" align="center" class="tituloModel"></td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="center">Você tem certeza que a conta foi paga?</td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="Caixa.php" title="Fechar" class="fechar"><input type="submit" value="Sim" class="bnt2"></a></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Não" class="bnt2" onclick="deselecionar()"></a></td>
				</tr>
			</table>
		</div>





	</body>

	<script script languagem="javascript">

		function deselecionar(){

			var i = 0;
			for(i; i<10; i++){
				if(document.getElementById("check" + i).checked == true){
					document.getElementById("check" + i).checked = false;
				}
			}
		}

		$(document).ready(function(){
			<?php
			
			for($i = 0; $i<$pedido->tamanhoArray; $i++){

				echo  "$(\"#check".$i."\").click(function(){
					if($(\"#check".$i."\").val(\"inativo\")){
				    	$(\"#check".$i."\").val(\"ativo\");
					}
				});";
					
			}

			?>
		});


	</script>

</html>