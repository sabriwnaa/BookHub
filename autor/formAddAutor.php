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
        
    <?php include '../header.php';?>

        <div class="listagemAutores">
        <main class="mainAutores"> 
            <div class="listagemAutores">
                <?php
                    $db = new mysqli("localhost", "root", "", "bookhub");
                    $editId = isset($_GET['editId']) ? intval($_GET['editId']) : 0;
                    $query = "SELECT * FROM autor WHERE arquivado = 0";
                    $resultado = $db->query($query);
                    
                    // Verifica se houve resultados
                    if ($resultado->num_rows > 0) {
                        // Faz a listagem dos autores
                        while($row = $resultado->fetch_assoc()) {
                            $nomeAutor = $row['nome'];
                            $idAutor = $row['id'];
                            $arquivado = $row['arquivado'];
                    
                            if ($editId == $idAutor) {
                                // Exibir formulário de edição se o ID do autor for igual ao editId
                                echo "<div class='autorIndividual'>";
                                
                                echo "<form method='POST' action='editAutor.php'>";
                                echo "<input type='hidden' name='id' value='$idAutor'>";
                                echo "<input type='text' name='nome' value='$nomeAutor'>";
                                echo "<input type='submit' value='Salvar'>";
                                echo "</form>";
                                echo "<a href='arquivarAutor.php?idAutor=$idAutor&status=1'>Arquivar</a>";
                                echo "</div>";
                            } else {
                                // Exibir nome do autor e botões
                                echo "<div class='autorIndividual'>";
                                echo "<h2>" . $nomeAutor . "</h2>";
                                echo "<a href='?editId=$idAutor'>Editar</a> ";
                                echo "<a href='arquivarAutor.php?idAutor=$idAutor&status=1'>Arquivar</a>";
                                echo "</div>";
                            }


                            // Cria uma div individual para cada autor
                            //echo "<div class='autorIndividual'>";
                           // echo "<h2>" . $row['nome'] . "</h2>";

                            //echo "<a href='arquivarAutor.php?idAutor=$idAutor&status=1'>Arquivar</a>";
                            //echo "</div>";
                    
                            
                        }
                    } else {
                        echo "<h2>Nenhum autor encontrado.</h2>";
                    }
                    
                    $db->close();
                    ?>
            </div>

                <div class="direita">
                    <div class="addAutor">
                        <h2>Adicionar Autor(a)</h2>
                        <form method='post' action='addAutor.php'>
                            <label for='nome'>Nome</label>
                            <input type='text' id='nome' required name='nome'>
                            <button type='submit'>Adicionar</button>
                        </form>
                    </div>
                    <div class="containerAutoresArquivados"><a class="autoresArquivados" href="autoresArquivados.php">Autores Arquivados</a></div>
                </div>
            
        </main>
    </div>
</body>
</html>
