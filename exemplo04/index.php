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
			table, th, td {
				border: 1px solid #000000;
			}
			.imagem {
				width: 100px;
			}
		</style>
	</head>
	<body>
		<h3>Semana 01 - Exemplo 08 - Listagem Geral de Produtos - Imagem</h3>
		<?php
			try {
				include("conexao.php");
			
				// ajustando a instrução select para ordenar por produto
				$sql = "select * from tabelaimg order by produto";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$produto = $_POST["produto"];
					$sql = "select * from tabelaimg where 
					produto like '%$produto%' order by produto";
				}
				$query = mysqli_query($conexao, $sql);
				
				echo "<header>
						<p><a href=\"inclusao.php\">Cadastrar</a>&nbsp;&nbsp;
						<a href=\"index.php\">Atualizar</a></p>\n
						<form action=\"#\" method = \"post\">
							<input type=\"text\" name=\"produto\" maxlength=\"80\">
							<button type=\"submit\">Pesquisar</button>
						</form>
					</header>\n";
				echo "<table>\n";// note que abri echo com aspas para executar
				//comando html e os atributos das tags com apostrofo 
				echo "<tr>\n
						<th width=\"30px\" align=\"center\">Id</th>\n
						<th width=\"100px\">Código</th>\n
						<th width=\"250px\">Produto</th>\n
						<th width=\"100px\">Valor</th>\n
						<th width=\"100px\">Produto</th>\n
						<th width=\"150px\">Opções</th>\n
					</tr>\n";

				while($dados = mysqli_fetch_assoc($query)){
					echo "<tr>\n";
					echo "<td align='center'>". $dados["id"]."</td>\n";
					echo "<td>{$dados["codigo"]}</td>\n";
					echo "<td>". $dados['produto']."</td>\n";
					echo "<td align='right'> R$ ". 
						number_format($dados['valor'],2,",",".")."</td>\n";		
					// buscando na pasta imagem
					if (empty($dados["imagem"])){
						$imagem = "semimagem.jpg";
					}else{
						$imagem = $dados["imagem"];
					}
					$id = base64_encode($dados["id"]);
					echo "<td>
							<a href=\"verproduto.php?id=$id\">
								<img class=\"imagem\" src=\"imagens/$imagem\">
							</a>
						</td>\n";
					echo "<td>
							<a href=\"verproduto.php?id=$id\">
								Visualizar
							</a>&nbsp;&nbsp;
							<a href=\"alteracao.php?id=$id\">
								Alterar
							</a>&nbsp;&nbsp;
							<a href=\"excluir.php?id=$id\">
								Apagar
							</a>
						</td>\n";
					echo "</tr>\n";
				}
				echo "</table>";
				
				mysqli_close($conexao);
			} catch (Exception $e) {
				echo "<h2>Aconteceu um erro:<br>" . $e->GetMessage() ."</h2>\n";
			}
			
		?>
	</body>
</html>
