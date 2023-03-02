<?php 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: tabella.php');
        exit;
    }

    if (isset($_POST['nome']) && isset($_POST['cognome'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
    } else {
        header('Location: tabella.php');
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "","agenda")
    or die("Errore: ".mysqli_connect_error());

    $query = "INSERT INTO rubrica (nome, cognome) VALUES (?, ?)";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ss", $nome, $cognome);
    mysqli_stmt_execute($statement);
    header('Location: tabella.php');
?>