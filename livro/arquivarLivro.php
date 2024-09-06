<?php
if (isset($_GET['idLivro']) && isset($_GET['status'])) {
    $db = new mysqli("localhost", "root", "", "bookhub");
    $idLivro = $_GET['idLivro'];
    $novoStatus = $_GET['status'];

    $query = "UPDATE livro SET arquivado = $novoStatus WHERE id = $idLivro";
    $resultado = $db->query($query);

    if ($resultado) {
        header("Location: paginaLivro.php?idLivro=$idLivro");
    } else {
        echo "Erro ao arquivar/desarquivar o livro.";
    }
    
    $db->close();
}
?>
