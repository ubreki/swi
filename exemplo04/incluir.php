<!DOCTYPE html>
<html>
	<head>
		<title>Processando Cadastro</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<style>
			body {
				font-family: Arial, sans-serif;
				max-width: 800px;
				margin: 0 auto;
				padding: 20px;
			}
			h3, h4 {
				color: #333;
			}
			.success {
				color: green;
			}
			.error {
				color: red;
			}
			.button {
				display: inline-block;
				padding: 10px 20px;
				background: #4CAF50;
				color: white;
				text-decoration: none;
				border-radius: 4px;
				margin-top: 20px;
			}
		</style>
	</head>
	<body>
		<?php
			try {
				include("conexao.php");
				
				// Verifica se o formulário foi submetido
				if(!isset($_POST['submit'])) {
					throw new Exception("Formulário não submetido corretamente.");
				}
				
				// Validando campos obrigatórios
				$required = ['codigo', 'produto', 'descricao', 'data', 'valor'];
				foreach($required as $field) {
					if(empty($_POST[$field])) {
						throw new Exception("O campo $field é obrigatório.");
					}
				}
				
				// Recuperando dados
				$codigo = intval($_POST["codigo"]);
				$produto = mysqli_real_escape_string($conexao, $_POST['produto']);	
				$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);	
				$data = $_POST['data'];	
				$valor = floatval($_POST['valor']);
				
				// Processamento da imagem
				$imagem = 'semimagem.png'; // Valor padrão
				
				if(isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
					$target_dir = "imagens/";
					if(!is_dir($target_dir)) {
						mkdir($target_dir, 0755, true);
					}
					
					$arquivo = basename($_FILES["foto"]["name"]);
					$target_file = $target_dir . $arquivo;
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					
					// Verifica se é uma imagem real
					$check = getimagesize($_FILES["foto"]["tmp_name"]);
					if($check === false) {
						throw new Exception("O arquivo não é uma imagem válida.");
					}
					
					// Verifica se o arquivo já existe
					if(file_exists($target_file)) {
						$arquivo = time() . '_' . $arquivo; // Adiciona timestamp para evitar conflitos
						$target_file = $target_dir . $arquivo;
					}
					
					// Verifica tamanho do arquivo
					if($_FILES["foto"]["size"] > 500000) {
						throw new Exception("O arquivo é muito grande (máximo 500KB).");
					}
					
					// Verifica formato do arquivo
					$allowed = ['jpg', 'jpeg', 'png', 'gif'];
					if(!in_array($imageFileType, $allowed)) {
						throw new Exception("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.");
					}
					
					// Tenta mover o arquivo
					if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
						$imagem = $arquivo;
					} else {
						throw new Exception("Ocorreu um erro ao fazer upload da imagem.");
					}
				}
				
				// Inserção no banco de dados
				$sql = "INSERT INTO tabelaimg (codigo, produto, descricao, data, valor, imagem) 
						VALUES (?, ?, ?, ?, ?, ?)";
				
				$stmt = mysqli_prepare($conexao, $sql);
				mysqli_stmt_bind_param($stmt, "isssds", $codigo, $produto, $descricao, $data, $valor, $imagem);
				
				if(mysqli_stmt_execute($stmt)) {
					echo "<h3 class='success'>Produto cadastrado com sucesso!</h3>";
					echo "<h4>Detalhes do produto:</h4>";
					echo "<p><strong>Código:</strong> $codigo</p>";
					echo "<p><strong>Produto:</strong> $produto</p>";
					echo "<p><strong>Valor:</strong> R$ ".number_format($valor, 2, ',', '.')."</p>";
					if($imagem != 'semimagem.png') {
						echo "<p><strong>Imagem:</strong> $imagem</p>";
					}
				} else {
					throw new Exception("Erro ao cadastrar produto: " . mysqli_error($conexao));
				}
				
				mysqli_stmt_close($stmt);
				mysqli_close($conexao);
				
			} catch(Exception $e) {
				echo "<h3 class='error'>Erro no cadastro:</h3>";
				echo "<p>".$e->getMessage()."</p>";
			}
		?>
		<br>
		<a href="index.php" class="button">Voltar para a lista</a>
	</body>
</html>
