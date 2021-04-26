<?php
	include_once("ConfiguracaoMesa.php");
	$mesa = new Mesa();
	$mesa->TamanhoArray();
	$mesa->PegarDados();

	if(isset($_POST['ConteudoMACNova']) && isset($_POST['ConteudoNomeNova']) && $_POST['ConteudoMACNova'] != "" && $_POST['ConteudoNomeNova'] != ""){
		$mesa->CadastrarDados($_POST['ConteudoMACNova'], $_POST['ConteudoNomeNova']);

		header("Refresh: 0");
	}
	

	if(isset($_POST['ConteudoMACRenomear']) && isset($_POST['ConteudoNomeRenomear'])){

		$mesa->AlterarDados($_POST['ConteudoMACRenomear'], $_POST['ConteudoNomeRenomear'],$_POST['Ativo']);

		header("Refresh: 0");
	}

?>

<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Configuração das Mesas</title>
		<link rel="stylesheet" type="text/css" href="ConfiguracaoMesas.css">

	</head>

	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<td align="center" class="titulo" width="40%">Configuração das Mesas</td>
			</tr>
		</table>
		</br>
		<h3 align="center">Atribua um nome para o MAC da mesa. Ex MAC: 54-7a-6f-5b-0e-2f</h3>
		</br>
		<table width="100%" height="450px" align="center" id="table2" border="0">
			<tr>
				<td width="2%"></td>
				<td align="left" width="75%" bgcolor="#c4c4c4"  valign="top">
					<table width="100%" align="center" bgcolor="#c4c4c4">
						<tr bgcolor="#c4c4c4">
							<td colspan="4"></td>
						</tr>
						<tr bgcolor="black" class="linhaPetra">
							<td width="40%">MAC</td>
							<td width="50%">Nome da Mesa</td>
							<td width="10%">Ativo?</td>
						</tr>
						<?php
						for($i = 0; $i<$mesa->tamanhoArray; $i++){
							echo "<tr bgcolor=\"white\">
								<td>".$mesa->getMac()[$i]."</td>
								<td>".$mesa->getNome()[$i]."</td>
								<td align=\"center\">".($mesa->getDesativarMesa()[$i] == 0? "Sim" : "Não")."</td>
							</tr>";
						}
						?>
					</table>
				</td>

				<td align="center"><a href="#novaMesa"><input type="button" value="Novo" class="bnt2"></a></br></br></br></br></br></br>

				<a href="#alterarMesa"><input type="button" value="Alterar" class="bnt2"></a></br></br></br></br></br></br>

				<a href="ConfiguracaoTelaInicial.php"><input type="button" value="Voltar" class="bnt2"></a>

				</td>
				<td width="2%"></td>
			</tr>

		</table>









		<form action="ConfiguracaoMesas.php" method="POST" autocomplete="off">

		<div id="novaMesa" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="4" bgcolor="black" align="center" class="tituloModel">Nova Mesa</td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="8%"></td>
					<td align="left" width="6%">MAC</td>
					<td align="right"><input type="text" size="43%" id="ConteudoMACNova" name="ConteudoMACNova" autocomplete="off"></td>
					<td width="8%"></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td width="8%"></td>
					<td align="left" width="13%">Nome</td>
					<td align="right"><input type="text" size="40%" id="ConteudoNomeNova" name="ConteudoNomeNova" autocomplete="off"></td>
					<td width="8%"></td>
				</tr>
				<tr height="20px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="" id="alinkErro1"><input type="button" value="Salvar" class="bnt2" onclick="erro1()" id="SalvarNovoMAC"></a></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Cancelar" class="bnt2"></a></td>
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
					<td align="center">Endereço Mac já esta cadastrado</td>
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











		<div id="erro1.2" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td bgcolor="black" align="center" class="tituloModel">Erro</td>
				</tr>
				<tr height="15px">
					<td></td>
				</tr>
				<tr height="40px">
					<td align="center">Preencha todos os campos</td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="#novaMesa" title="Fechar" class="fechar"><input type="button" value="OK" class="bnt2" onclick="limparInput1()"></a></td>
				</tr>
			</table>
		</div>













	

		<div id="alterarMesa" class="modal">
		  	<table width="37%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td colspan="4" bgcolor="black" align="center" class="tituloModel">Alterar Mesa</td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
				<tr height="40px">
					<td width="5%"></td>
					<td align="left" width="30%">Endereço MAC</td>
					<td align="right"><input type="text" size="30%" id="ConteudoMACRenomear" name="ConteudoMACRenomear" autocomplete="off"></td>
					<td width="5%"></td>
				</tr>
			</table>
			<table width="37%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td width="5%"></td>
					<td align="left" width="11%">Nome</td>
					<td align="right"><input type="text" size="38%" id="ConteudoNomeRenomear" name="ConteudoNomeRenomear" autocomplete="off"></td>
					<td width="5%"></td>
				</tr>
			</table>
			<table width="37%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td width="5%"></td>
					<td align="left" width="6%">Ativo?</td>
					<td align="right" width="84%"><select readonly name="Ativo">
						<option value="0">Sim</option>
						<option value="1">Não</option>
						</select>
					</td>
					<td width="10%"></td>
				</tr>
				<tr height="10px">
					<td></td>
				</tr>
			</table>
			<table width="37%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="" id="alinkErro2"><input type="button" value="Salvar" class="bnt2" onclick="erro2()" id="SalvarRenomearMAC"></a></td>
					<td align="center" width="50%"><a href="#fechar" title="Fechar" class="fechar"><input type="button" value="Cancelar" class="bnt2"></a></td>
				</tr>
			</table>
		</div>

		







		<div id="erro2" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td bgcolor="black" align="center" class="tituloModel">Erro</td>
				</tr>
				<tr height="15px">
					<td></td>
				</tr>
				<tr height="40px">
					<td align="center">Endereço MAC não encontrado</td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="" title="Fechar" class="fechar"><input type="button" value="OK" class="bnt2" onclick="limparInput2()"></a></td>
				</tr>
			</table>
		</div>










		<div id="erro3" class="modal">
		  	<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="40px">
					<td bgcolor="black" align="center" class="tituloModel">Erro</td>
				</tr>
				<tr height="15px">
					<td></td>
				</tr>
				<tr height="40px">
					<td align="center">Nome já utilizado</td>
				</tr>
				<tr height="25px">
					<td></td>
				</tr>
			</table>
			<table width="35%" align="center" bgcolor="white" class="table3">
				<tr height="70px">
					<td align="center" width="50%"><a href="" title="Fechar" class="fechar"><input type="button" value="OK" class="bnt2" onclick="limparInput2()"></a></td>
				</tr>
			</table>
		</div>

		</form>





	</body>

	<script script languagem="javascript">

		

		function erro1(){

			<?php
			for($i = 0; $i<$mesa->tamanhoArray; $i++){

				echo "var b = \"".$mesa->getMac()[$i]."\";";

				echo "if(document.getElementById(\"ConteudoMACNova\").value == b){
					
					document.getElementById(\"alinkErro1\").href = \"#erro1\";
					document.getElementById(\"SalvarNovoMAC\").onclick = \"\";
					document.getElementById(\"SalvarNovoMAC\").click();
					return;
					
				}";
			}

			echo "if(document.getElementById(\"ConteudoMACNova\").value == \"\" || document.getElementById(\"ConteudoNomeNova\").value == \"\"){
				document.getElementById(\"alinkErro1\").href = \"#erro1.2\";
				document.getElementById(\"SalvarNovoMAC\").onclick = \"\";
				document.getElementById(\"SalvarNovoMAC\").click();
				return;

			}else{
				document.getElementById(\"SalvarNovoMAC\").type = \"submit\";
				document.getElementById(\"SalvarNovoMAC\").click();

			}";
			
			?>

		}

		function limparInput1(){

			document.getElementById("ConteudoMACNova").value = "";
			document.getElementById("ConteudoNomeNova").value = "";
			document.getElementById("alinkErro1").href = "";

			var erro = document.getElementById("SalvarNovoMAC");
			erro.addEventListener("click", erro1, false);
			
		}

		function erro2(){


			<?php
			for($i = 0; $i<$mesa->tamanhoArray; $i++){

				echo "var a = \"".$mesa->getNome()[$i]."\";";

				echo "var b = \"".$mesa->getMac()[$i]."\";";


				echo "if(document.getElementById(\"ConteudoNomeRenomear\").value == a){

					document.getElementById(\"alinkErro2\").href = \"#erro3\";
					document.getElementById(\"SalvarRenomearMAC\").onclick = \"\";
					document.getElementById(\"SalvarRenomearMAC\").click();
					return;

				}";


				echo "if(document.getElementById(\"ConteudoMACRenomear\").value == b){

					document.getElementById(\"SalvarRenomearMAC\").type = \"submit\";
					document.getElementById(\"SalvarRenomearMAC\").click();
					return;
					
				}";
				
			}

			
			if($i == $mesa->tamanhoArray){
			
				echo "document.getElementById(\"alinkErro2\").href = \"#erro2\";
				document.getElementById(\"SalvarRenomearMAC\").onclick = \"\";
				document.getElementById(\"SalvarRenomearMAC\").click();";
			}
			
			?>
		}

		function limparInput2(){

			document.getElementById("ConteudoMACRenomear").value = "";
			document.getElementById("ConteudoNomeRenomear").value = "";
			document.getElementById("alinkErro2").href = "";

			var erro = document.getElementById("SalvarRenomearMAC");
			erro.addEventListener("click", erro2, false);
		}


	</script>

</html>