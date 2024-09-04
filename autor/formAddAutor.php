<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Autor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="logoDiv">
            <a href="../index.php">
           <img class="logo" src="../image/logo.png" alt="">
            <h1>BookHub</h1>
            </a>
        </div>
        
    </header>

    <main> 
    <form method='post' action='addAutor.php'>

        <label for=nome>Nome</label>
        <input type=text id=nome required name=nome>
        
    </form>
    </main>
</body>
</html>