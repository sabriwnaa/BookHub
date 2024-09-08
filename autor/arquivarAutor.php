
    <?php
    if (isset($_GET['idAutor']) && isset($_GET['status'])) {
        $db = new mysqli("localhost", "root", "", "bookhub");
        $idAutor = $_GET['idAutor'];
        $novoStatus = $_GET['status'];
    
        $query = "UPDATE autor SET arquivado = $novoStatus WHERE id = $idAutor";
        $resultado = $db->query($query);
    
        if ($resultado) {
            header("Location: paginaLivro.php?idAutor=$idAutor");
        } else {
            echo "Erro ao arquivar/desarquivar o livro.";
        }
        
        $db->close();
    }

    header("Location: formAddautor.php");
    ?>

