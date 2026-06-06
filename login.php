<?php
require_once 'classes/Session.php';
require_once 'classes/User.php';

Session::start();

if (Session::isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$greska = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $korisnik = $user->login($_POST['email'], $_POST['lozinka']);
    
    if ($korisnik) {
        Session::set('korisnik_id', $korisnik['id']);
        Session::set('korisnik_ime', $korisnik['ime']);
        Session::set('korisnik_uloga', $korisnik['uloga']);
        header("Location: index.php");
        exit();
    } else {
        $greska = "Pogrešan email ili lozinka!";
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>🏫 Sportska Oprema - Prijava</h4>
                </div>
                <div class="card-body">
                    <?php if ($greska): ?>
                        <div class="alert alert-danger"><?= $greska ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lozinka</label>
                            <input type="password" name="lozinka" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Prijavi se</button>
                    </form>
                    
                    <hr>
                    <p class="text-center">Nemate nalog? 
                        <a href="register.php">Registrujte se</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>