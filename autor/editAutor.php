<?php
session_start();

if (isset($_POST) && !empty($_POST)) {
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");

    // Verifica se o nome do autor já existe no banco (exceto o próprio autor que está sendo editado)
    $nome = $db->real_escape_string($_POST['nome']);
    $idAutor = intval($_POST['id']);
    
    $queryVerificaNome = "SELECT * FROM autor WHERE nome = '$nome' AND id != $idAutor";
    $resultadoNome = $db->query($queryVerificaNome);

    if ($resultadoNome->num_rows > 0) {
        // Se o autor com o mesmo nome já existir, salva uma mensagem de erro na sessão e redireciona de volta para o formulário de edição
        $_SESSION['erro'] = "Um autor com este nome já existe.";
        header("Location: index.php?editId=$idAutor&erro=1");
        exit;
    }

    // Atualiza os dados do autor
    $query = "UPDATE autor SET nome = '$nome' WHERE id = $idAutor";

    // Executa a consulta de atualização
    if ($db->query($query)) {
        header("Location: formAddAutor.php");
    } else {
        // Se houve um erro na atualização, redireciona de volta com uma mensagem de erro
        $_SESSION['erro'] = "Erro ao atualizar o autor.";
        header("Location: index.php?editId=$idAutor&erro=1");
    }

    $db->close();
} else {
    echo "Nenhum dado foi enviado.";
}
?>
