<?php
// archiveAutor.php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Garantir que o ID é um inteiro

    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");

    // Consulta para arquivar o autor
    $query = "UPDATE autor SET arquivado = 1 WHERE id = $id";
    if ($db->query($query)) {
        header("Location: formAddAutor.php");
    } else {
        echo "Erro ao arquivar o autor.";
    }
    $db->close();
} else {
    echo "ID do autor não fornecido.";
}
?>
