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
		<h3>Semana 01 - Exemplo 13 - Inclusão</h3>
		<form name="produto" action="incluir.php" method="post" enctype="multipart/form-data">
			<b>Código:</b> <input type="number" name="codigo" required><br><br>  
			<b>Produto:</b> <input type="text" name="produto" maxlength="80" style="width:550px"><br><br>
			<b>Descrição: </b><br><textarea name="descricao" rows="5" cols="100" style="resize: none;"></textarea><br><br>
			<b>Data: </b> <input type="date" name="data"><br><br>
			<b>Valor: R$ </b><input type="number" step="0.01" name="valor"><br><br>
			<b>Foto: </b><input type="file" name="foto" id="fileToUpload"><br><br>
			<input type="submit" value="Ok">&nbsp;&nbsp;
			<input type="reset" value="Limpar">
		</form>	
	</body>
</html>