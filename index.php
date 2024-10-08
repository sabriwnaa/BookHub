<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Página Inicial</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container">
    <header>
        <div class="logoDiv">
            <a href="index.php" >
               <img class="logo" src="image/logo.png">
               <h1>BookHub</h1>
            </a>
        </div>
        
        <div class="pesquisar"> 
            <form method="GET" action="index.php">
                <input name="pesquisar" class="inputPesquisar" type="text" placeholder="Título do livro...">
            </form>
            <img class="loupe" src="image/loupe.png">
        </div>

        <div class="containerFiltro">
            <button class="btnFiltro" type="button" onclick="toggleFiltro()">
                <img class="imgFilter" src="image/filterLinesW.png">
            </button>

            <div id="filtroDropdown" class="filtro-container">
                <form method="GET" action="index.php">
                    <!-- Filtro por arquivação -->
                    <label for="arquivado">Arquivado:</label>
                    <select id="arquivado" name="arquivado">
                        <option value="0">Não arquivados</option>
                        <option value="todos">Arquivados e não arquivados</option>
                        <option value="1">Arquivados</option>
                    </select>

                    <!-- Filtro por status de empréstimo -->
                    <label for="emprestado">Status de Empréstimo:</label>
                    <select id="emprestado" name="emprestado">
                        <option value="todos">Emprestados e não emprestados</option>
                        <option value="0">Não emprestados</option>
                        <option value="1">Emprestados</option>
                    </select>

                    <!-- Filtro por autor -->
                    <label for="autor">Autor:</label>
                    <select id="autor" name="autor">
                        <option value="todos">Todos os autores</option>
                        <?php
                        // Conexão para pegar autores
                        $db = new mysqli("localhost", "root", "", "bookhub");
                        $queryAutor = "SELECT id, nome FROM autor WHERE arquivado = 0;";
                        $resultadoAutor = $db->query($queryAutor);
                        while ($autor = $resultadoAutor->fetch_array()) {
                            echo "<option value='" . $autor['id'] . "'>" . $autor['nome'] . "</option>";
                        }
                        ?>
                    </select>

                    <!-- Ordenar por título e ano -->
                    <label for="ordenar">Ordenar por:</label>
                    <select id="ordenar" name="ordenar">
                        <option value="titulo_asc">Título (A-Z)</option>
                        <option value="titulo_desc">Título (Z-A)</option>
                        <option value="ano_asc">Ano (mais antigo)</option>
                        <option value="ano_desc">Ano (mais recente)</option>
                    </select>

                    <button type="submit">Aplicar Filtro</button>
                </form>
            </div>
        </div>
    </header>
    
    <main>
        <div class="containerLivros">
            <?php
            // Conexão com o banco de dados
            $db = new mysqli("localhost", "root", "", "bookhub");

            $queryEmprestimos = "SELECT l.id FROM livro l WHERE l.id IN (SELECT e.idLivro FROM emprestimo e);";
            $resultadoEmprestimos = $db->query($queryEmprestimos);
            $livrosEmprestados = array();
            while ($row = $resultadoEmprestimos->fetch_assoc()) {
                $livrosEmprestados[] = $row['id'];
            }
            
// Filtros
$arquivado = isset($_GET['arquivado']) ? $_GET['arquivado'] : '0';
$emprestado = isset($_GET['emprestado']) ? $_GET['emprestado'] : 'todos';
$autor = isset($_GET['autor']) ? $_GET['autor'] : 'todos';
$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'titulo_asc';
$nomeLivro = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';

$query = "SELECT id, capa, arquivado FROM livro WHERE 1=1";

// Filtro por arquivado
if ($arquivado != 'todos') {
    $query .= " AND arquivado = $arquivado";
}

// Filtro por emprestado
if ($emprestado != 'todos') {
    if ($emprestado == '1') {
        // Livros emprestados
        $query .= " AND id IN (SELECT idLivro FROM emprestimo)";
    } else {
        // Livros não emprestados
        $query .= " AND id NOT IN (SELECT idLivro FROM emprestimo)";
    }
}

// Filtro por autor
if ($autor != 'todos') {
    $query .= " AND idAutor = $autor";
}

// Filtro por pesquisa
if (!empty($nomeLivro)) {
    $nomeLivro = mysqli_real_escape_string($db, $nomeLivro);
    $query .= " AND titulo LIKE '%{$nomeLivro}%'";
}

// Ordenação (essa parte precisa ser no final, depois de todos os filtros)
switch ($ordenar) {
    case 'titulo_asc':
        $query .= " ORDER BY titulo ASC";
        break;
    case 'titulo_desc':
        $query .= " ORDER BY titulo DESC";
        break;
    case 'ano_asc':
        $query .= " ORDER BY ano ASC";
        break;
    case 'ano_desc':
        $query .= " ORDER BY ano DESC";
        break;
}

            // Executa a query
            $resultado = $db->query($query);

            if ($resultado->num_rows > 0) {
                // Exibe os livros filtrados
                while ($row = $resultado->fetch_assoc()) {
                    $caminhoImagem = $row['capa'];
                    $idLivro = $row['id'];

                    //query para testar se existe empréstimo com o id do livro, para colocar a classe nele
                    $queryTesteEmprestimo = "SELECT COUNT(*) FROM emprestimo WHERE idLivro = ".$idLivro.";";
                    $resultadoTesteEmprestimo = $db->query($queryTesteEmprestimo);

                    $testeEmprestimo = $resultadoTesteEmprestimo->fetch_array()[0];
       
                    if($testeEmprestimo > 0){
                        $emprestado = true;
                    }else{
                        $emprestado = false;
                    }
                    
                    //testa se arquivado para colocar a classe e o style nele
                    if ($row['arquivado'] == 1) {
                        echo "<a href='livro/paginaLivro.php?idLivro={$row['id']}'>";
                        echo "<img class='capa arquivado' src='$caminhoImagem' alt='Capa do Livro'>";
                        echo "</a>";
                        
                    }else{
                        if($emprestado){
                            echo "<a class='ContainerLivroEmprestado' href='livro/paginaLivro.php?idLivro={$row['id']}'>";
                            echo "<img class='capa emprestado' src='$caminhoImagem''>";
                            echo "</a>";
                        }else{
                            echo "<a href='livro/paginaLivro.php?idLivro={$row['id']}'>";
                            echo "<img class='capa' src='$caminhoImagem' alt='Capa do Livro'>  </img>";
                            echo "</a>";
                        }
                        
                        
                    };
                    
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
            <div class="item floating_item" style="background-color: #ffffff; z-index: 1;">
                <p>+</p>
            </div>
            <div class="options">
                <a href="livro/formAddLivro.php" class='item'>
                    <img src="image/book.png" style=" width: 30px;">
                </a>
                <a href="autor/formAddAutor.php" class='item'>
                    <img src="image/author.png" style=" width: 30px;">
                </a>
            </div>
        </div>
    </main>

    
    <script>
        const menu = document.querySelector('.floating_item')
        const filtroDropdown = document.getElementById('filtroDropdown')
        function toggleFiltro() {
        filtroDropdown.style.display = filtroDropdown.style.display === 'none' || filtroDropdown.style.display === '' ? 'block' : 'none';
    }
        menu.onclick = () => menu.classList.toggle('active')
    </script>

    <?php include 'footer.php';?>
</div>
</body>
</html>
