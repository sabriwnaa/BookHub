<?php
if(isset($_POST)){
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "bookhub");

    if($db->connect_error){
        die("Erro de conexão: " . $db->connect_error);
    }

    $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/BookHub/image/";

    if($_FILES['capa']['error'] != 0 ){
        header("location:../index.php");
        exit;
    }

    // Caminho onde a imagem será armazenada
    $destinoCapa = $diretorioDestino.$_FILES['capa']['name'];
    $caminhoTeste = "image/" . $_FILES['capa']['name'];

    // Adiciona a imagem no servidor
    move_uploaded_file($_FILES['capa']['tmp_name'], $destinoCapa);

    // Verifica se o livro já existe no banco de dados
    $titulo = $db->real_escape_string($_POST['titulo']);
    $consulta = "SELECT * FROM livro WHERE titulo = '$titulo'";
    $resultadoConsulta = $db->query($consulta);

    if($resultadoConsulta->num_rows > 0){
        // Livro já existe, redireciona de volta para o formulário de adição de livro
        header("location:formAddLivro.php?erro=1");
        exit;
    } else {
        // Caso o livro não exista, insere no banco de dados
        $ano = intval($_POST['ano']);
        $autor = intval($_POST['autor']);
        $query = "INSERT INTO livro (titulo, ano, idAutor, capa) VALUES ('$titulo', $ano, $autor, '$caminhoTeste')";

        if($db->query($query) === TRUE){
            header("location:../index.php");
        } else {
            echo "Erro ao inserir o livro: " . $db->error;
        }
    }

    // Fecha a conexão com o banco de dados
    $db->close();
}
?>
