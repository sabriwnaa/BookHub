<?php
if (isset($_GET['idAutor']) && isset($_GET['status'])) {
    $db = new mysqli("localhost", "root", "", "bookhub");

    $idAutor = intval($_GET['idAutor']);
    $novoStatus = intval($_GET['status']);

    $queryVerifica = "SELECT COUNT(*) as total FROM livro WHERE idAutor = $idAutor";
    $resultadoVerifica = $db->query($queryVerifica);
    $dadosVerifica = $resultadoVerifica->fetch_assoc();

    if($novoStatus == 0 || $dadosVerifica['total'] == 0){
        $query = "UPDATE autor SET arquivado = $novoStatus WHERE id = $idAutor";
        $resultado = $db->query($query);

         if ($resultado) {
             header("Location: formAddAutor.php");
            exit();
         } else {
              echo "Erro ao arquivar/desarquivar o autor.";
         }
    } else {
        echo "Não é possível arquivar o autor. Existem livros associados a ele.";
    }
    

    $db->close();
} else {
    echo "Parâmetros não fornecidos.";
}
?>
