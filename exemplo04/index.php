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
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse; 
				width: 90%;
				/* border-spacing: 0px;*/
			}

			table, td, th {
				border: 1px solid #000;
			}
			.imagem {
				width: 120px;
			}
		</style>
	</head>
	<body>
		<div class="logo-container">
		<img src="imagens/logo.png" alt="Logo da EletroDominus">
		<h1 class="titulo">
			<span>Eletro</span><span class="cor1">Dominus</span>
		</h1>
		</div>
		<p>Praticidade e Tecnologia para o seu lar</p>
		<?php
			try {
				include("conexao.php");
			
				// ajustando a instrução select para ordenar por produto
				$sql = "select * from tabelaimg order by produto";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$produto = $_POST["produto"];
					$sql = "select * from tabelaimg 
					where produto like '%$produto%' order by produto";
				}
				$query = mysqli_query($conexao, $sql);
				/*
				if (!$query) {
					exit("<h4>Query Inválida: " . @mysqli_error($conexao) . "</h4>\n");  
				}
				*/
				echo "<h4>
						<a href=\"inclusao.php\">Incluir</a>&nbsp;&nbsp;
						<a href=\"index.php\">Atualizar</a>
					</h4>\n";
				echo "<div>
						<form action=\"#\" method=\"post\">
							<label for=\"prod\">Filtre por Produto:</label>
							<input type=\"text\" name=\"produto\" id=\"prod\"
							maxlength=\"30\">
							<input type=\"submit\" value=\"Pesquisar\">
						</form>
					</div>\n";
				echo "<table>\n";// note que abri echo com aspas para executar
				//comando html e os atributos das tags com apostrofe 
				echo "\t\t\t<tr>
					<th width=\"30px\">Id</th>
					<th width=\"100px\">Código</th>
					<th width=\"250px\">Produto</th>
					<th width=\"100px\">Valor</th>
					<th width=\"100px\">Produto</th>
					<th width=\"250px\">Opções</th>
				</tr>\n";

				while ($dados = mysqli_fetch_assoc($query)){
					echo "\t\t\t<tr>\n";
					echo "\t\t\t\t<td>". $dados['id']."</td>\n";
					echo "\t\t\t\t<td>". $dados["codigo"]."</td>\n";
					echo "\t\t\t\t<td>". $dados['produto']."</td>\n";
					echo "\t\t\t\t<td> R$ " . number_format($dados["valor"], 2, ",", ".") . "</td>\n";		
					// buscando a na pasta imagem
					if (empty($dados["imagem"])){
						$imagem = "semimagem.png";
					}else{
						$imagem = $dados["imagem"];
					}
					$id = $dados["id"];
					$id = base64_encode($id);
					echo "\t\t\t\t<td>
								<a href=\"verproduto.php?id=$id\">
									<img class=\"imagem\" src=\"imagens/$imagem\">
								</a>
							</td>\n";
					echo "\t\t\t\t<td>
								<a href=\"verproduto.php?id=$id\">
									Visualizar
								</a>&nbsp;&nbsp;
								<a href=\"edicao.php?id=$id\">
									Editar
								</a>&nbsp;&nbsp;
								<a href=\"excluir.php?id=$id\">
									Excluir
								</a>
							</td>\n";
					echo "\t\t\t</tr>\n";
				}
				echo "\t\t</table>\n";
			
				mysqli_close($conexao);
			} catch (Exception $e){
				echo "<h4>Ocorreu um erro: <br>" . $e->GetMessage() . "</h4>\n";
			}	
		?>
	</body>
</html>
