<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-primary mb-4">Editar Usuario</h1>

    <form action="/usuario/update/<?= e($usuario['id']) ?>" method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="csrf_token" value="<?= e(Csrf::generateToken()) ?>">

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" value="<?= e($usuario['nombre']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="<?= e($usuario['email']) ?>" class="form-control" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="/usuario/index" class="btn btn-secondary">Cancelar</a>

    </form>

</div>

</body>
</html>
