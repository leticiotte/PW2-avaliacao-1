<?php
function guidv4($data = null)
{
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

if (isset($_REQUEST["submit"]) && $_REQUEST["submit"] != "Excluir") {
    if (isset($_REQUEST["title"]) && !empty($_REQUEST["title"]))
        $title = $_REQUEST["title"];
    else {
        header("refresh:5;url=index.php");
        die("Título não informado ou vazio! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["author"]) && !empty($_REQUEST["author"]))
        $author = $_REQUEST["author"];
    else {
        header("refresh:5;url=index.php");
        die("Autor não informado ou vazio! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["year"]) && !empty($_REQUEST["year"]))
        $year = $_REQUEST["year"];
    else {
        header("refresh:5;url=index.php");
        die("Ano de publicação não informado ou vazio! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["publishingCompany"]) && !empty($_REQUEST["publishingCompany"]))
        $publishingCompany = $_REQUEST["publishingCompany"];
    else {
        header("refresh:5;url=index.php");
        die("Editora não informada ou vazia! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["genre"]) && !empty($_REQUEST["genre"]))
        $genre = $_REQUEST["genre"];
    else {
        header("refresh:5;url=index.php");
        die("Gênero não informado ou vazio! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["type"]) && !empty($_REQUEST["type"]))
        $type = $_REQUEST["type"];
    else {
        header("refresh:5;url=index.php");
        die("Tipo do livro não informado ou vazi! Você será redirecionado, aguarde...");
    }

    if (isset($_REQUEST["synopsis"]) && !empty($_REQUEST["synopsis"]))
        $synopsis = $_REQUEST["synopsis"];
    else {
        header("refresh:5;url=index.php");
        die("Sinopse não informada ou vazia! Você será redirecionado, aguarde...");
    }
}


$id = guidv4();

$submit = $_REQUEST["submit"];
$nomeArquivoDatabase = "/Applications/XAMPP/xamppfiles/htdocs/pw2/avaliacao1/database.txt";
$books = [];
if (file_exists($nomeArquivoDatabase)) {
    $booksJson = file_get_contents($nomeArquivoDatabase);
    $books = json_decode($booksJson);
}

if ($submit == "Enviar") {
    array_push($books, [
        "id" => $id,
        "title" => $title,
        "author" => $author,
        "year" => $year,
        "publishingCompany" => $publishingCompany,
        "genre" => $genre,
        "type" => $type,
        "synopsis" => $synopsis
    ]);

    $booksJson = json_encode($books);
    file_put_contents($nomeArquivoDatabase, $booksJson);
    echo "<h1>Cadastrado com sucesso!</h1>";
    echo "<h2>Você será redirecionado, aguarde...</h2>";

    header("refresh:3;url=index.php");
} elseif ($submit == "Salvar edições") {
    if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"]))
        $bookIdForEdit = $_REQUEST["id"];
    else {
        header("refresh:5;url=index.php");
        die("Id do livro para ser editado não informado! Você será redirecionado, aguarde...");
    }

    foreach ($books as $bookId => $book) {
        if ($book->id == $bookIdForEdit) {
            unset($books[$bookId]);
            break;
        }
    }

    array_unshift($books, [
        "id" => $bookIdForEdit,
        "title" => $title,
        "author" => $author,
        "year" => $year,
        "publishingCompany" => $publishingCompany,
        "genre" => $genre,
        "type" => $type,
        "synopsis" => $synopsis
    ]);

    $booksJson = json_encode($books);
    file_put_contents($nomeArquivoDatabase, $booksJson);
    echo "<h1>Livro editado com sucesso!</h1>";
    echo "<h2>Você será redirecionado, aguarde...</h2>";
    header("refresh:3;url=index.php");
} else {
    if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"]))
        $bookIdForEdit = $_REQUEST["id"];
    else {
        header("refresh:5;url=index.php");
        die("Id do livro para ser editado não informado! Você será redirecionado, aguarde...");
    }
    foreach ($books as $bookId => $book) {
        if ($book->id == $bookIdForEdit) {
            unset($books[$bookId]);
            break;
        }
    }
    $booksJson = json_encode($books);
    file_put_contents($nomeArquivoDatabase, $booksJson);
    echo "<h1>Livro deletado com sucesso!</h1>";
    echo "<h2>Você será redirecionado, aguarde...</h2>";
    header("refresh:3;url=index.php");
}
