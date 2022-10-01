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
<?php
$bookIdForEdit;
if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
    $bookIdForEdit = $_REQUEST["id"];
} else {
    header("refresh:5;url=index.php");
    die("Id não informado! Você será redirecionado, aguarde...");
}

$nomeArquivoDatabase = "/Applications/XAMPP/xamppfiles/htdocs/pw2/avaliacao1/database.txt";
$books = [];
$bookForEdit = [];

if (file_exists($nomeArquivoDatabase)) {
    $booksJson = file_get_contents($nomeArquivoDatabase);
    $books = json_decode($booksJson);
}
if (!$books) {
    header("refresh:5;url=index.php");
    die("Nenhum livro cadastrado! Você será redirecionado, aguarde...");
}

foreach ($books as $book) {
    if ($book->id == $bookIdForEdit) {
        $bookForEdit = $book;
    }
}

if (!$bookForEdit) {
    header("refresh:5;url=index.php");
    die("Livro não encontrado! Você será redirecionado, aguarde...  ");
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Avaliação 1</title>
</head>

<body>
    <h1>Biblioteca</h1>
    <div id="edicao">
        <fieldset>
            <legend>Edição</legend>
            <form method="GET" action="processamento.php" name="formularioCadastro">
                <div class="row">
                    <div class="column">
                        <label for="title">Título</label>
                        <br>
                        <input type="text" name="title" id="title" placeholder="Ex: O Hobbit" value="<?php echo $bookForEdit->title ?>" required />
                        <br>
                        <label for="author">Autor</label>
                        <br>
                        <input type="text" name="author" id="author" placeholder="Ex: J. R. R. Tolkien" value="<?php echo $bookForEdit->author ?>" required />
                        <br>
                        <label for="year">Ano de publicação</label>
                        <br>
                        <input type="number" name="year" id="year" min="0" max="2022" placeholder="Ex: 1937" value="<?php echo $bookForEdit->year ?>" required />
                        <br>
                    </div>
                    <div class=" column">
                        <label for="publishingCompany">Editora</label>
                        <br>
                        <input type="text" name="publishingCompany" id="publishingCompany" placeholder="Ex: Harper Collins" value="<?php echo $bookForEdit->publishingCompany ?>" required />
                        <br>
                        <label for="genre">Gênero</label>
                        <br>
                        <select name="genre" id="genre">
                            <option value="action" <?= $bookForEdit->genre == 'action' ? ' selected="selected"' : ''; ?>>Ação</option>
                            <option value="adventure" <?= $bookForEdit->genre == 'adventure' ? ' selected="selected"' : ''; ?>>Aventura</option>
                            <option value="classics" <?= $bookForEdit->genre == 'classics' ? ' selected="selected"' : ''; ?>>Clássico</option>
                            <option value="fairyTale" <?= $bookForEdit->genre == 'fairyTale' ? ' selected="selected"' : ''; ?>>Conto de fadas</option>
                            <option value="fantasy" <?= $bookForEdit->genre == 'fantasy' ? ' selected="selected"' : ''; ?>>Fantasia</option>
                            <option value="fiction" <?= $bookForEdit->genre == 'fiction' ? ' selected="selected"' : ''; ?>>Ficção</option>
                            <option value="romance" <?= $bookForEdit->genre == 'romance' ? ' selected="selected"' : ''; ?>>Romance</option>
                            <option value="horror" <?= $bookForEdit->genre == 'horror' ? ' selected="selected"' : ''; ?>>Horror</option>
                        </select>
                        <br>
                        <label for="type">Tipo do livro</label>
                        <br>
                        <div>
                            <input type="radio" id="brochure" name="type" value="brochure" <?= $bookForEdit->type == 'brochure' ? ' checked' : ''; ?>>
                            <label for="brochure">Brochura</label>
                        </div>

                        <div>
                            <input type="radio" id="hardback" name="type" value="hardback" <?= $bookForEdit->type == 'hardback' ? ' checked' : ''; ?>>
                            <label for="hardback">Capa dura</label>
                        </div>

                        <div>
                            <input type="radio" id="others" name="type" value="others" <?= $bookForEdit->type == 'others' ? ' checked' : ''; ?>>
                            <label for="others">Outros</label>
                        </div> <br>
                    </div>
                    <label for="synopsis">Sinopse</label>
                    <br>
                    <textarea id="synopsis" name="synopsis" rows="4" cols="50" required><?php echo $bookForEdit->synopsis ?></textarea>
                    <input type="hidden" name="id" id="id" value="<?php echo $bookForEdit->id ?>" required />

                </div>

                <input type="submit" value="Salvar edições" name="submit">
            </form>
        </fieldset>
    </div>
</body>

</html>