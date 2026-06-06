<?php
require_once 'classes/Session.php';

Session::start();
Session::requireLogin();
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Sportska Oprema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">🏫 Sportska Oprema</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="pages/oprema.php">Oprema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/nastavnici.php">Nastavnici</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/zaduzenja.php">Zaduženja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/odrzavanje.php">Održavanje</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-white">👤 <?= Session::get('korisnik_ime') ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Odjavi se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2>Dobrodošli, <?= Session::get('korisnik_ime') ?>! 👋</h2>
            <p class="text-muted">Izaberite opciju iz menija</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">⚽ Oprema</h5>
                    <p class="card-text">Upravljanje sportskom opremom</p>
                    <a href="pages/oprema.php" class="btn btn-light">Pregledaj</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">👨‍🏫 Nastavnici</h5>
                    <p class="card-text">Evidencija nastavnika</p>
                    <a href="pages/nastavnici.php" class="btn btn-light">Pregledaj</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">📋 Zaduženja</h5>
                    <p class="card-text">Evidencija zaduženja</p>
                    <a href="pages/zaduzenja.php" class="btn btn-light">Pregledaj</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">🔧 Održavanje</h5>
                    <p class="card-text">Evidencija održavanja</p>
                    <a href="pages/odrzavanje.php" class="btn btn-light">Pregledaj</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>