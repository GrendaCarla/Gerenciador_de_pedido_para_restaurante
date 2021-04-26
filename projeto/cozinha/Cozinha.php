<?php
	include_once("PedidoCozinhaPedido.php");
	$pedido = new Pedido();
	$pedido->TamanhoArray();
	$pedido->PegarDados();


	include_once("ItensDoPedidoCozinha.php");
	$itensPedido = new ItensDoPedido();


	for($i = 0; $i<$pedido->tamanhoArray; $i++){
		if(isset($_POST['check'.$i.''])  && $_POST['check'.$i.''] == "ativo"){

			$itensPedido->AlterarDados($pedido->getIDPedido()[$i], 1);

			header("Refresh: 0");
		}
	}


	include_once("PedidoCozinhaFeito.php");
	$pedidoFeito = new PedidoFeito();
	$pedidoFeito->TamanhoArray();
	$pedidoFeito->PegarDados();
	

	if(isset($_POST['ValorFeito'])  && $_POST['ValorFeito'] != " "){
		$itensPedido->AlterarDados($_POST['ValorFeito'], 0);

		header("Refresh: 0");
	}

	

	include_once("MesaCozinha.php");
	$mesa = new Mesa();
	
?>


<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <meta http-equiv="refresh" content="120" /><!--segundo-->

	<head>
		<title>Cozinha</title>
		<link rel="stylesheet" type="text/css" href="Cozinha.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<table width="100%" align="center" bgcolor="black">
			<tr>
				<td align="center" class="titulo" width="73%">Pedidos</td>
				<td align="center" class="titulo" width="1px">|</td>
				<td align="center" class="titulo">Feitos</td>
			</tr>
		</table>
		

		<p align="center" id="texPequeno">Recarregue a página para ver os novos pedidos</p>
		


		<form action="Cozinha.php" method="POST">

		<table width="100%" align="left" id="table2" border="0">
			<tr height="490px">
				<td width="1%"></td>
				<td align="left" width="71%" bgcolor="#c4c4c4"  valign="top">
					<?php
					for($i = 0; $i<$pedido->tamanhoArray; $i++){
						$mesa->PegarDados($pedido->getIDMesa()[$i]);
						echo "<table width=\"100%\" align=\"center\" bgcolor=\"black\" style=\"padding-top: 3px\" >
							<tr bgcolor=\"black\" class=\"linhaPetra\">
								<td align=\"left\" width=\"13%\">Clientes: ".$pedido->getQntPessoa()[$i]."</td>
								<td align=\"center\" width=\"80%\">Mesa: ".$mesa->getNome()."</td>
								<td align=\"center\"  width=\"4%\">  <a href=\"#check\"><input type=\"checkbox\" id=\"check".$i."\" onclick='window.location.assign(\"#check\")' value=\"inativo\" name=\"check".$i."\"></a>  </td>
							</tr>
							</table>";

							echo "<table width=\"100%\" align=\"center\" bgcolor=\"#c4c4c4\" style=\"padding-top: 3px\" >";

								$itensPedido->TamanhoArray($pedido->getIDPedido()[$i]);
								$itensPedido->PegarDados($pedido->getIDPedido()[$i]);

								for($a = 0; $a< $itensPedido->tamanhoArray; $a++){
									echo "<tr bgcolor=\"white\">
									<td width=\"60%\">".$itensPedido->getNome()[$a]."</td>
									<td>".$itensPedido->getTamanho()[$a]."</td>
									<td width=\"7%\" align=\"center\">x".$itensPedido->getQuantidade()[$a]."</td>
									</tr>";
								}

								$itensPedido->ReiniciarArray();
							
						echo "</table>";
					
					}
					?>
				</td>
				<td width="4%"></td>
				<td align="left" bgcolor="#c4c4c4"  valign="top">
					<?php
					for($i = 0; $i<$pedidoFeito->tamanhoArray; $i++){

						$mesa->PegarDados($pedidoFeito->getIDMesa()[$i]);
				
						echo "<table width=\"100%\" align=\"center\" bgcolor=\"#c4c4c4\">
							<tr bgcolor=\"white\" height=\"50px\">
								<td width=\"2%\" bgcolor=\"#c4c4c4\"></td>
								<td align=\"left\" width=\"90%\">Mesa ".$mesa->getNome()."</td>
								<td align=\"center\">   <a href=\"#checkFeito\"><input type=\"checkbox\" checked=\"true\" id=\"checkFeito".$i."\" onclick='window.location.assign(\"#checkFeito\")'></a>   </td>
								<td width=\"2%\" bgcolor=\"#c4c4c4\"></td>
							</tr>
						</table>";
						
					}
					?>
				</td>
				<td width="1%"></td>
			</tr>

		</table>






		<div id="check" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="3" bgcolor="black" align="center" class="tituloModel"></td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="center">Você tem certeza que terminou o pedido?</td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><input type="button" value="Sim" class="bnt2" id="bntFeito" onclick="Feito()"></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Não" class="bnt2" onclick="deselecionar()"></a></td>
				</tr>
			</table>
		</div>

		





		<div id="checkFeito" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="3" bgcolor="black" align="center" class="tituloModel"></td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="center">Você tem certeza?</td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><input type="button" id="bntCheckFeito" name="bntCheckFeito" value="Sim" class="bnt2" onclick="devolver()"></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Não" class="bnt2" onclick="selecionar()"></a></td>
				</tr>
			</table>
		</div>


		<div class="modal">
			<input type="text" name="ValorFeito" id="ValorFeito">
		</div>

		</form>




	</body>

	<script script languagem="javascript">

		function deselecionar(){

			<?php

			for($i = 0; $i<$pedido->tamanhoArray; $i++){
				if("document.getElementById(\"check".$i."\").checked == true"){
					echo "document.getElementById(\"check".$i."\").checked = false;";
				}
			}

			?>
		}



		function selecionar(){

			<?php

			for($i = 0; $i<$pedidoFeito->tamanhoArray; $i++){
				
				if("document.getElementById(\"checkFeito".$i."\").checked == false"){
					echo "document.getElementById(\"checkFeito".$i."\").checked = true;";
				}
			}

			?>
		}


		function devolver(){
			
			<?php
			for($i = 0; $i<$pedidoFeito->tamanhoArray; $i++){

				echo "if(document.getElementById(\"checkFeito".$i."\").checked == false){

					document.getElementById(\"ValorFeito\").value = ".$pedidoFeito->getIDPedido()[$i].";

					document.getElementById(\"bntCheckFeito\").type = \"submit\";
					document.getElementById(\"bntCheckFeito\").onclick = \"\";
					document.getElementById(\"bntCheckFeito\").click();
					return;
				}";

			}
			
			?>

		}

		function Feito(){
			
			<?php
					
				echo "document.getElementById(\"bntFeito\").type = \"submit\";
				document.getElementById(\"bntFeito\").click();
				return;";
				
			?>
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