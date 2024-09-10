<?php
if (isset($_GET['idAutor']) && isset($_GET['status'])) {
    $db = new mysqli("localhost", "root", "", "bookhub");

    $idAutor = intval($_GET['idAutor']);
    $novoStatus = intval($_GET['status']);

    // Atualiza o status do autor no banco de dados
    $query = "UPDATE autor SET arquivado = $novoStatus WHERE id = $idAutor";
    $resultado = $db->query($query);

    if ($resultado) {
        header("Location: formAddAutor.php");
        exit();
    } else {
        echo "Erro ao arquivar/desarquivar o autor.";
    }

    $db->close();
} else {
    echo "Parâmetros não fornecidos.";
}
?>
