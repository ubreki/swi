<!DOCTYPE html>
<html>
	<head>
		<title>Exemplo PHP</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Free Web tutorials">
		<meta name="keywords" content="HTML, CSS, JavaScript">
		<meta name="author" content="SeuNome">
		<link rel="stylesheet" href="css/style.css">
		<style>
		</style>
	</head>
	<body>
		<h3>Semana 01 - Exemplo 14 - Exclusão</h3>
		<?php
			try {
				include("conexao.php");
				// recuperando 
				$id = base64_decode($_GET["id"]);

				// criando a linha do  DELETE
				$sqldelete = "delete from tabelaimg where id = $id";
				
				// executando instrução SQL
				$resultado = mysqli_query($conexao, $sqldelete);
				/*
				if (!$resultado) {
					die('Query Inválida: ' . @mysqli_error($conexao));  
				} else {
					echo "Registro Excluído com Sucesso";
				}
				*/
				echo "<h4>Registro Excluído com Sucesso!</h4>\n";
				mysqli_close($conexao);				
			} catch (Exception $e){
				echo "<h4>Ocorreu um erro: <br>" . $e->GetMessage() . "</h4>\n";
			}
			
		?>
		<br><br>
		<input type='button' onclick="window.location='index.php';" value="Voltar">
	</body>
</html>