<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logoDiv">
                <a href="../index.php">
                    <img class="logo" src="../image/logo.png" alt="">
                    <h1>BookHub</h1>
                </a>
            </div>
        </header>

        <main class="mainAutores"> 
            <div class="containerAutores">
                <?php
                $db = new mysqli("localhost", "root", "", "bookhub");
                $query = "SELECT * FROM autor";
                $resultado = $db->query($query);
                echo "<div class='listagemAutores'>";

                if ($resultado->num_rows > 0) {
                    while($row = $resultado->fetch_assoc()) {
                        $nomeAutor = htmlspecialchars($row['nome']);
                        $idAutor = $row['id'];
                        echo "<div class='autorIndividual'>";
                        echo "<form method='post' action='updateAutor.php' style='display: inline;'>";
                        echo "<input type='hidden' name='id' value='$idAutor'>";
                        echo "<input type='text' name='nome' value='$nomeAutor' class='editNome'>";
                        echo "<button type='submit' class='saveButton'>Salvar</button>";
                        echo "</form>";
                        echo "<a href='archiveAutor.php?id=$idAutor' class='arquivAutor'>Arquivar</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<h2>Nenhum autor encontrado.</h2>";
                }
                $db->close();
                echo "</div>";
                ?>

                <div class="direita">
                    <div class="addAutor">
                        <h2>Adicionar Autor(a)</h2>
                        <form method='post' action='addAutor.php'>
                            <label for='nome'>Nome</label>
                            <input type='text' id='nome' required name='nome'>
                            <button type='submit'>Adicionar</button>
                        </form>
                    </div>
                    <div class="containerAutoresArquivados"><a class="autoresArquivados" href="listArquivados.php">Autores Arquivados</a></div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
