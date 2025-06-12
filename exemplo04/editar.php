<!DOCTYPE html>
<html>
	<head>
		<title> Semana 01 - Exemplo 08 </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Free Web tutorials">
		<meta name="keywords" content="HTML, CSS, JavaScript">
		<meta name="author" content="John Doe">
		<link rel="stylesheet" href="css/style.css">
		<style>
			
		</style>
	</head>
	<body>
		
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
					
				$buscaImg = "SELECT imagem FROM tabelaimg WHERE id = $id";
				$resImg = mysqli_query($conexao, $buscaImg);
				$dadosAntigos = mysqli_fetch_assoc($resImg);
				$fotoAntiga = $dadosAntigos['imagem'];
				
				$diretorio = "imagens/";
				$novoNome = $fotoAntiga;
			
				if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
				$extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

					
				if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
					
					$novoNome = uniqid() . "." . $extensao;
					
					if (!empty($fotoAntiga) && file_exists($diretorio . $fotoAntiga)) {
						unlink($diretorio . $fotoAntiga);
					}

					move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novoNome);
					} else {
						echo "Não pode esse arquivo seu verme";
						exit;
					}
				}

				
				$sqlupdate = "UPDATE tabelaimg SET codigo = $codigo, produto = '$produto', descricao = '$descricao', 
				data = '$data', valor = $valor, imagem = '$novoNome' WHERE id = $id";

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