<?php 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: tabella.php');
        exit;
    }

    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['cognome'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
    } else {
        header('Location: tabella.php');
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "","agenda")
    or die("Errore: ".mysqli_connect_error());

    $query = "UPDATE rubrica SET nome = ?, cognome = ? WHERE id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ssi", $nome, $cognome, $id);
    mysqli_stmt_execute($statement);
    header('Location: tabella.php');
?>