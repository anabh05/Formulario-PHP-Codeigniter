<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Perfil</h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($user)) : ?>

            <form action="<?= base_url('edit/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= esc($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <form action="<?= base_url('edit/delete') ?>" method="post" class="mt-3">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Borrar Usuario</button>
                </form>
            </form>


        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                No se puede cargar el usuario.
            </div>
        <?php endif; ?>

        <a href="<?= base_url('landing') ?>" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>