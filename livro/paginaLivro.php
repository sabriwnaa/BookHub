
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro</title>
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
      <a href="../index.php" class="btnVerTodos">Ver todos</a>
    </header>

    


    <main class="mainLivro">
    <?php
    if(isset($_GET)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "bookhub");
        $idLivro = $_GET['idLivro'];
        
        
    
        $queryLivro = "SELECT * FROM `livro` WHERE id = ".$idLivro.";";
        $resultadoLivro = $db->query($queryLivro);

        $livro = $resultadoLivro->fetch_array();


        //query para testar se existe empréstimo com o id do livro
        $queryTesteEmprestimo = "SELECT COUNT(*) FROM emprestimo WHERE idLivro = ".$idLivro.";";
        $resultadoTesteEmprestimo = $db->query($queryTesteEmprestimo);

        $testeEmprestimo = $resultadoTesteEmprestimo->fetch_array()[0];
       
        if($testeEmprestimo > 0){
            $statusEmprestimo = true;
        }else{
            $statusEmprestimo = false;
        }


        //query para pegar emprestimo
        if($statusEmprestimo){
        $queryEmprestimo = "SELECT * FROM emprestimo WHERE idLivro = ".$idLivro.";";
        $resultadoEmprestimo = $db->query($queryEmprestimo);

        $emprestimo = $resultadoEmprestimo->fetch_array();

        $nomePessoa = $emprestimo['nomePessoa'];
        $emailPessoa = $emprestimo['emailPessoa'];
        $dataEmprestimo = $emprestimo['dataEmprestimo'];
        

        // Fecha a conexão com o banco de dados
        $db->close();
        }
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
            <p>Arquivado: 
                <?php  
            
                    if ($livro['arquivado'] == 1){
                        echo "Arquivado";
                    }else{
                        echo "Não arquivado";
                    };
                ?>
            </p>
            <p>Emprestado:
            <?php 
                if ($statusEmprestimo == false){
                    echo "livre";
                }else{
                    echo "emprestado";
                }; 
            ?></p>
            
            
        </div>
        <div class="infoFooter">
            
                
            <a href="formEditLivro.php?idLivro=<?php echo $livro['id']; ?>">Editar</a>

            <?php
                if ($statusEmprestimo  == false) {
                    
                    $idLivro = $livro['id'];
                    $status = ($livro['arquivado'] == 1) ? 0 : 1;
                    $texto = ($livro['arquivado'] == 1) ? 'Desarquivar' : 'Arquivar';

                    echo "<a href='arquivarLivro.php?idLivro=$idLivro&status=$status'>$texto</a>";
                }
            ?>

            <?php
            
                if ($livro['arquivado'] == 0) {
                    
                    
                    if ($statusEmprestimo == true && isset($emprestimo)) {
                        $nomePessoa = $emprestimo['nomePessoa'];
                        $emailPessoa = $emprestimo['emailPessoa'];
                    
                        echo "<a href='../emprestimo/devolverLivro.php?idLivro=$idLivro'>Devolver</a>";
                        echo "<p>Emprestado para: ".$nomePessoa."</p>";
                        echo "<p>Email: ".$emailPessoa."</p>";
                        echo "<p>Data do emprestimo: ".$dataEmprestimo."</p>";
                    } else {
                        echo "<a href='../emprestimo/formEmprestarLivro.php?idLivro=$idLivro'>Emprestar</a>";
                    }
                    
                    

                  
                }
            ?>


            </a>
        </div>

    </div>

        
    </main>

</div>
</body>
</html>





