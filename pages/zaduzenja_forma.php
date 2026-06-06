<?php
require_once '../classes/Session.php';
require_once '../classes/Zaduzenja.php';
require_once '../classes/Oprema.php';
require_once '../classes/Nastavnici.php';

Session::start();
Session::requireLogin();

$zaduzenja = new Zaduzenja();
$oprema = new Oprema();
$nastavnici = new Nastavnici();

$svaOprema = $oprema->read();
$sviNastavnici = $nastavnici->read();

$podaci = ['oprema_id' => '', 'nastavnik_id' => '', 'datum_zaduzenja' => '', 'datum_vracanja' => '', 'napomena' => ''];
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $podaci = $zaduzenja->read($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id']) {
        $zaduzenja->update($_POST['id'], $_POST);
    } else {
        $zaduzenja->create($_POST);
    }
    $akcija = isset($_POST['id']) && $_POST['id'] ? 'izmenjeno' : 'dodato';
header("Location: zaduzenja.php?uspeh=" . $akcija);
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Zaduženja - Forma</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4><?= $id ? '✏️ Izmeni zaduženje' : '➕ Dodaj zaduženje' ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="mb-3">
                            <label class="form-label">Oprema</label>
                            <select name="oprema_id" class="form-select" required>
                                <option value="">-- Izaberi opremu --</option>
                                <?php foreach ($svaOprema as $o): ?>
                                <option value="<?= $o['id'] ?>" <?= $podaci['oprema_id'] == $o['id'] ? 'selected' : '' ?>>
                                    <?= $o['naziv'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nastavnik</label>
                            <select name="nastavnik_id" class="form-select" required>
                                <option value="">-- Izaberi nastavnika --</option>
                                <?php foreach ($sviNastavnici as $n): ?>
                                <option value="<?= $n['id'] ?>" <?= $podaci['nastavnik_id'] == $n['id'] ? 'selected' : '' ?>>
                                    <?= $n['ime'] . ' ' . $n['prezime'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Datum zaduženja</label>
                            <input type="date" name="datum_zaduzenja" class="form-control" value="<?= $podaci['datum_zaduzenja'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Datum vraćanja</label>
                            <input type="date" name="datum_vracanja" class="form-control" value="<?= $podaci['datum_vracanja'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Napomena</label>
                            <textarea name="napomena" class="form-control" rows="3"><?= $podaci['napomena'] ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Sačuvaj</button>
                            <a href="zaduzenja.php" class="btn btn-secondary">Otkaži</a>
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