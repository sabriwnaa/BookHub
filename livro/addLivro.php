<?php
    if(isset($_POST)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
    

        $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/BookHub/image/";

        if($_FILES['capa']['error'] != 0 ){
         header("location:../index.html");
        }

        //Caminho onde o imagem será armazenado
        $destinoCapa = $diretorioDestino.$_FILES['capa']['name'];

        $caminhoTeste = "image/" . $_FILES['capa']['name'];

        //adiciona a imagem no php aqui
        move_uploaded_file($_FILES['capa']['tmp_name'], $destinoCapa);

        //Query de consulta
        $query = "insert into livro (titulo, ano, idAutor, capa) values ('{$_POST['titulo']}',{$_POST['ano']},{$_POST['autor']},'{$caminhoTeste}')";

        //Executa a consulta e armazena o resultado
        $resultado = $db->query($query);

        header("location:../index.php");
    }
?>