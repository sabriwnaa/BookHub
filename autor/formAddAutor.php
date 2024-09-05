<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
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

        <div class="containerAutores">

            <?php

                $db = new mysqli("localhost", "root", "", "bookhub");
                $query = "SELECT nome FROM `autor`;";
                $resultado = $db->query($query);

                if ($resultado->num_rows > 0) {
                    while($row = $resultado->fetch_assoc()) {
                        $nomeAutor = $row['nome'];
                        echo "<h2 class='autor'>" .$nomeAutor. "</h2>";
                    }
                } else {
                    echo "<h2>Nenhum autor encontrado.</h2>";
                }
                $db->close();

            ?>



        </div>


        <div class="addAutor">
            <h2>Adicionar Autor(a)</h2>
            <form method='post' action='addAutor.php'>

                <label for=nome>Nome</label>
                <input type=text id=nome required name=nome>
                
            </form>
        </div>




    </main>
</body>
</html>