<?php
// editAutor.php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);

    $db = new mysqli("localhost", "root", "", "bookhub");

    // Consulta para obter dados do autor
    $query = "SELECT * FROM autor WHERE id = $id";
    $resultado = $db->query($query);
    $autor = $resultado->fetch_assoc();
    $db->close();
} else {
    echo "ID do autor não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logoDiv">
                <a href="../index.php">
                    <img class="logo" src="../image/logo.png" alt="">
                    <h1>BookHub</h1>
                </a>
            </div>
        </header>

        <main>
            <div class="containerEditAutor">
                <h2>Editar Autor(a)</h2>
                <form method='post' action='editAutor.php?id=<?php echo htmlspecialchars($autor['id']); ?> && nome='<?php echo htmlspecialchars($['nome']); ?>'>
                    
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome"?>" required>
                    <button type="submit">Atualizar</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
