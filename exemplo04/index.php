<!DOCTYPE html>
<html>
<head>
    <title>Exemplo PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eletro Domestics">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Luis Eduardo e Pedro Filipi">
    <link rel="stylesheet" href="css/style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="imagens/logo.png" alt="Logo da EletroDominus">
        <h1 class="titulo">
            <span>Eletro</span><span class="cor1">Dominus</span>
        </h1>
    </div>
    <p class="subtitle">Praticidade e Tecnologia para o seu lar</p>
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

            echo '<div class="action-links">
                    <a href="inclusao.php">Incluir Novo Produto</a>
                    <a href="index.php">Atualizar Página</a>
                </div>';

            echo '<br><br>';

            echo '<div class="search-form">
                    <form action="#" method="post">
                        <label for="prod">Filtrar por Produto:</label>
                        <input type="text" name="produto" id="prod" maxlength="30" placeholder="Digite o nome do produto">
                        <input type="submit" value="Pesquisar">
                    </form>
                </div>';

            echo '<br><br>';
            
            echo '<div class="card-container">';


            while ($dados = mysqli_fetch_assoc($query)){
                $id = base64_encode($dados["id"]);
                echo '<div class="card">
                        <div class="card-image">
                            <img src="imagens/'. (empty($dados["imagem"]) ? "semimagem.png" : $dados["imagem"]) .'" alt="'. $dados['produto'] .'">
                        </div>
                        <div class="card-content">
                            <h3 class="product-name">'. $dados['produto'] .'</h3>
                            <p class="product-id">Código: '. $dados['codigo'] .'</p>
                            <p class="product-price">R$ '. number_format($dados["valor"], 2, ",", ".") .'</p>
                            <div class="card-actions">
                                <a href="verproduto.php?id='.$id.'" class="view">Ver Detalhes</a>
                                <a href="edicao.php?id='.$id.'" class="edit">Editar</a>
                                <a href="excluir.php?id='.$id.'" class="delete">Excluir</a>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>';

            mysqli_close($conexao);
        } catch (Exception $e){
            echo '<div class="error-message">Ocorreu um erro: <br>' . $e->GetMessage() . '</div>';
        }	
    ?>
</body>
</html>
