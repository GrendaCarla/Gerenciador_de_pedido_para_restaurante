<!DOCTYPE html>

<html>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<head>
		<title>Novo Alimento</title>
		<link rel="stylesheet" type="text/css" href="ConfiguracaoNovoAlimento.css">

	</head>

	<body>


		<form action="ConfiguracaoCardapio.php" method="POST" autocomplete="off">

		<table width="100%" align="center" bgcolor="black" id="table1">
			<tr>
				<td align="center" class="titulo" width="40%">Novo Alimento</td>
			</tr>
		</table>
		</br>
		</br>
		<table width="60%" align="center" class="table2" border="0">
			<tr  height="50px">
				<td>Nome<f>*</f></td>
				<td align="right" width="80%"><input type="text" size="72%" id="Nome" value="" name="Nome"></td>
			</tr>
		</table>
		<table width="60%" align="center" class="table2" border="0">
			<tr height="50px">
				<td>Tamanho<f>*</f></td>
				<td align="right" width="80%"><input type="text" size="67%" id="Tamanho" name="Tamanho"></td>
			</tr>
		</table>
		<table width="60%" align="center" class="table2" border="0">
			<tr  height="50px">
				<td width="10%">Preço<f>*</f></td>
				<td align="right" width="80%"><input type="number" step="0.01" id="Preco" name="Preco" min="0" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189 && event.keyCode !== 107 && event.keyCode !== 187 && event.keyCode !== 190" ></td>
			</tr>
		</table>
		<table width="60%" align="center" class="table2" border="0">
			<tr height="50px">
				<td>Categoria<f>*</f></td>
				<td align="right" width="86%"><select readonly  name="Categoria">
					<option value="1">Refeição</option>
					<option value="2">Lanche</option>
					<option value="3">Bebida</option>
					<option value="4">Sobremesa</option></select>
				</td>
				
				
			</tr>
		</table>
		<table width="60%" align="center" class="table2" border="0">
			<tr height="210px">
				<td valign="top">Ingredientes</td>
				<td align="right" width="80%"><textarea rows="8" cols="60%" name="Ingredientes"></textarea></td>
			</tr>
		</table>
		</br>
		<table width="80%" align="center" class="table2" border="0">
			<tr>
				<td align="center"><a href="" id="alinkErro1"><input type="button" value="Salvar" class="bnt2" id="Salvar" onclick="erro1()"></a></td>
				<td align="center"><a href="ConfiguracaoCardapio.php"><input type="button" value="Cancelar" class="bnt2"></a></td>
			</tr>
		</table>

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

	</script>

</html>