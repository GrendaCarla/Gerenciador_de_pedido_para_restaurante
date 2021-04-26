<?php

	include_once("ConfiguracaoComida.php");
	$comida = new Comida();
	$comida->TamanhoArray();
	$comida->PegarDados();

	if(isset($_POST['Nome']) && $_POST['Nome'] != ""){

		$comida->CadastrarDados($_POST['Nome'], $_POST['Tamanho'], $_POST['Preco'], $_POST['Categoria'], $_POST['Ingredientes']);

		header("Refresh: 0");

	}


	if(isset($_POST['Nome1']) && $_POST['Nome1'] != "" && isset($_POST['IDAlterarAlimento']) && $_POST['IDAlterarAlimento'] != ""){

		$comida->AlterarDados($_POST['Nome1'], $_POST['Tamanho1'], $_POST['Preco1'], $_POST['Categoria1'], $_POST['Ingredientes1'], $_POST['IDAlterarAlimento'],  $_POST['Ativo1']);

		header("Refresh: 0");

	}


?>

<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Configuração do Cardápio</title>
		<link rel="stylesheet" type="text/css" href="ConfiguracaoCardapio.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<td align="center" class="titulo">Cardápio</td>
			</tr>
		</table>
		</br>
		<table width="100%" height="430px" align="center" id="table2" border="0">
			<tr>
				<td width="2%"></td>
				<td align="left" width="70%" bgcolor="#c4c4c4"  valign="top">
					<table width="99%" align="center" bgcolor="#c4c4c4">
						<tr bgcolor="#c4c4c4">
							<td colspan="5"></td>
						</tr>
						<tr bgcolor="black" class="linhaPetra">
							<td width="5%">ID</td>
							<td>Nome</td>
							<td width="19%">Tamanho</td>
							<td width="13%">Categoria</td>
							<td width="12%">Preço</td>
							<td width="5%">Ativo?</td>
							<td width="11%">Ingredientes</td>
						</tr>
						<?php
						for($i = 0; $i<$comida->tamanhoArray; $i++){
							echo "<tr bgcolor=\"white\">
								<td align=\"center\">".$comida->getIDComida()[$i]."</td>
								<td>".$comida->getNome()[$i]."</td>
								<td>".$comida->getTamanho()[$i]."</td>
								<td>".$comida->getCategoria()[$i]."</td>
								<td align=\"right\">
									<table width=\"100%\"><tr><td align=\"left\">R$ </td><td align=\"right\">".str_replace('.00', '', number_format($comida->getPreco()[$i], 2, ',', ''))."</td></tr></table>
								</td>
								<td align=\"center\">".($comida->getDesativarComida()[$i] == 0 ? "Sim" : "Não")."</td>
								<td>     <a href=\"#ingredientes".$i."\"><input type=\"button\" value=\"Ingredientes\" class=\"bnt3\"></a>    </td>
							</tr>";
						}
						?>
					</table>
				</td>
				<td width="2%"></td>
			</tr>
		</table>
		</br></br>
		<table width="100%" align="center">
			<tr>
				<td align="center"><a href="ConfiguracaoNovoAlimento.php"><input type="button" value="Novo" class="bnt2"></a></td>
				<td align="center"><a href="#alterarAlimento"><input type="button" value="Alterar" class="bnt2"></a></td>
				<td align="center"><a href="ConfiguracaoTelaInicial.php"><input type="button" value="Voltar" class="bnt2"></a></td>
			</tr>
		</table>




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





		<form action="" method="POST" autocomplete="off" id="Formulario">

		<div id="alterarAlimento" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="4" bgcolor="black" align="center" class="tituloModel">Alterar Alimento</td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="left" width="6%">ID</td>
					<td align="right"><input type="text" size="45%" id="alterarAlimentoID" name="alterarAlimentoID" value=""></td>
					<td width="8%"></td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="" id="alinkErro1"><input type="button" value="OK" class="bnt2" onclick="erro1()" id="alterarAlimentoBotao"></a></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Cancelar" class="bnt2" onclick="limparInput1()"></a></td>
				</tr>
			</table>
		</div>

		








		<div id="erro1" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td bgcolor="black" align="center" class="tituloModel">Erro</td>
				</tr>
				<tr height="15px">
					<td></td>
				</tr>
				<tr height="40px">
					<td align="center">ID não existe</td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="OK" class="bnt2" onclick="limparInput1()"></a></td>
				</tr>
			</table>
		</div>

		</form>






	</body>

	<script script languagem="javascript">

		function erro1(){

			<?php
			for($i = 0; $i<$comida->tamanhoArray; $i++){

				echo "var b = \"".$comida->getIDComida()[$i]."\";";

				echo "if(document.getElementById(\"alterarAlimentoID\").value == b){

					document.getElementById(\"Formulario\").action=\"ConfiguracaoAlterarAlimento.php\";
					document.getElementById(\"alterarAlimentoBotao\").type = \"submit\";
					document.getElementById(\"alterarAlimentoBotao\").click();
					return;
				}";
			}

			if($i == $comida->tamanhoArray){
				echo "document.getElementById(\"alinkErro1\").href = \"#erro1\";";
				echo "document.getElementById(\"alterarAlimentoBotao\").onclick = \"\";";
				echo "document.getElementById(\"alterarAlimentoBotao\").click();";
			}
			?>
		}

		function limparInput1(){

			document.getElementById("alterarAlimentoID").value = "";
		}

	</script>

</html>