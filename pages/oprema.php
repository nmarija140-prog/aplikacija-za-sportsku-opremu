<?php
require_once '../classes/Session.php';
require_once '../classes/Oprema.php';

Session::start();
Session::requireLogin();

$oprema = new Oprema();
$svaOprema = $oprema->read();

// Brisanje
if (isset($_GET['delete'])) {
    $oprema->delete($_GET['delete']);
    header("Location: oprema.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Oprema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../index.php">🏫 Sportska Oprema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="oprema.php">Oprema</a></li>
                <li class="nav-item"><a class="nav-link" href="nastavnici.php">Nastavnici</a></li>
                <li class="nav-item"><a class="nav-link" href="zaduzenja.php">Zaduženja</a></li>
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
            <h2>⚽ Evidencija Opreme</h2>
        </div>
        <div class="col text-end">
            <a href="oprema_forma.php" class="btn btn-success">+ Dodaj opremu</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Naziv</th>
                    <th>Tip</th>
                    <th>Količina</th>
                    <th>Stanje</th>
                    <th>Prostorija</th>
                    <th>Datum nabavke</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($svaOprema as $o): ?>
                <tr>
                    <td><?= $o['id'] ?></td>
                    <td><?= $o['naziv'] ?></td>
                    <td><?= $o['tip'] ?></td>
                    <td><?= $o['kolicina'] ?></td>
                    <td>
                        <?php
                        $badge = match($o['stanje']) {
                            'ispravna' => 'success',
                            'ostecena' => 'danger',
                            'na_servisu' => 'warning',
                            default => 'secondary'
                        };
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= $o['stanje'] ?></span>
                    </td>
                    <td><?= $o['prostorija'] ?? 'N/A' ?></td>
                    <td><?= $o['datum_nabavke'] ?></td>
                    <td>
                        <a href="oprema_forma.php?id=<?= $o['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="oprema.php?delete=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati?')">🗑️</a>
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