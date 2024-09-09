<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
    <link rel="stylesheet" href="../styleGlobal.css">
    <link rel="stylesheet" href="../styleAddAutor.css">
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
          
                <?php
                    $db = new mysqli("localhost", "root", "", "bookhub");
                    $query = "SELECT * FROM autor";
                    $resultado = $db->query($query);
                    echo "<div class='listagemAutores'>";
                    // Verifica se houve resultados
                    if ($resultado->num_rows > 0) {
                        // Faz a listagem dos autores
                        while($row = $resultado->fetch_assoc()) {
                            $nomeAutor = htmlspecialchars($row['nome']);
                            $idAutor = $row['id'];
                            $arquivado = $row['arquivado'];
                    
                            // Cria uma div individual para cada autor
                            echo "<div class='autorIndividual'>";
                    
                            // Um form para editar o nome do autor
                            echo "<form method='post' action='updateAutor.php' style='display: inline;'>";
                            // ID escondido
                            echo "<input type='hidden' name='idAutor' value='$idAutor'>";
                            echo "<input type='text' name='nome' value='$nomeAutor' class='editNome'>";
                            echo "<button type='submit' class='saveButton'>Salvar</button>";
                            echo "</form>";
                    
                            // Botão de arquivar/desarquivar
                            $linkTexto = ($arquivado == 1) ? 'Desarquivar' : 'Arquivar';
                            $novoStatus = ($arquivado == 1) ? 0 : 1;
                            echo "<a href='arquivarAutor.php?idAutor=$idAutor&status=$novoStatus'>$linkTexto</a>";
                    
                            echo "</div>";
                        }
                    } else {
                        echo "<h2>Nenhum autor encontrado.</h2>";
                    }
                    
                    $db->close();
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
            
        </main>
    </div>
</body>
</html>
