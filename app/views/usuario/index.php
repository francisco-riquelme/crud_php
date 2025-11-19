

<h1 class="text-primary mb-4">Usuarios</h1>

<?php if ($msg = Session::flash('success')): ?>
<div class="alert alert-success"><?= $msg ?></div>
<?php endif; ?>

<a href="/usuario/create" class="btn btn-success mb-3">➕ Crear Usuario</a>

<table class="table table-striped">
    <thead>
        <tr class="table-dark">
            <th>ID</th><th>Nombre</th><th>Email</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>

            <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No hay usuarios registrados.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['nombre'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td>
                            <a href="/usuario/edit/<?= $u['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                            <a href="/usuario/delete/<?= $u['id'] ?>" class="btn btn-danger btn-sm">🗑 Eliminar</a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

    </tbody>
</table>
