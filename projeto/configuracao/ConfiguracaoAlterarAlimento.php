<?php

	include_once("ConfiguracaoComida.php");
	$comida = new Comida();
	$comida->TamanhoArray();
	$comida->PegarDados();

	$numComida=0;

	if(isset($_POST['alterarAlimentoID']) && $_POST['alterarAlimentoID'] != ""){

		for($i=0; $i < $comida->tamanhoArray; $i++){
			if($comida->getIDComida()[$i] == $_POST['alterarAlimentoID']){
				$numComida = $i;
			}
		}

	}

?>


<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Alterar Alimento</title>
		<link rel="stylesheet" type="text/css" href="ConfiguracaoAlterarAlimento.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<td align="center" class="titulo" width="40%">Alterar Alimento</td>
			</tr>
		</table>
		</br>
		</br>

		<form action="ConfiguracaoCardapio.php" method="POST" autocomplete="off">

		<?php
		echo "<table width=\"60%\" align=\"center\" id=\"table2\" border=\"0\">
			<tr  height=\"50px\">
				<td>Nome<f>*</f></td>
				<td align=\"right\" width=\"80%\"><input type=\"text\" size=\"72%\" id=\"Nome\" name=\"Nome1\" value=\"".$comida->getNome()[$numComida]."\"></td>
			</tr>
		</table>
		<table width=\"60%\" align=\"center\" id=\"table2\" border=\"0\">
			<tr height=\"50px\">
				<td>Tamanho<f>*</f></td>
				<td align=\"right\" width=\"80%\"><input type=\"text\" size=\"67%\" id=\"Tamanho\" name=\"Tamanho1\" value=\"".$comida->getTamanho()[$numComida]."\"></td>
			</tr>
		</table>
		<table width=\"60%\" align=\"center\" id=\"table2\" border=\"0\">
			<tr  height=\"50px\">
				<td width=\"10%\">Preço<f>*</f></td>
				<td align=\"right\" width=\"80%\"><input type=\"number\" step=\"0.01\" min=\"0\" onkeydown=\"return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 107 && event.keyCode !== 187 && event.keyCode !== 190\" id=\"Preco\" name=\"Preco1\" value=\"".$comida->getPreco()[$numComida]."\"></td>
			</tr>
		</table>";
		?>
		<table width="60%" align="center" id="table2" border="0">
			<tr height="50px">
				<td>Categoria<f>*</f></td>
				<td align="right" width="86%"><select readonly id="Categoria" name="Categoria1"> 
					<option id="op1" value="1">Refeição</option>
					<option id="op2" value="2">Lanche</option>
					<option id="op3" value="3">Bebida</option>
					<option id="op4" value="4">Sobremesa</option></select>
				</td>
				
				
			</tr>
		</table>
		<table width="60%" align="center" id="table2" border="0">
			<tr height="50px">
				<td>Ativo?<f>*</f></td>
				<td align="right" width="86%"><select readonly id="Ativo" name="Ativo1"> 
					<option id="opAT1" value="0">Sim</option>
					<option id="opAT2" value="1">Não</option></select>
				</td>
				
			</tr>
		</table>
		<?php
		echo "<table width=\"60%\" align=\"center\" id=\"table2\" border=\"0\">
			<tr height=\"190px\">
				<td valign=\"top\">Ingredientes</td>
				<td align=\"right\" width=\"80%\"><textarea rows=\"7\" cols=\"60%\" name=\"Ingredientes1\">".$comida->getIngredientes()[$numComida]."</textarea></td>
			</tr>
		</table>";
		?>
		<table width="80%" align="center" id="table2" border="0">
			<tr>
				<td align="center"><a href="" id="alinkErro1"><input type="button" value="Salvar" class="bnt2" id="Salvar" onclick="erro1()"></a></td>
				<td align="center"><a href="ConfiguracaoCardapio.php"><input type="button" value="Cancelar" class="bnt2"></a></td>
			</tr>
		</table>




		<div  class="modal">
			<?php
			if(isset($_POST['alterarAlimentoID']) && $_POST['alterarAlimentoID'] != ""){
				echo "<input type=\"text\" value=\"".$_POST['alterarAlimentoID']."\" name=\"IDAlterarAlimento\">";
			}
			?>
		</div>


		</form>








	<div id="erro1" class="modal">
	  	<table width="35%" align="center" bgcolor="white" class="table3">
			<tr height="40px">
				<td bgcolor="black" align="center" class="tituloModel">Erro</td>
			</tr>
			<tr height="15px">
				<td></td>
			</tr>
			<tr height="40px">
				<td align="center">É obrigatório o preenchimento de todos os campos</br>(menos o ingredientes)</td>
			</tr>
			<tr height="25px">
				<td></td>
			</tr>
		</table>
		<table width="35%" align="center" bgcolor="white" class="table3">
			<tr height="70px">
				<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="OK" class="bnt2"></a></td>
			</tr>
		</table>
	</div>




	</body>

	<script script languagem="javascript">

		function erro1(){

			if(document.getElementById("Nome").value == "" || document.getElementById("Tamanho").value == "" || document.getElementById("Preco").value == ""){

				document.getElementById("alinkErro1").href = "#erro1";
				document.getElementById("Salvar").click();
			}
			else{

				document.getElementById("Salvar").type = "submit";
				document.getElementById("Salvar").click();
			}

		}


		$(document).ready(function(){
			<?php

				$resposta;

				switch ($comida->getCategoria()[$numComida]) {
				    case "Refeição":
				        $resposta = "op1";
				        break;
				    case "Lanche":
				        $resposta = "op2";
				        break;
				    case "Bebida":
				        $resposta = "op3";
				        break;
			        case "Sobremesa":
				        $resposta = "op4";
				        break;
				}
			

				echo  "$(\"#".$resposta."\").attr('selected','selected');";

				

				switch ($comida->getDesativarComida()[$numComida]) {
				    case "0":
				        $resposta = "opAT1";
				        break;
				    case "1":
				        $resposta = "opAT2";
				        break;
				}

				echo  "$(\"#".$resposta."\").attr('selected','selected');";
					

			?>
		});

		

	</script>

</html>