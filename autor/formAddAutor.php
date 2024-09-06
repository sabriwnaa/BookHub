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
                    $query = "SELECT nome FROM `autor`;";
                    $resultado = $db->query($query);
                    echo"<div class='listagemAutores'>";

                    if ($resultado->num_rows > 0) {
                        while($row = $resultado->fetch_assoc()) {
                            $nomeAutor = $row['nome'];
                            echo" <div class='autorIndividual'>";
                            echo "<h2 class='autor'>" .$nomeAutor. "</h2>";
                            echo "<a href='#' class='editAutor'> <img src='#'>Edit</a>";
                            echo "<a href='#' class='arquivAutor'> <img src='#'>Arq</a>";
                            echo "</div>";
                        }
                    } else {
                    echo "<h2>Nenhum autor encontrado.</h2>";
                    }
                    $db->close();
                    echo"</div>";
                ?>



   


                <div class="direita">
                    <div class="addAutor">
                        <h2>Adicionar Autor(a)</h2>
                        <form method='post' action='addAutor.php'>

                            <label for=nome>Nome</label>
                            <input type=text id=nome required name=nome>

                            <a href="formAddAutor.php?addAutor" id="addAutor" name="addAutor"></a>
            
                        </form>
                    </div>
                    <div class="containerAutoresArquivados"><a class="autoresArquivados" href="#">Autores Arquivados</a></div>
                </div>
        </div>
                


    </main>
</div>
</body>
</html>