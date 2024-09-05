<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
        <div class="logoDiv">
            <a href="index.php">
           <img class="logo" src="image/logo.png" alt="">
            <h1>BookHub</h1>
            </a>
        </div>
        
        <div class="pesquisar"> 
            <input class="inputPesquisar" type="text" >
            <img class="loupe" src="image/loupe.png" alt="">
        </div>

        <div class="containerFiltro">

            <button class="btnFiltro" type="button"><img class="imgFilter" src="image/filterLinesW.png" alt=""></button>

        </div>
    </header>
       
    
    
    <main>

        <div class="containerLivros">

       
            <?php
    
                $db = new mysqli("localhost", "root", "", "bookhub");
                $query = "SELECT id,capa FROM `livro`;";
                $resultado = $db->query($query);

                if ($resultado->num_rows > 0) {
                // Percorre os resultados e exibe cada título
                    while($row = $resultado->fetch_assoc()) {
                        $caminhoImagem = $row['capa'];
                        $idLivro = $row['id'];
                    
                        echo " <a href='livro/paginaLivro.php?idLivro={$row['id']}'>";
                        echo "<img class='capa' src='$caminhoImagem' </img>";
                        echo "</a>";
                    }
                } else {
                    echo "Nenhum livro encontrado.";
                }
                // Fecha a conexão com o banco de dados
                $db->close();

            ?>
        

    
        </div>

        
    <div class="menu_content">
    
    
    <div class="item floating_item" style="background-color: #0081CF; z-index: 1; rotate: 45deg;">
        <p>+</p>
    </div>
        <div class="options">
           
                <a href="livro/formAddLivro.php" button id="addLivro" name="addLivro"  class='item'>L</a>
        
                <a href="autor/formAddAutor.php" button id="addAutor" name="addAutor"  class='item' >A</a>
            
        </div>
    </div>

    </main>

    
    <script>
        const menu = document.querySelector('.floating_item')

        menu.onclick = () =>  menu.classList.toggle('active')
    </script>
    

    <footer>
        informações do site
    </footer>

    
    </div>
</body>
</html>