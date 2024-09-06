<?php
if (isset($_POST) && !empty($_POST)) {
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");
    
    // Verifica se foi enviado um novo arquivo de capa
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
        $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/BookHub/image/";
        $destinoCapa = $diretorioDestino . $_FILES['capa']['name'];
        $caminhoTeste = "image/" . $_FILES['capa']['name'];
        
        // Move a nova imagem para o diretório
        move_uploaded_file($_FILES['capa']['tmp_name'], $destinoCapa);

        // Atualiza com a nova capa
        $query = "UPDATE livro SET titulo = '{$_POST['titulo']}', ano = {$_POST['ano']}, idAutor = {$_POST['idAutor']}, capa = '{$caminhoTeste}', emprestado = {$_POST['emprestado']} WHERE id = {$_POST['id']}";
    } else {
        // Atualiza os dados sem modificar a capa
        $query = "UPDATE livro SET titulo = '{$_POST['titulo']}', ano = {$_POST['ano']}, idAutor = {$_POST['idAutor']}, emprestado = {$_POST['emprestado']} WHERE id = {$_POST['id']}";
    }

    // Executa a consulta
    if ($db->query($query)) {
        header("Location: paginaLivro.php?idLivro={$_POST['id']}");
    } else {
        echo "Erro ao atualizar o livro.";
    }
} else {
    echo "Nenhum dado foi enviado.";
}
?>
