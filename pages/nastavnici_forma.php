<?php
require_once '../classes/Session.php';
require_once '../classes/Nastavnici.php';

Session::start();
Session::requireLogin();

$nastavnici = new Nastavnici();
$podaci = ['ime' => '', 'prezime' => '', 'email' => '', 'telefon' => '', 'predmet' => ''];
$id = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $podaci = $nastavnici->read($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id']) {
        $nastavnici->update($_POST['id'], $_POST);
    } else {
        $nastavnici->create($_POST);
    }
    header("Location: nastavnici.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Nastavnici - Forma</title>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4><?= $id ? '✏️ Izmeni nastavnika' : '➕ Dodaj nastavnika' ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ime</label>
                                <input type="text" name="ime" class="form-control" value="<?= $podaci['ime'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prezime</label>
                                <input type="text" name="prezime" class="form-control" value="<?= $podaci['prezime'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $podaci['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="telefon" class="form-control" value="<?= $podaci['telefon'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Predmet</label>
                            <input type="text" name="predmet" class="form-control" value="<?= $podaci['predmet'] ?>">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Sačuvaj</button>
                            <a href="nastavnici.php" class="btn btn-secondary">Otkaži</a>
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