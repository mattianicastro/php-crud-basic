<?php 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        header('Location: index.php');
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "","rubrica")
    or die("Errore: ".mysqli_connect_error());

    $query = "DELETE FROM rubrica WHERE id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "s", $id);
    mysqli_stmt_execute($statement);
    header('Location: index.php');
?>