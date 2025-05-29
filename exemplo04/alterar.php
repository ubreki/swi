<!DOCTYPE html>
<html>
	<head>
		<title> Semana 01 - Exemplo 08 </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Free Web tutorials">
		<meta name="keywords" content="HTML, CSS, JavaScript">
		<meta name="author" content="John Doe">
		<link rel="stylesheet" href="mystyle.css">
		<style>
			
		</style>
	</head>
	<body>
		<h3>Semana 01 - Exemplo 19 - Alterar</h3>
		<?php
			try {
				include("conexao.php");
				// recuperando 
				$id = $_POST["id"];
				$codigo = $_POST['codigo'];
				$produto = $_POST['produto'];	
				$descricao = $_POST['descricao'];	
				$data = $_POST['data'];	
				$valor = $_POST['valor'];	

				// criando a linha do  UPDATE
				$sqlupdate =  "update tabelaimg set codigo=$codigo,
				produto='$produto', descricao='$descricao', data='$data',
				valor=$valor where id=$id;";

				// executando instrução SQL
				$resultado = mysqli_query($conexao, $sqlupdate);
				
				echo "<h4>Produto alterado com Sucesso!</h4>\n";
				 
				mysqli_close($conexao);
			} catch (Exception $e) {
				echo "<h2>Aconteceu um erro:<br>" . $e->GetMessage() ."</h2>\n";
			}
		?>
		<br><br>
		<input type='button' onclick="window.location='index.php';" value="Voltar">
	</body>
</html>
