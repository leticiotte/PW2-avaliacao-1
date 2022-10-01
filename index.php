<!DOCTYPE html>
<html lang="en">
<style>
    legend {
        font-size: 20px;
    }

    fieldset {
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .row {
        padding: 30px 0px 20px 30px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 50%;
    }

    input[type=text],
    input[type=number],
    textarea,
    select {
        border-radius: 8px;
        padding: 12px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        width: 90%;
    }

    textarea {
        width: 95%;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 20%;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    label {
        padding-right: 10px;
    }

    .table {
        padding-left: 10px;
        padding-top: 12px;
    }

    table,
    td,
    th {
        border: 1px solid #ccc;
    }

    table {
        width: 100%;
        border-radius: 4px;
        border-collapse: collapse;
        border-style: hidden;
        box-shadow: 0 0 0 1px #ccc;
    }

    .btn {
        border: none;
        border-radius: 4px;
        color: white;
        padding: 5px 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .edit {
        background-color: DodgerBlue;
    }

    .edit:hover {
        background-color: RoyalBlue;
    }

    .delete {
        background-color: #ef4444;
    }

    .delete:hover {
        background-color: #b91c1c;
    }

    .actionButtons {
        text-align: center;
    }

    body {
        font-family: Verdana;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Avaliação 1</title>
</head>

<body>
    <h1>Biblioteca</h1>
    <div class="row">
        <div class="column">
            <div id="cadastro">
                <fieldset>
                    <legend>Cadastro</legend>
                    <form method="GET" action="processamento.php" name="formularioCadastro">
                        <div class="row">
                            <div class="column">
                                <label for="title">Título</label>
                                <br>
                                <input type="text" name="title" id="title" placeholder="Ex: O Hobbit" required />
                                <br>
                                <label for="author">Autor</label>
                                <br>
                                <input type="text" name="author" id="author" placeholder="Ex: J. R. R. Tolkien" required />
                                <br>
                                <label for="year">Ano de publicação</label>
                                <br>
                                <input type="number" name="year" id="year" min="0" max="2022" placeholder="Ex: 1937" required />
                                <br>
                            </div>
                            <div class=" column">
                                <label for="publishingCompany">Editora</label>
                                <br>
                                <input type="text" name="publishingCompany" id="publishingCompany" placeholder="Ex: Harper Collins" required />
                                <br>
                                <label for="genre">Gênero</label>
                                <br>
                                <select name="genre" id="genre">
                                    <option value="action">Ação</option>
                                    <option value="adventure">Aventura</option>
                                    <option value="classics">Clássico</option>
                                    <option value="fairyTale">Conto de fadas</option>
                                    <option value="fantasy">Fantasia</option>
                                    <option value="fiction">Ficção</option>
                                    <option value="romance">Romance</option>
                                    <option value="horror">Horror</option>
                                </select>
                                <br>
                                <label for="type">Tipo do livro</label>
                                <br>
                                <div>
                                    <input type="radio" id="brochure" name="type" value="brochure" checked>
                                    <label for="brochure">Brochura</label>
                                </div>

                                <div>
                                    <input type="radio" id="hardback" name="type" value="hardback">
                                    <label for="hardback">Capa dura</label>
                                </div>

                                <div>
                                    <input type="radio" id="others" name="type" value="others">
                                    <label for="others">Outros</label>
                                </div> <br>
                            </div>
                            <label for="synopsis">Sinopse</label>
                            <br>
                            <textarea id="synopsis" name="synopsis" rows="4" cols="50" required></textarea>
                        </div>

                        <input type="submit" value="Enviar" name="submit">
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="column">
            <div class="table">
                <?php
                $nomeArquivoDatabase = "/Applications/XAMPP/xamppfiles/htdocs/pw2/avaliacao1/database.txt";
                $books = [];
                if (file_exists($nomeArquivoDatabase)) {
                    $booksJson = file_get_contents($nomeArquivoDatabase);
                    $books = json_decode($booksJson);
                }

                ?>
                <table class="books">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Ano de publicação</th>
                            <th>Editora</th>
                            <th>Gênero</th>
                            <th>Tipo do livro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($books)
                            foreach ($books as $book) {
                        ?>
                            <tr>
                                <td><?php echo $book->title; ?></td>
                                <td><?php echo $book->author; ?></td>
                                <td><?php echo $book->year; ?></td>
                                <td><?php echo $book->publishingCompany; ?></td>
                                <td><?php
                                    $genre = $book->genre;
                                    switch ($genre) {
                                        case 'action':
                                            echo "Ação";
                                            break;
                                        case 'adventure':
                                            echo "Aventura";
                                            break;
                                        case 'classics':
                                            echo "Clássicos";
                                            break;
                                        case 'fairyTale':
                                            echo "Conto de fadas";
                                            break;
                                        case 'fantasy':
                                            echo "Fantasia";
                                            break;
                                        case 'fiction':
                                            echo "Ficção";
                                            break;
                                        case 'romance':
                                            echo "Romance";
                                            break;
                                        case 'horror':
                                            echo "Horror";
                                            break;
                                    }
                                    ?></td>
                                <td><?php
                                    $type = $book->type;
                                    switch ($type) {
                                        case 'brochure':
                                            echo "Brochura";
                                            break;
                                        case 'hardback':
                                            echo "Capa dura";
                                            break;
                                        case 'others':
                                            echo "Outros";
                                            break;
                                    }
                                    ?></td>
                                <td class="actionButtons">
                                    <button class="btn edit" onclick="location.href = 'editar.php?id=<?php echo $book->id; ?>';"><i class="fa fa-pencil"></i></button>
                                    <?php
                                    $id = $book->id;
                                    $title = $book->title;
                                    echo "<button class='btn delete' onclick=\"deletar('$title', '$id')\"><i class='fa fa-trash'></i></button>";
                                    ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    function deletar(title, id) {
        let text = `Deseja mesmo deletar o livro: ${title}`;
        if (confirm(text) == true) {
            window.location.href = `processamento.php?submit=Excluir&id=${id}`;
        }
    }
</script>

</html>