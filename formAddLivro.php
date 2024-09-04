<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar livro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logoDiv">
            <a href="index.php">
           <img class="logo" src="image/logo.png" alt="">
            <h1>BookHub</h1>
            </a>
        </div>
        
    </header>

    <main> 
    <form method='post' action='addLivro.php' enctype="multipart/form-data">
        <label for="capa">Selecione o arquivo:</label>
        <input type="file" name="capa" id="capa" required  accept=".pdf, .png">
        <label for=titulo>Título</label>
        <input type=text id=titulo required name=titulo>
        <br>
        <label for=ano>Ano</label>
        <input type=number id=ano required name=ano>
        <br>
        <label for=autor>Autor(a)</label>
        <select id=autor required name=autor>
        <br>
        <input type=submit name=botao value='Adicionar'>
    </form>
    </main>
</body>
</html>