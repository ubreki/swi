<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro de Produto</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<style>
			form {
				max-width: 800px;
				margin: 20px auto;
				padding: 20px;
				background: #f9f9f9;
				border-radius: 8px;
				box-shadow: 0 0 10px rgba(0,0,0,0.1);
			}
			input, textarea {
				margin-bottom: 15px;
				padding: 8px;
				border: 1px solid #ddd;
				border-radius: 4px;
			}
			input[type="submit"], input[type="reset"] {
				padding: 10px 20px;
				background: #4CAF50;
				color: white;
				border: none;
				cursor: pointer;
			}
			input[type="reset"] {
				background: #f44336;
			}
		</style>
	</head>
	<body>
		<h3 style="text-align: center;">Cadastro de Produto</h3>
		<form name="produto" action="incluir.php" method="post" enctype="multipart/form-data">
			<b>Código:</b> <input type="number" name="codigo" required><br><br>  
			<b>Produto:</b> <input type="text" name="produto" maxlength="80" required style="width:550px"><br><br>
			<b>Descrição: </b><br><textarea name="descricao" rows="5" cols="100" style="resize: none;" required></textarea><br><br>
			<b>Data: </b> <input type="date" name="data" required><br><br>
			<b>Valor: R$ </b><input type="number" step="0.01" name="valor" required><br><br>
			<b>Foto: </b><input type="file" name="foto" id="fileToUpload" required><br><br>
			<input type="submit" name="submit" value="Cadastrar">&nbsp;&nbsp;
			<input type="reset" value="Limpar">
		</form>	
	</body>
</html>