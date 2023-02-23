<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<?php
    $conn = mysqli_connect("localhost", "root", "","rubrica")
    or die("Errore: ".mysqli_connect_error());
    $query = "SELECT * FROM rubrica";
    $res = mysqli_query($conn, $query);
?>
<body>
<div class="container-xl">
<h1>Agendona</h1>

<?php if($res): ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Aggiungi utente
    </button>

    <table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Cognome</th>
        <th scope="col">Elimina</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($res)): ?>
    <tr>
        <form method="POST" action="delete.php">
        <th scope="row"><?php echo $row["id"] ?></th>
        <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
        <td><?php echo $row["nome"] ?></td>
        <td><?php echo $row["cognome"] ?></td>
        <td><button class="btn btn-danger" type="submit">Elimina</td>
        </form>
    </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
    </div>
<?php else: ?>
    <h1>Nessuna riga presente</h1>
<?php endif; ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiunta utenti</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addForm" method="POST" action="add.php">
            <input class="form-control mb-6" type="text" name="nome" placeholder="Nome">
            <input class="form-control" type="text" name="cognome" placeholder="Cognome">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        <button type="submit" form="addForm" class="btn btn-primary">Aggiungi</button>
      </div>
    </div>
  </div>
</div>


</body>

</html>