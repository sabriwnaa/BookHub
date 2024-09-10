<?php
$db = new mysqli("localhost", "root", "", "bookhub");


$idLivro = $_POST['idLivro'];
$nome = $_POST['nome'];
$email = $_POST['email'];

if (isset($idLivro) && isset($nome) && isset($email)) {


    
    $query = "INSERT INTO emprestimo (idLivro, nomePessoa, emailPessoa) VALUES ('$idLivro', '$nome', '$email')";
   
    if ($db->query($query) === TRUE) {
        header("Location: ../livro/paginaLivro.php?idLivro=$idLivro");
    } else {
        echo "Erro ao realizar o emprestimo: " . $db->error;
    }
} else {
    echo "Erro ao realizar o emprestimo.";
}

// Fechar a conexão
$db->close();
?>