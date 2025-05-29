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
				$id = base64_decode($_GET["id"]);

				// criando a linha do  SELECT
				$sqlconsulta =  "select * from tabelaimg where id = $id;";
				
				// executando instrução SQL
				$resultado = mysqli_query($conexao, $sqlconsulta);
				
				$num = mysqli_num_rows($resultado);
				if ($num == 0){
					echo "<b>Código: </b>não localizado !!!!<br><br>";
					echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
					exit;
				} else {
					$dados = mysqli_fetch_assoc($resultado);
				}		 
				mysqli_close($conexao);
			} catch (Exception $e) {
				echo "<h2>Aconteceu um erro:<br>" . $e->GetMessage() ."</h2>\n";
			}
		?>
		<form name="produto" action="alterar.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $dados["id"]; ?>">
			<b>Código:</b> <input type="number" name="codigo" value="<?php echo $dados["codigo"]; ?>"><br><br>
			<b>Produto:</b> <input type="text" name="produto" maxlength="80" style="width:550px" value="<?php echo $dados['produto']; ?>"><br><br>
			<b>Descrição: </b><br><textarea name="descricao" rows="3" cols="100" style="resize: none;" ><?php echo $dados['descricao']; ?></textarea><br><br>
			<b>Data: </b> <input type="date" name="data" value="<?php echo date_format( date_create($dados['data']),"Y-m-d"); ?>"><br><br>
			<b>Valor: R$ </b><input type="number" step="0.01" name="valor" value="<?php echo $dados['valor']; ?>"> <br><br>
			<input type="submit" value="Ok">&nbsp;&nbsp;
			<input type="reset" value="Limpar">
			<input type='button' onclick="window.location='index.php';" value="Voltar">
		</form>
	</body>
</html>
