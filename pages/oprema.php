<?php
require_once '../classes/Session.php';
require_once '../classes/Oprema.php';

Session::start();
Session::requireLogin();

$oprema = new Oprema();
$svaOprema = $oprema->read();

$poruka = '';

if (isset($_GET['delete'])) {
    $oprema->delete($_GET['delete']);
    header("Location: oprema.php?uspeh=obrisano");
    exit();
}

if (isset($_GET['uspeh'])) {
    if ($_GET['uspeh'] == 'dodato') $poruka = '✅ Oprema uspešno dodata!';
    if ($_GET['uspeh'] == 'izmenjeno') $poruka = '✅ Oprema uspešno izmenjena!';
    if ($_GET['uspeh'] == 'obrisano') $poruka = '🗑️ Oprema uspešno obrisana!';
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
    <?php if ($poruka): ?>
        <div class="alert alert-success"><?= $poruka ?></div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col">
            <h2>⚽ Evidencija Opreme</h2>
        </div>
        <div class="col text-end">
           <?php if (Session::get('korisnik_uloga') === 'admin'): ?>
    <a href="oprema_forma.php" class="btn btn-success">+ Dodaj opremu</a>
<?php endif; ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="pretraga" class="form-control" placeholder="🔍 Pretraži po nazivu...">
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
                       <?php if (Session::get('korisnik_uloga') === 'admin'): ?>
    <a href="oprema_forma.php?id=<?= $o['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
    <a href="oprema.php?delete=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati?')">🗑️</a>
<?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('pretraga').addEventListener('keyup', function() {
    let vrednost = this.value.toLowerCase();
    let redovi = document.querySelectorAll('tbody tr');
    redovi.forEach(function(red) {
        let naziv = red.cells[1].textContent.toLowerCase();
        red.style.display = naziv.includes(vrednost) ? '' : 'none';
    });
});
</script>
</body>
</html>