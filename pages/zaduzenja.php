<?php
require_once '../classes/Session.php';
require_once '../classes/Zaduzenja.php';

Session::start();
Session::requireLogin();

$zaduzenja = new Zaduzenja();
$svaZaduzenja = $zaduzenja->read();

if (isset($_GET['delete'])) {
    $zaduzenja->delete($_GET['delete']);
    header("Location: zaduzenja.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Zaduženja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../index.php">🏫 Sportska Oprema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="oprema.php">Oprema</a></li>
                <li class="nav-item"><a class="nav-link" href="nastavnici.php">Nastavnici</a></li>
                <li class="nav-item"><a class="nav-link active" href="zaduzenja.php">Zaduženja</a></li>
                <li class="nav-item"><a class="nav-link" href="odrzavanje.php">Održavanje</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="../odjava.php">Odjavi se</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col">
            <h2>📋 Evidencija Zaduženja</h2>
        </div>
        <div class="col text-end">
            <a href="zaduzenja_forma.php" class="btn btn-success">+ Dodaj zaduženje</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Oprema</th>
                    <th>Nastavnik</th>
                    <th>Datum zaduženja</th>
                    <th>Datum vraćanja</th>
                    <th>Napomena</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($svaZaduzenja as $z): ?>
                <tr>
                    <td><?= $z['id'] ?></td>
                    <td><?= $z['oprema'] ?></td>
                    <td><?= $z['ime'] . ' ' . $z['prezime'] ?></td>
                    <td><?= $z['datum_zaduzenja'] ?></td>
                    <td><?= $z['datum_vracanja'] ?? 'Nije vraćeno' ?></td>
                    <td><?= $z['napomena'] ?></td>
                    <td>
                        <a href="zaduzenja_forma.php?id=<?= $z['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="zaduzenja.php?delete=<?= $z['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati?')">🗑️</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>