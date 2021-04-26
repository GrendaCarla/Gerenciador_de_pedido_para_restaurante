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


	include_once("ItensDoPedidoMesa.php");
	$itensPedido = new ItensDoPedido();
	$itensPedido->setIDPedido($pedido->getIDPedido());


	include_once("ComidaMesa.php");
	$comida = new Comida();
	$comida->TamanhoArray();
	$comida->PegarDados();

	$Titulo = ["REFEIÇÃO", "LANCHE", "BEBIDA", "SOBREMESA"];
	$Categoria = ["Refeição", "Lanche", "Bebida", "Sobremesa"];
	$PrimeiroEnvio = 0;


	if(isset($_POST['quantPessoa'])){

		$a =  $_POST['quantPessoa'];

		$pedido->setQntPessoa($a);
		$pedido->AlterarDados();

		header("Refresh: 0");
	}

?>

<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Escolha do Pedido</title>
		<link rel="stylesheet" type="text/css" href="EscolherPedido.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


		<?php
		echo "<table width=\"100%\" align=\"center\" bgcolor=\"black\">
			<tr>
				<td align=\"left\" class=\"titulo\" width=\"45%\">Mesa: ".$mesa->getNome()."</td>
				<td align=\"left\" class=\"titulo\">Cardápio</td>
			</tr>
		</table>";
		?>

		</br></br>
		<p align="center">Clique na comida e coloque a quantidade desejada</p>
		<br>


		<form action="TelaDePedido.php" method="POST">


		<?php
		for($b=0; $b<4; $b++){
			echo "<table width=\"90%\" align=\"center\" border=\"1\">
				<tr>
					<td align=\"center\" colspan=\"5\" class=\"linhaPetra\" bgcolor=\"black\">".$Titulo[$b]."</td>
				</tr>";
				
				for($i = 0; $i< $comida->tamanhoArray; $i++){
					if($comida->getCategoria()[$i] == $Categoria[$b]){
						echo "<tr class=\"linhaTabela\">
							<td  id= \"linha".($b + 1)."1".$i."\" class=\"inativo\" width=\"39%\">".$comida->getNome()[$i]."</td>
							<td  id= \"linha".($b + 1)."2".$i."\" class=\"inativo\" width=\"23%\">".$comida->getTamanho()[$i]."</td>
							<td  id= \"linha".($b + 1)."3".$i."\" class=\"inativo\" width=\"15%\">

							<table width=\"100%\"><tr><td align=\"left\">R$ </td><td align=\"right\">".str_replace('.00', '', number_format($comida->getPreco()[$i], 2, ',', ''))."</td></tr></table>

							<td  id= \"linha".($b + 1)."5".$i."\" class=\"inativo\" align=\"center\" width=\"15%\"><input type=\"button\" value=\"<\" onclick=\"diminui(".($b + 1)."5".$i.")\" style=\"float: left;\"><input type=\"text\" id=\"cont".($b + 1)."5".$i."\" name=\"quantidade".($b + 1)."5".$i."\" class=\"quantidade\" placeholder=\"0\" value=\"0\" size=\"1\"  disabled \><input type=\"button\" value=\">\" onclick=\"aumenta(".($b + 1)."5".$i.")\" style=\"float: right;\"></td>
							<td  id= \"linha".($b + 1)."4".$i."\" class=\"inativo\" align=\"center\">     <a href=\"#ingredientes".$i."\"><input type=\"button\" value=\"Ingredientes\" class=\"bnt2\"></a>    </td>
						</tr>";
					}
				}
			echo "</table>
			<br> <br></br><br> <br></br>";
		}
		?>

		


		<table width="90%" align="center">
			<tr>
				<td align="center"><a href="#fazerPedido"><input type="button" value="Fazer Pedido" class="bnt4" onclick="abilitarQuantidade()"></a></td>
				<td align="center"><a href="TelaDePedido.php"><input type="button" value="Cancelar" class="bnt4"></a></td>
			</tr>
		</table>
		<br><br id="IDAtivo" class="ativo">
		




		<?php
		for($a = 0; $a<count($comida->getIngredientes()); $a++){
			echo "<div id=\"ingredientes".$a."\" class=\"modal\">

				
			  	<table width=\"35%\" align=\"center\" bgcolor=\"white\" class=\"table3\">
					<tr height=\"40px\">
						<td colspan=\"3\" bgcolor=\"black\" align=\"center\" class=\"tituloModel\">INGREDIENTES</td>
					</tr>
					<tr height=\"6px\">
						<td></td>
					</tr>
					<tr height=\"120px\" width=\"100%\" valign=\"super\">
						<td width=\"4%\"></td>
						<td align=\"left\">".$comida->getIngredientes()[$a]."</td>
						<td width=\"4%\"></td>
					</tr>
					<tr height=\"6px\">
						<td></td>
					</tr>
					<tr height=\"50px\">
						<td align=\"center\" width=\"50%\" colspan=\"3\"><a href=\"#fechar\" title=\"Fechar\" class=\"fechar\"><input type=\"button\" value=\"OK\" class=\"bnt3\"></a></td>
					</tr>
				</table>
			</div>";
		}
		?>







		<div id="fazerPedido" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="3" bgcolor="black" align="center" class="tituloModel">Fazer Pedido</td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="center">Você tem certeza? Não será posivel cancelar o pedido</td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><input type="submit" value="Sim" class="bnt3"  id="bntFazerPedido"></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Não" class="bnt3" onclick="desabilitarQuantidade()"></a></td>
				</tr>
			</table>
		</div>

	</form>


	</body>

	<script script languagem="javascript">
		
		function diminui(idQnt){

			if(document.getElementById("linha" + idQnt).className == "ativo"){
				var  num = document.getElementById("cont" + idQnt).placeholder;
				if(!(num-1 < 0)){
					num --;
				}
				
				document.getElementById("cont" + idQnt).placeholder = "" + num;
				document.getElementById("cont" + idQnt).value = num;
			}
		}


		function aumenta(idQnt){

			if(document.getElementById("linha" + idQnt).className == "ativo"){
				var  num = document.getElementById("cont" + idQnt).placeholder;
				num ++;
				document.getElementById("cont" + idQnt).placeholder = "" + num;
				document.getElementById("cont" + idQnt).value = num;
			}
		}



		function abilitarQuantidade(){
			<?php
			echo "$(\".quantidade\").removeAttr('disabled');";
			?>
		}

		function desabilitarQuantidade(){
			<?php
			echo "$(\".quantidade\").attr('disabled','disabled');";
			?>
		}


		$(document).ready(function(){
			<?php
			
			for($b = 1; $b<5; $b++){
				for($i = 0; $i<$comida->tamanhoArray; $i++){
					for($a = 1; $a<4; $a++){

						echo  "$(\"#linha".$b.$a.$i."\").click(function(){
							if($(\"#linha".$b.$a.$i."\").hasClass(\"inativo\")){
						    	$(\"#linha".$b."1".$i.", #linha".$b."2".$i.", #linha".$b."3".$i.", #linha".$b."4".$i.", #linha".$b."5".$i."\").removeClass( \"inativo\" ).addClass(\"ativo\");
							} else if($(\"#linha".$b.$a.$i."\").hasClass(\"ativo\")){
							 	$(\"#linha".$b."1".$i.", #linha".$b."2".$i.", #linha".$b."3".$i.", #linha".$b."4".$i.", #linha".$b."5".$i."\").removeClass( \"ativo\" ).addClass(\"inativo\");
							 	$(\"#cont".$b."5".$i."\").attr(\"placeholder\", \"0\");
							 	$(\"#cont".$b."5".$i."\").val(\"0\");
							}
						  });";
					}
				}
			}

		
			?>
		});
		
	</script>

</html>