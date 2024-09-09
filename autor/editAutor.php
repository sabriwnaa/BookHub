<?php
// updateAutor.php
if (isset($_GET) && !empty($_GET)) {
    $id = intval($_GET['id']);
    $nome = 

    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");

    // Consulta para atualizar dados do autor
    $query = "UPDATE autor SET nome = '$nome' WHERE id = $id";
    if ($db->query($query)) {
        header("Location: formAddAutor.php");
    } else {
        echo "Erro ao atualizar o autor.";
    }
    $db->close();
} else {
    echo "Nenhum dado foi enviado.";
}
?>
