
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro</title>
    <link rel="stylesheet" href="../style.css">
    
</head>
<body>
    
</body>
</html>

<div class="container">
    <header>
        <div class="logoDiv">
            <a href="../index.php">
           <img class="logo" src="../image/logo.png" alt="">
            <h1>BookHub</h1>
            </a>
        </div>
      <button class="btnVerTodos">Ver todos</button>
    </header>

    


    <main class="mainLivro">
    <?php
    if(isset($_GET)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
        $idLivro = $_GET['idLivro'];
        
    
        $query = "SELECT * FROM `livro` WHERE id = ".$idLivro.";";
        $resultado = $db->query($query);

        $livro = $resultado->fetch_array();
       
        
        

        // Fecha a conexão com o banco de dados
        $db->close();
        }
    ?>
    
    <div class="containerCapa">
        <img  src="<?php   
        $caminhoImagem = "../".$livro['capa'];
        echo $caminhoImagem;
        
        ?>">
    </div>
    <div class="containerInfo">
        <div class="infoHeader">
            <h1><?php   echo $livro['titulo']; ?></h1>
        </div>
        <div class="infoMain">
            <p>Autor(a): 
                <?php
                $db = new mysqli("localhost", "root", "", "bookhub");
                $query = "SELECT nome FROM `autor` WHERE id = ".$livro['idAutor'].";";
                $resultado = $db->query($query);
    
                $autor = $resultado->fetch_array();
                echo $autor['nome']; 
                ?></p>
            <p>Ano: <?php   echo $livro['ano']; ?></p>
            <p>status: <?php   
            if ($livro['emprestado'] == 0){
                echo "livre";
            }else{
                echo "emprestado";
            }; ?></p>
            
        </div>
        <div class="infoFooter">
            
        
            <a href="formEditLivro.php?idLivro=<?php echo $livro['id']; ?>">Editar</a>
            <a href="arquivarLivro.php?idLivro=<?php echo $livro['id']; ?>&status=<?php echo ($livro['arquivado'] == 1) ? 0 : 1; ?>">
                <?php echo ($livro['arquivado'] == 1) ? "Desarquivar" : "Arquivar"; ?>
            </a>
        </div>

    </div>

        
    </main>

</div>



