<!DOCTYPE html>
<html>
	<head>
		<title> Semana 01 - Exemplo 15 </title>
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
		<h3>Semana 01 - Exemplo 13 - Exclusão</h3>
		<?php
			try {
				include("conexao.php");
				// recuperando 
				$id = base64_decode($_GET['id']);

				// criando a linha do  DELETE
				$sqldelete =  "delete from tabelaimg where id = $id";
				
				// executando instrução SQL
				$resultado = mysqli_query($conexao, $sqldelete);
				
				echo "<h4>Registro excluido com Sucesso!</h4>\n";
				
				mysqli_close($conexao);
			} catch (Exception $e) {
				echo "<h2>Aconteceu um erro:<br>" .
				$e->GetMessage() ."</h2>\n";
			}
			
		?>
		<br><br>
		<input type='button' onclick="window.location='index.php';" value="Voltar">
	</body>
</html>