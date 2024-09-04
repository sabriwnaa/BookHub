<?php
    if(isset($_POST)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
    
        //Query de consulta
        $query = "insert into autor (nome) values ('{$_POST['nome']}')";

        //Executa a consulta e armazena o resultado
        $resultado = $db->query($query);

        header("location:../index.php");
    }
?>