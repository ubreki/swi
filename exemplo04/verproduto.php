<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Produto - EletroDominus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Detalhes completos do produto">
    <meta name="keywords" content="produto, eletrônicos, detalhes">
    <meta name="author" content="SeuNome">
	<link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --primary: #7371FC;
            --secondary: #A594F9;
            --light-bg: #e1e1e1;
            --medium-bg: #E5D9F2;
            --border-color: #CDC1FF;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #FFFFFF;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        
        @media (max-width: 768px) {
            .product-container {
                gap: 20px;
                padding: 0 10px;
            }
            
            .product-image, .product-details {
                flex: 1 1 100%;
                min-width: auto;
            }
            
            .product-image {
                max-height: 400px;
            }
            
            .product-details {
                padding: 20px;
            }
            
            .back-button {
                padding: 10px 25px;
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 15px;
            }
            
            .product-image {
                padding: 15px;
                border-radius: 10px;
            }
            
            .detail-value {
                font-size: 1rem;
            }
            
            .price {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <?php
        date_default_timezone_set("America/Sao_Paulo");
        function formataData($data, $fomato) {
            $datanova = date_create($data);
            return date_format($datanova, $fomato);
        }

        try {
            include("conexao.php");
            if (isset($_GET["id"]) && is_numeric(base64_decode($_GET["id"]))) {
                $id = base64_decode($_GET["id"]);
            } else {
                header("Location: index.php");
            }

            $sql = "select * from tabelaimg where id = $id";
            $query = mysqli_query($conexao, $sql);
            $dados = mysqli_fetch_assoc($query);

            echo "<div class='page-header'>";
            echo "<h1 class='product-title'>" . htmlspecialchars($dados['produto']) . "</h1>";
            echo "</div>";

            echo "<div class='product-container'>";
            
            // Imagem do produto (lado esquerdo)
            if (empty($dados["imagem"])) {
                $imagem = "semimagem.png";
            } else {
                $imagem = $dados["imagem"];
            }
            echo "<div class='product-image'>";
            echo "<img src='imagens/$imagem' alt='" . htmlspecialchars($dados['produto']) . "'>";
            echo "</div>";
            
            // Detalhes do produto (lado direito)
            echo "<div class='product-details'>";
            
            echo "<div class='detail-section'>";
            echo "<span class='detail-label'>Código do Produto</span>";
            echo "<span class='detail-value'>" . htmlspecialchars($dados['codigo']) . "</span>";
            echo "</div>";
            
            echo "<div class='detail-section'>";
            echo "<span class='detail-label'>Descrição Completa</span>";
            echo "<span class='detail-value'>" . nl2br(htmlspecialchars($dados['descricao'])) . "</span>";
            echo "</div>";
            
            echo "<div class='detail-section'>";
            echo "<span class='detail-label'>Data de Cadastro</span>";
            echo "<span class='detail-value'>" . formataData($dados["data"], "d/m/Y") . "</span>";
            echo "</div>";
            
            echo "<div class='price-container'>";
            echo "<span class='detail-label'>Preço</span>";
            echo "<span class='detail-value price'>R$ " . number_format($dados["valor"], 2, ",", ".") . "</span>";
            echo "</div>";
            
            echo "</div>"; // fecha product-details
            echo "</div>"; // fecha product-container

            echo "<div class='button-container'>";
            echo "<a href='index.php' class='back-button'>← Voltar para a lista</a>";
            echo "</div>";

            mysqli_close($conexao);
        } catch (Exception $e) {
            echo "<div style='color: red; padding: 20px; text-align: center;'>";
            echo "<h4>Ocorreu um erro ao carregar os detalhes do produto:</h4>";
            echo "<p>" . htmlspecialchars($e->GetMessage()) . "</p>";
            echo "<p><a href='index.php' style='color: #7371FC;'>Voltar à página inicial</a></p>";
            echo "</div>";
        }        
    ?>
</body>
</html>
