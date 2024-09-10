<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprestar Livro</title>
</head>
<body>
    <h1>Emprestar Livro</h1>

 
    <form action="emprestarLivro.php" method="POST">
        
        <input  type="hidden" id="idLivro" name="idLivro" value="<?php echo $_GET['idLivro']; ?>" required>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Emprestar Livro">
    </form>
</body>
</html>

