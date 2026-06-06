<?php
require_once 'classes/Session.php';
require_once 'classes/User.php';

Session::start();

if (Session::isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$greska = '';
$uspeh = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    
    if ($user->emailPostoji($_POST['email'])) {
        $greska = "Email već postoji!";
    } elseif ($_POST['lozinka'] !== $_POST['lozinka_potvrda']) {
        $greska = "Lozinke se ne poklapaju!";
    } else {
        if ($user->register($_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['lozinka'])) {
            $uspeh = "Registracija uspešna! Možete se prijaviti.";
        } else {
            $greska = "Greška pri registraciji!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
    <div class="card shadow">
        <div class="card-header text-white text-center" style="background-color: #7B5EA7;">
                    <h4>🏫 Sportska Oprema - Registracija</h4>
                </div>
                <div class="card-body">
                    <?php if ($greska): ?>
                        <div class="alert alert-danger"><?= $greska ?></div>
                    <?php endif; ?>
                    <?php if ($uspeh): ?>
                        <div class="alert alert-success"><?= $uspeh ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ime</label>
                                <input type="text" name="ime" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prezime</label>
                                <input type="text" name="prezime" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lozinka</label>
                            <input type="password" name="lozinka" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Potvrdi lozinku</label>
                            <input type="password" name="lozinka_potvrda" class="form-control" required>
                        </div>
                       <button type="submit" class="btn w-100 text-white" style="background-color: #0D47A1 ;">Registruj se</button>
                    </form>

                    <hr>
                    <p class="text-center">Već imate nalog? 
                        <a href="login.php">Prijavite se</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>