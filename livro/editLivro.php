<?php
session_start();

if (isset($_POST) && !empty($_POST)) {
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");
    
    // Verifica se o título do livro já existe no banco (exceto o próprio livro que está sendo editado)
    $titulo = $_POST['titulo'];
    $idLivro = $_POST['id'];
    $queryVerificaTitulo = "SELECT * FROM livro WHERE titulo = '$titulo' AND id != $idLivro;";
    $resultadoTitulo = $db->query($queryVerificaTitulo);

    if ($resultadoTitulo->num_rows > 0) {
        // Se o livro com o mesmo título já existir, salva uma mensagem de erro na sessão e redireciona de volta para o formulário de edição
       
        header("Location: formEditLivro.php?idLivro=$idLivro && erro=1");
        exit;
    }

    // Verifica se foi enviado um novo arquivo de capa
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
        $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/BookHub/image/";
        $destinoCapa = $diretorioDestino . $_FILES['capa']['name'];
        $caminhoTeste = "image/" . $_FILES['capa']['name'];
        
        // Move a nova imagem para o diretório
        move_uploaded_file($_FILES['capa']['tmp_name'], $destinoCapa);

        // Atualiza com a nova capa
        $query = "UPDATE livro SET titulo = '{$_POST['titulo']}', ano = {$_POST['ano']}, idAutor = {$_POST['idAutor']}, capa = '{$caminhoTeste}' WHERE id = {$_POST['id']}";
    } else {
        // Atualiza os dados sem modificar a capa
        $query = "UPDATE livro SET titulo = '{$_POST['titulo']}', ano = {$_POST['ano']}, idAutor = {$_POST['idAutor']} WHERE id = {$_POST['id']}";
    }

    // Executa a consulta de atualização
    if ($db->query($query)) {
        header("Location: paginaLivro.php?idLivro={$_POST['id']}");
    } else {
        
        header("Location: formEditLivro.php?idLivro=$idLivro & erro=1");
    }
} else {
    echo "Nenhum dado foi enviado.";
}
?>
