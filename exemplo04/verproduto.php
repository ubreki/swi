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
			table, th, td {
				border: 1px solid #000000;
			}
			.imagem {
				width: 250px;
			}
		</style>
	</head>
	<body>
		<h3>Semana 01 - Exemplo 8 - Detalhes do Produto</h3>
		<?php
			try {
				date_default_timezone_set("America/Sao_Paulo");
				
				include("conexao.php");
				// 0123456789
				// 2017-05-01 00:00:00
				function formataData($data, $formato){
					$novadata = date_create($data);
					return date_format($novadata, $formato);
				}
				
				function convertedata2($data){
					$novadata = substr($data, 8, 2).'/'.substr($data, 5, 2).'/'.substr($data, 0, 4);
					return $novadata;
				}
				function convertedata($data){
					$data_vetor = explode("-", substr($data, 0, 10));
					$novadata = implode("/", array_reverse ($data_vetor));
					return $novadata;
				}
				
				// recuperando a informação da URL
				// verifica se parâmetro está correto e dento da normalidade 
				if(isset($_GET["id"]) && is_numeric(base64_decode($_GET["id"]))){
					$id = base64_decode($_GET["id"]);
				} else {
					header("Location: index.php");
				}
				
				// realizando a pesquisa com o id recebido
				$sql = "select * from tabelaimg where id = $id";
				$query = mysqli_query($conexao, $sql);

				$dados = mysqli_fetch_assoc($query);
				
				echo "<table>
						<tr>
							<td>";
				if (empty($dados["imagem"])){
					$imagem = "semimagem.jpg";
				}else{
					$imagem = $dados["imagem"];
				}
				echo "<img class=\"imagem\" src=\"imagens/$imagem\">\n";
				echo "</td>
					<td width='400px'>\n";
				echo "<b>Id: </b>{$dados["id"]}<br>\n";
				echo "<b>Código: </b>".$dados['codigo']."<br>\n";
				echo "<b>Produto: </b>".$dados['produto']."<br>\n";	
				echo "<b>Descrição: </b>".$dados['descricao']."<br>\n";	
				echo "<b>Data: </b>". formataData($dados['data'],"d/m/Y") ."<br>\n";	
				echo "<b>Data: </b>". date_format(date_create($dados['data']),"d/m/Y") ."<br>\n";	
				echo "<b>Valor: </b> R$ ". 
					number_format($dados['valor'],2,",",".") ."<br>\n";
				echo "</td>
					</tr>
				</table>\n";
				
				mysqli_close($conexao);
			} catch (Exception $e) {
				echo "<h2>Aconteceu um erro:<br>" .
				$e->GetMessage() ."</h2>\n";
			}
		?>
		<br>
		<a href="index.php">Voltar</a>
	</body>
</html>
