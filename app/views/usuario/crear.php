<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>

    <!-- Bootstrap -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">

    <h2 class="mb-4 text-primary">Crear Usuario</h2>

    <form action="/usuario/store" method="POST">
        <input type="hidden" name="csrf_token" value="<?= e(Csrf::generateToken()) ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        


        <button class="btn btn-success w-100">Crear Usuario</button>

    </form>

</div>


</body>
</html>
