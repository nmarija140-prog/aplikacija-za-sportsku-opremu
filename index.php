<?php
require_once 'classes/Session.php';
require_once 'classes/Oprema.php';
require_once 'classes/Nastavnici.php';
require_once 'classes/Zaduzenja.php';
require_once 'classes/Odrzavanje.php';

Session::start();
Session::requireLogin();

$oprema = new Oprema();
$nastavnici = new Nastavnici();
$zaduzenja = new Zaduzenja();
$odrzavanje = new Odrzavanje();

$brojOprema = count($oprema->read());
$brojNastavnika = count($nastavnici->read());
$brojZaduzenja = count($zaduzenja->read());
$brojOdrzavanja = count($odrzavanje->read());
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

  <div class="row mt-4 justify-content-center">
    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <img src="images/oprema.svg" alt="Oprema" style="width:100%;height:180px;object-fit:contain;background:#f8f9fa;padding:10px;">
            <div class="card-body text-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px;height:50px;font-size:1.4rem;margin-top:-25px;">
                    <?= $brojOprema ?>
                </div>
                <h5 class="card-title fw-bold"> OPREMA</h5>
                <a href="pages/oprema.php" class="btn btn-primary w-100">Pregledaj</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <img src="images/nastavnik.svg" alt="Nastavnici" style="width:100%;height:180px;object-fit:contain;background:#f8f9fa;padding:10px;">
            <div class="card-body text-center">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px;height:50px;font-size:1.4rem;margin-top:-25px;">
                    <?= $brojNastavnika ?>
                </div>
                <h5 class="card-title fw-bold"> NASTAVNICI</h5>
                <a href="pages/nastavnici.php" class="btn btn-success w-100">Pregledaj</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <img src="images/zaduzenje.svg" alt="Zaduženja" style="width:100%;height:180px;object-fit:contain;background:#f8f9fa;padding:10px;">
            <div class="card-body text-center">
                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px;height:50px;font-size:1.4rem;margin-top:-25px;">
                    <?= $brojZaduzenja ?>
                </div>
                <h5 class="card-title fw-bold"> ZADUŽENJA</h5>
                <a href="pages/zaduzenja.php" class="btn btn-warning w-100">Pregledaj</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <img src="images/odrzavanje.svg" alt="Održavanje" style="width:100%;height:180px;object-fit:contain;background:#f8f9fa;padding:10px;">
            <div class="card-body text-center">
                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width:50px;height:50px;font-size:1.4rem;margin-top:-25px;">
                    <?= $brojOdrzavanja ?>
                </div>
                <h5 class="card-title fw-bold"> ODRŽAVANJE</h5>
                <a href="pages/odrzavanje.php" class="btn btn-danger w-100">Pregledaj</a>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>