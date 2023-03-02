<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<?php
    $conn = mysqli_connect("localhost", "root", "","agenda")
    or die("Errore: ".mysqli_connect_error());
    $query = "SELECT * FROM rubrica";
    $res = mysqli_query($conn, $query);
?>
<body data-bs-theme="dark" class="container-xl">
<div class="d-flex flex-column">
<h1><a href="index.html">Gestione utenti</a></h1>

<?php if($res): ?>

    <table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Cognome</th>
        <th scope="col">Azioni</th>
    </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($res)): ?>
    <tr>
        <td scope="row"><?php echo $row["id"] ?></td>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]) ?>">
        <td><?php echo htmlspecialchars($row["nome"]) ?></td>
        <td><?php echo htmlspecialchars($row["cognome"]) ?></td>
        <form action="delete.php" method="POST">
            <td><button class="btn btn-primary"
            data-bs-toggle="modal" data-bs-target="#editModal"
            data-bs-id="<?php echo htmlspecialchars($row["id"])?>"
            data-bs-nome="<?php echo htmlspecialchars($row["nome"])?>""
            data-bs-cognome="<?php echo htmlspecialchars($row["cognome"])?>"
            type="button"
            >✏️</button>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row["id"]) ?>">
            <button type="submit" class="btn btn-danger">🗑️</button>
        </form>
      </td>
    </tr>
    <?php endwhile; ?>
    </tbody>
    </table>
    </div>
<?php else: ?>
    <h1>Nessuna riga presente</h1>
<?php endif; ?>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Modifica utente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="edit.php">
            <input id="input-nome" class="form-control mb-3 bg-dark text-white" type="text" name="nome" required placeholder="Nome">
            <input id="input-cognome" class="form-control bg-dark text-white" type="text" name="cognome" required placeholder="Cognome">
            <input id="input-id" class="form-control" type="hidden" name="id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        <button type="submit" form="editForm" class="btn btn-primary">Modifica</button>
      </div>
    </div>
  </div>
</div>



</body>

<script>
const editModal = document.getElementById('editModal')
editModal.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget
  console.log(button)
  const nome = button.getAttribute('data-bs-nome')
  const cognome = button.getAttribute('data-bs-cognome')
  const id = button.getAttribute('data-bs-id')

  const inputId = editModal.querySelector('#input-id')
  const inputNome = editModal.querySelector('#input-nome')
  const inputCognome = editModal.querySelector('#input-cognome')

  inputId.value = id
  inputNome.value = nome
  inputCognome.value = cognome

})
</script>
</html>