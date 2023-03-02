<?php 
    require 'db.php';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: tabella.php');
        exit;
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        header('Location: tabella.php');
        exit;
    }

    $query = "DELETE FROM rubrica WHERE id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param("i", $id);
    $statement->execute();

    header('Location: tabella.php');
?>