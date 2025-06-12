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
		<h3>Semana 01 - Exemplo 07 - Detalhes do Produto</h3>
		<?php
			date_default_timezone_set("America/Sao_Paulo");
			function formataData($data, $fomato){ // 2005-04-15 00:00:00
				$datanova = date_create($data);
				return date_format($datanova, $fomato);
			}
			
			function formataData2($data){ // 2005-04-15 00:00:00
				return substr($data, 8, 2). "/" .substr($data, 5, 2).
				"/" . substr($data, 0, 4);
			}
			
			function convertedata($data){
				$data_vetor = explode("-", substr($data, 0, 10));
				$novadata = implode("/", array_reverse ($data_vetor));
				return $novadata;
			}
		
			try {
				include("conexao.php");
				// recuperando a informação da URL
				// verifica se parâmetro está correto e dento da normalidade 
				if(isset($_GET["id"]) && is_numeric(base64_decode($_GET["id"]))){
					$id = base64_decode($_GET["id"]);
				} else {
					header("Location: index.php");
				}
				//$id = base64_decode($_GET['id']);
				
				// realizando a pesquisa com o id recebido
				$sql = "select * from tabelaimg where id = $id";
				$query = mysqli_query($conexao, $sql);
				/*
				if (!$query) {
					die('Query Inválida: ' . @mysqli_error($conexao));  
				}
				*/
				$dados = mysqli_fetch_assoc($query);
				
				echo "<table>
					<tr>
						<td>";
				if (empty($dados["imagem"])){
					$imagem = "semimagem.png";
				}else{
					$imagem = $dados["imagem"];
				}
				echo "<img src=\"imagens/$imagem\" >";
				echo "</td>
					<td>";
				echo "<b>Id: </b>".$dados['id']."<br>";
				echo "<b>Codigo: </b>".$dados['codigo']."<br>";
				echo "<b>Produto: </b>".$dados['produto']."<br>";	
				echo "<b>Descrição: </b>{$dados["descricao"]}<br>";
				echo "<b>Data: </b>" . formataData($dados["data"],"d/m/Y") . "<br>";				
				echo "<b>Valor: </b> R$ ". number_format($dados["valor"], 2, ",", ".")."<br>";
				echo "</td>
				</tr>
				</table>";
				
				mysqli_close($conexao);
			} catch (Exception $e){
				echo "<h4>Ocorreu um erro: <br>" . $e->GetMessage() . "</h4>\n";
			}		
		?>
		<br>
		<a href="index.php">Voltar</a>
	</body>
</html>
