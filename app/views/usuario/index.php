<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary">Usuarios</h1>

        <a href="/usuario/create" class="btn btn-success">
            ➕ Crear Usuario
        </a>
    </div>

    <table class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th width="180">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        No hay usuarios registrados.
                    </td>
                </tr>

            <?php else: ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= e($u['id']) ?></td>
                        <td><?= e($u['nombre']) ?></td>
                        <td><?= e($u['email']) ?></td>
                        <td>
                            <a href="/usuario/edit/<?= e($u['id']) ?>" 
                               class="btn btn-warning btn-sm">
                               ✏️ Editar
                            </a>

                            <form action="/usuario/delete/<?= e($u['id']) ?>" method="POST" class="d-inline">
                                <input type="hidden" name="csrf_token" value="<?= e(Csrf::generateToken()) ?>">
                                
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Realmente deseas eliminar este usuario?');">
                                    🗑 Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
    </table>

</div>
