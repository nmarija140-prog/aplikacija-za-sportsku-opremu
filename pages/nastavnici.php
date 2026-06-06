<?php
require_once '../classes/Session.php';
require_once '../classes/Nastavnici.php';

Session::start();
Session::requireLogin();

$nastavnici = new Nastavnici();
$sviNastavnici = $nastavnici->read();

$poruka = '';

if (isset($_GET['delete'])) {
    $nastavnici->delete($_GET['delete']);
    header("Location: nastavnici.php?uspeh=obrisano");
    exit();
}

if (isset($_GET['uspeh'])) {
    if ($_GET['uspeh'] == 'dodato') $poruka = '✅ Nastavnik uspešno dodat!';
    if ($_GET['uspeh'] == 'izmenjeno') $poruka = '✅ Nastavnik uspešno izmenjen!';
    if ($_GET['uspeh'] == 'obrisano') $poruka = '🗑️ Nastavnik uspešno obrisan!';
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Nastavnici</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="../index.php">🏫 Sportska Oprema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="oprema.php">Oprema</a></li>
                <li class="nav-item"><a class="nav-link active" href="nastavnici.php">Nastavnici</a></li>
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
        <?php if ($poruka): ?>
    <div class="alert alert-success"><?= $poruka ?></div>
<?php endif; ?>
        <div class="col">
            <h2>👨‍🏫 Evidencija Nastavnika</h2>
        </div>
        <div class="col text-end">
            <a href="nastavnici_forma.php" class="btn btn-success">+ Dodaj nastavnika</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Predmet</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sviNastavnici as $n): ?>
                <tr>
                    <td><?= $n['id'] ?></td>
                    <td><?= $n['ime'] ?></td>
                    <td><?= $n['prezime'] ?></td>
                    <td><?= $n['email'] ?></td>
                    <td><?= $n['telefon'] ?></td>
                    <td><?= $n['predmet'] ?></td>
                    <td>
                        <a href="nastavnici_forma.php?id=<?= $n['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="nastavnici.php?delete=<?= $n['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati?')">🗑️</a>
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