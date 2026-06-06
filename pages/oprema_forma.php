<?php
require_once '../classes/Session.php';
require_once '../classes/Oprema.php';
require_once '../classes/Database.php';

Session::start();
Session::requireLogin();

$oprema = new Oprema();
$db = Database::getInstance()->getConnection();

// Dohvati prostorije za dropdown
$prostorije = $db->query("SELECT * FROM prostorije")->fetch_all(MYSQLI_ASSOC);

$podaci = ['naziv' => '', 'tip' => '', 'kolicina' => 1, 'stanje' => 'ispravna', 'prostorija_id' => '', 'datum_nabavke' => ''];
$id = null;

// Ako je edit mod
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $podaci = $oprema->read($id);
}

// Snimanje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id']) {
        $oprema->update($_POST['id'], $_POST);
    } else {
        $oprema->create($_POST);
    }
    header("Location: oprema.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Oprema - Forma</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4><?= $id ? '✏️ Izmeni opremu' : '➕ Dodaj opremu' ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Naziv</label>
                            <input type="text" name="naziv" class="form-control" value="<?= $podaci['naziv'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tip</label>
                            <input type="text" name="tip" class="form-control" value="<?= $podaci['tip'] ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Količina</label>
                                <input type="number" name="kolicina" class="form-control" value="<?= $podaci['kolicina'] ?>" min="1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stanje</label>
                                <select name="stanje" class="form-select">
                                    <option value="ispravna" <?= $podaci['stanje'] == 'ispravna' ? 'selected' : '' ?>>Ispravna</option>
                                    <option value="ostecena" <?= $podaci['stanje'] == 'ostecena' ? 'selected' : '' ?>>Oštećena</option>
                                    <option value="na_servisu" <?= $podaci['stanje'] == 'na_servisu' ? 'selected' : '' ?>>Na servisu</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prostorija</label>
                            <select name="prostorija_id" class="form-select">
                                <option value="">-- Izaberi prostoriju --</option>
                                <?php foreach ($prostorije as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= $podaci['prostorija_id'] == $p['id'] ? 'selected' : '' ?>>
                                    <?= $p['naziv'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Datum nabavke</label>
                            <input type="date" name="datum_nabavke" class="form-control" value="<?= $podaci['datum_nabavke'] ?>">
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Sačuvaj</button>
                            <a href="oprema.php" class="btn btn-secondary">Otkaži</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>