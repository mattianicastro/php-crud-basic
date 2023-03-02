<?php 
    require 'db.php';
    
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

    $query = "INSERT INTO rubrica (nome, cognome) VALUES (?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("ss", $nome, $cognome);
    $statement->execute();
    header('Location: tabella.php');
?>