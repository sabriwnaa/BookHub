<?php
    if(isset($_POST)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
    

        $diretorioDestino = "../image/";
        if($_FILES['capa']['error'] != 0 ){
         header("location:../index.html");
        }

        //Caminho onde o imagem será armazenado
        $destinoCapa = $diretorioDestino.$_FILES['capa']['name'];

        //Query de consulta
        $query = "insert into livro (titulo, id, ano, capa) values ('{$_POST['titulo']}',{$_POST['autor']},{$_POST['ano']},'{$destinoCapa}')";

        //Executa a consulta e armazena o resultado
        $resultado = $db->query($query);

        header("location:../index.php");
    }
?>