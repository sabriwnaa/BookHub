<?php
    if (isset($_GET['idLivro']) && !empty($_GET['idLivro'])) {
        // Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
        $idLivro = $_GET['idLivro'];

        // Verifica se a variável contém um número válido
        $query = "SELECT * FROM `livro` WHERE id = $idLivro;";
        $resultado = $db->query($query);

        if ($resultado) {
            $livro = $resultado->fetch_array();
        } else {
            echo "Erro ao buscar o livro.";
        }

        // Pega os autores para o dropdown
        $queryAutor = "SELECT id, nome FROM `autor`;";
        $resultadoAutor = $db->query($queryAutor);
    } else {
        echo "ID do livro não foi fornecido ou é inválido.";
    }
?>
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
            if (urlParams.has('erro') && urlParams.get('erro') === '1') {
                alert('Nome do Livro já Existe!');
            }
        };
    </script>
</head>
<body>
    <header>
        <div class="logoDiv">
            <a href="../index.php">
                <img class="logo" src="../image/logo.png" alt="">
                <h1>BookHub</h1>
            </a>
        </div>
        <button class="btnNSalvar" onclick="window.location.href='paginaLivro.php?idLivro=<?php echo $idLivro; ?>'">Voltar sem Salvar</button>
    </header>

    <main>

        <form action="editLivro.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $idLivro; ?>">

            <div class="containerCapa"><img src="<?php echo "../" . $livro['capa']; ?>" alt="Capa Atual" style="max-width: 150px;">
                <label>Capa do Livro:</label>
                <input type="file" name="capa" accept="image/*">
                
            </div>

            <div class="containerInfo">
                <div class="infoHeader">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $livro['titulo']; ?>" required>
                </div>

                <div class="infoMain">
                    <label for="autor">Autor(a):</label>
                    <select id="autor" name="idAutor" required>
                        <?php
                        // Carrega todos os autores para o dropdown
                        while($autor = $resultadoAutor->fetch_array()){
                            $selected = $autor['id'] == $livro['idAutor'] ? "selected" : "";
                            echo "<option value='".$autor['id']."' $selected>".$autor['nome']."</option>";
                        }
                        
                        ?>
                    </select>

                    <label for="ano">Ano:</label>
                    <input type="number" id="ano" name="ano" value="<?php echo $livro['ano']; ?>" required>

                </div>

                <div class="infoFooter">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
