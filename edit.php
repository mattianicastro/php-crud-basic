<?php 
    require 'db.php';

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


    $query = "UPDATE rubrica SET nome = ?, cognome = ? WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("ssi", $nome, $cognome, $id);
    $statement->execute();

    header('Location: tabella.php');
?>