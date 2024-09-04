<?php
   
    $db = new mysqli("localhost", "root", "", "bookhub");
    $query = "SELECT titulo FROM `livro` WHERE 1;";
    $resultado = $db->query($query);
?>