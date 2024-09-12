<?php
// listArquivados.php

// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "bookhub");

// Consulta para obter autores arquivados
$query = "SELECT * FROM autor WHERE arquivado = 1";
$resultado = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores Arquivados</title>
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

            <a href="formAddAutor.php" class="btnVerTodos">Autores desarquivados</a>

        </header>

        <main>
            <h2>Autores Arquivados</h2>
            <div class="listagemAutores">
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        $idAutor = $row['id'];
                        echo "<div class='autorIndividual'>";
                        echo "<h2 class='autor'>" . htmlspecialchars($row['nome']) . "</h2>";
                        echo "<a href='arquivarAutor.php?idAutor=$idAutor&status=0'>Desarquivar</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<h2>Nenhum autor arquivado encontrado.</h2>";
                }
                $db->close();
                ?>
            </div>
        </main>
    </div>
</body>
</html>
