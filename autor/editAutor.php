<?php
// updateAutor.php
if (isset($_POST) && !empty($_POST)) {
    $id = intval($_POST['id']);
    $nome = $db->real_escape_string($_POST['nome']); // Protege contra SQL Injection

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
