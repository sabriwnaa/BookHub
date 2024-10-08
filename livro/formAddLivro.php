<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar livro</title>
    <link rel="stylesheet" href="../styleEditLivro.css">
    <link rel="stylesheet" href="../styleGlobal.css">
    <script>
        // Verifica se o parâmetro 'erro' está presente na URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('erro') && urlParams.get('erro') == '1') {
                alert('Nome do Livro já Existe!');
            }
        };
    </script>
    
</head>
<body>
    <?php include '../header.php';?>

    <main><H2>Adicionar novo livro</H2>
        <form method="post" action="addLivro.php" enctype="multipart/form-data">
            
            
            <label for="capa">Selecione o arquivo:</label>
            <input type="file" name="capa" id="capa" required accept=".pdf, .png, .jpg">
            
            
                <input placeholder="Nome do Livro" type="text" id="titulo" required name="titulo">
            
            
            <label for="ano">Ano</label>
            <input type="number" id="ano" required name="ano">
            
            
            <label for="autor">Autor(a)</label>
            <?php
            $db = new mysqli("localhost", "root", "", "bookhub");
            if ($db->connect_error) {
                die("Conexão falhou: " . $db->connect_error);
            }

            $query = "SELECT id, nome FROM autor WHERE arquivado = 0";
            $resultado = $db->query($query);

            if ($resultado->num_rows > 0) {
                echo "<select name='autor' id='autor' required>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
                echo "</select>";
            } else {
                echo "Nenhum autor encontrado";
            }

            // Fecha a conexão com o banco de dados
            $db->close();
            ?>
            <br>
            <button type="submit" name="botao" value="Adicionar">Adicionar</button>
        </form>
    </main>
</body>
</html>
