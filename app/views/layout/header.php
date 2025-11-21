<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi ---- PHP ----- JAVA' ?></title>

    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <script defer src="../../public/js/app.js"></script>
</head>

<body class="bg-light">

<?php if (isset($_SESSION['user'])): ?>
<nav class="navbar navbar-dark bg-primary p-3">
    <a class="navbar-brand" href="/usuario/index">CRUD PHP MVC</a>
    <div class="d-flex align-items-center">
        <span class="text-white me-3">
            Hola, <?= e($_SESSION['user']['nombre']) ?>
        </span>

        <a href="/auth/logout" class="btn btn-outline-light">
            Cerrar sesión
        </a>
    </div>
</nav>
<?php endif; ?>

<?php if ($msg = Session::flash('success')): ?>
    <div class="alert alert-success text-center m-0 p-2">
        <?= e($msg) ?>
    </div>
<?php endif; ?>

<?php if ($msg = Session::flash('error')): ?>
    <div class="alert alert-danger text-center m-0 p-2">
        <?= e($msg) ?>
    </div>
<?php endif; ?>

<div class="container mt-4">
