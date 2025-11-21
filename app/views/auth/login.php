
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

<div class="container mt-5" style="max-width: 450px;">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>

    <form action="/auth/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= e(Csrf::generateToken()) ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" id="email"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ingresar</button>

    </form>
</div>
