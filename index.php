<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Página Inicial</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .containerFiltro {
            position: relative;
            display: inline-block;
        }
        .filtro-container {
            position: absolute;
            top: 100%; /* Ajusta a posição para ficar logo abaixo do botão */
            left: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            padding: 10px;
            display: none;
            z-index: 1000; /* Garante que o menu de filtro fique acima de outros elementos */
        }
        .filtro-container label {
            margin-bottom: 5px;
            display: block;
        }
        .filtro-container select {
            margin-bottom: 10px;
            width: 100%;
        }
        .filtro-container button {
            display: block;
            width: 100%;
            background-color: #0081CF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .filtro-container button:hover {
            background-color: #005f8a;
        }
    </style>
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
            <input class="inputPesquisar" type="text" placeholder="Pesquisar...">
            <img class="loupe" src="image/loupe.png" alt="">
        </div>

        <div class="containerFiltro">
            <button class="btnFiltro" type="button" onclick="toggleFiltro()">
                <img class="imgFilter" src="image/filterLinesW.png" alt="">
            </button>

            <div id="filtroDropdown" class="filtro-container">
                <form method="GET" action="index.php">
                    <!-- Filtro por arquivação -->
                    <label for="arquivado">Arquivado:</label>
                    <select id="arquivado" name="arquivado">
                        <option value="todos">Arquivados e não arquivados</option>
                        <option value="0">Não arquivados</option>
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
                        $queryAutor = "SELECT id, nome FROM autor;";
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

            // Filtros
            $arquivado = isset($_GET['arquivado']) ? $_GET['arquivado'] : 'todos';
            $emprestado = isset($_GET['emprestado']) ? $_GET['emprestado'] : 'todos';
            $autor = isset($_GET['autor']) ? $_GET['autor'] : 'todos';
            $ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'titulo_asc';

            // Construção da query
            $query = "SELECT id, capa FROM livro WHERE 1=1";

            // Filtro por arquivado
            if ($arquivado != 'todos') {
                $query .= " AND arquivado = $arquivado";
            }

            // Filtro por emprestado
            if ($emprestado != 'todos') {
                $query .= " AND emprestado = $emprestado";
            }

            // Filtro por autor
            if ($autor != 'todos') {
                $query .= " AND idAutor = $autor";
            }

            // Ordenação
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

                    echo "<a href='livro/paginaLivro.php?idLivro={$row['id']}'>";
                    echo "<img class='capa' src='$caminhoImagem' alt='Capa do Livro'>";
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
                <a href="livro/formAddLivro.php" class='item'>L</a>
                <a href="autor/formAddAutor.php" class='item'>A</a>
            </div>
        </div>
    </main>

    <script>
        const menu = document.querySelector('.floating_item')
        const filtroDropdown = document.getElementById('filtroDropdown')

        function toggleFiltro() {
            filtroDropdown.style.display = filtroDropdown.style.display === 'none' ? 'flex' : 'none';
        }

        menu.onclick = () => menu.classList.toggle('active')
    </script>

    <footer>
        informações do site
    </footer>
</div>
</body>
</html>
