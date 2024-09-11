<?php

$db = new mysqli("localhost", "root", "", "bookhub");
$idLivro = $_GET['idLivro'];

$queryLivro = "SELECT * FROM `livro` WHERE id = ".$idLivro.";";
$resultadoLivro = $db->query($queryLivro);

$livro = $resultadoLivro->fetch_array();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar Livro</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="containerEmprestimo">
    <header>
        <div class="logoDiv">
            <a href="../index.php">
           <img class="logo" src="../image/logo.png" alt="">
            <h1>BookHub</h1>
            </a>
        </div>
      <a href="../index.php" class="btnVerTodos">Ver todos</a>
    </header>
    <main>
    <div class="tituloEmprestimoLivro">
    <h1 class="h1EmprestimoLivro">Emprestar "<?php echo $livro['titulo'];?>"</h1></div>


    <div class="ContainerImgEmprestimoLivro"> <img class="imgEmprestimoLivro" src="../<?php echo $livro['capa']; ?>"> </div>

    

 
    <form class="formEmprestimoLivro" action="emprestarLivro.php" method="POST">
        
        <input  type="hidden" id="idLivro" name="idLivro" value="<?php echo $_GET['idLivro']; ?>" required>

        <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required></div>

        <button type="submit" value="Emprestar Livro">Emprestar Livro</button>
    </form>
</div>
</main>
</body>
</html>



