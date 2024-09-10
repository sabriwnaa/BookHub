<?php
$db = new mysqli("localhost", "root", "", "bookhub");


$idLivro = $_GET['idLivro'];


if (isset($idLivro)) {


    
    $query = "DELETE FROM emprestimo WHERE idLivro = $idLivro";
   
    if ($db->query($query) === TRUE) {
        header("Location: ../livro/paginaLivro.php?idLivro=$idLivro");
        exit;
    } else {
        echo "Erro ao Devolver Livro: " . $db->error;
    }
} else {
    echo "Erro ao Devolver Livro.";
}

// Fechar a conexão
$db->close();
?>