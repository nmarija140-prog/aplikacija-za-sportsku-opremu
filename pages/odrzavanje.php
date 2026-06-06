<?php
require_once '../classes/Session.php';
require_once '../classes/Odrzavanje.php';

Session::start();
Session::requireLogin();

$odrzavanje = new Odrzavanje();
$svoOdrzavanje = $odrzavanje->read();

if (isset($_GET['delete'])) {
    $odrzavanje->delete($_GET['delete']);
    header("Location: odrzavanje.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Održavanje</title>
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
                <li class="nav-item"><a class="nav-link" href="zaduzenja.php">Zaduženja</a></li>
                <li class="nav-item"><a class="nav-link active" href="odrzavanje.php">Održavanje</a></li>
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
            <h2>🔧 Evidencija Održavanja</h2>
        </div>
        <div class="col text-end">
            <a href="odrzavanje_forma.php" class="btn btn-success">+ Dodaj održavanje</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Oprema</th>
                    <th>Datum prepravke</th>
                    <th>Opis rada</th>
                    <th>Troškovi</th>
                    <th>Serviser</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($svoOdrzavanje as $o): ?>
                <tr>
                    <td><?= $o['id'] ?></td>
                    <td><?= $o['oprema'] ?></td>
                    <td><?= $o['datum_prepravke'] ?></td>
                    <td><?= $o['opis_rada'] ?></td>
                    <td><?= number_format($o['troskovi'], 2) ?> RSD</td>
                    <td><?= $o['serviser'] ?></td>
                    <td>
                        <a href="odrzavanje_forma.php?id=<?= $o['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="odrzavanje.php?delete=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati?')">🗑️</a>
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