<?php
require_once '../classes/Session.php';
require_once '../classes/Odrzavanje.php';
require_once '../classes/Oprema.php';

Session::start();
Session::requireLogin();

$odrzavanje = new Odrzavanje();
$oprema = new Oprema();
$svaOprema = $oprema->read();

$podaci = ['oprema_id' => '', 'datum_prepravke' => '', 'opis_rada' => '', 'troskovi' => '', 'serviser' => ''];
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $podaci = $odrzavanje->read($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id']) {
        $odrzavanje->update($_POST['id'], $_POST);
    } else {
        $odrzavanje->create($_POST);
    }
   $akcija = isset($_POST['id']) && $_POST['id'] ? 'izmenjeno' : 'dodato';
header("Location: odrzavanje.php?uspeh=" . $akcija);
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Održavanje - Forma</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4><?= $id ? '✏️ Izmeni održavanje' : '➕ Dodaj održavanje' ?></h4>
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
                            <label class="form-label">Datum prepravke</label>
                            <input type="date" name="datum_servisa" class="form-control" value="<?= $podaci['datum_prepravke'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opis rada</label>
                            <textarea name="opis_rada" class="form-control" rows="3"><?= $podaci['opis_rada'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Troškovi (RSD)</label>
                            <input type="number" name="troskovi" class="form-control" step="0.01" value="<?= $podaci['troskovi'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Serviser</label>
                            <input type="text" name="servisor" class="form-control" value="<?= $podaci['serviser'] ?>">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger">Sačuvaj</button>
                            <a href="odrzavanje.php" class="btn btn-secondary">Otkaži</a>
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