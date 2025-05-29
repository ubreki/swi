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
		<h3>Semana 01 - Exemplo 13 - Inclusão</h3>
		<?php
			try {
				include("conexao.php");
				// recuperando 
				$codigo = $_POST['codigo'];
				$produto = $_POST['produto'];	
				$descricao = $_POST['descricao'];	
				$data = $_POST['data'];	
				$valor = $_POST['valor'];	

				// Uploud da foto
				$foto = "";
				$target_dir = "imagens/";
				$target_file = $target_dir . basename($_FILES["foto"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["foto"]["tmp_name"]);
					if($check !== false) {
						echo "Arquivo Correto. - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "Arquivo não é um imagem.";
						$uploadOk = 0;
					}
				}

				if (file_exists($target_file)) {
					echo "Arquivo ja existe.";
					$uploadOk = 0;
				}

				if ($_FILES["foto"]["size"] > 500000) {
					echo "Seu arquivo é muito Grande.";
					$uploadOk = 0;
				}

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
					echo "So é possivel enviar arquivos no modelo: JPG, JPEG, PNG & GIF.";
					$uploadOk = 0;
				}

				if ($uploadOk == 0) {
					echo "Perdão, o Upload não concluído.";
					} else {
					if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
						echo "Seu arquivo ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " foi enviado.";
					} else {
						echo "Ocorreu um erro, no upload do arquivo.";
					}
				}
				

				// criando a linha de INSERT
				$sqlinsert =  "insert into tabelaimg (codigo, produto, descricao, data, valor, foto) 
				values ($codigo,'$produto', '$descricao', '$data', $valor, '$foto')";
				
				// executando instrução SQL
				$resultado = mysqli_query($conexao, $sqlinsert);
				
				echo "<h4>Registro Cadastrado com Sucesso!</h4>\n";
				
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