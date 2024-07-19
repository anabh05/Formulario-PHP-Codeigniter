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

        <!-- Mensajes de éxito o error -->
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

        <?php if (isset($user) && $user !== null) : ?>
            <form action="<?= base_url('edit-users') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= esc($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                </div>
                <!-- Si necesitas manejar contraseñas, añade el campo de contraseña, pero ten en cuenta la seguridad -->
                <!-- <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div> -->
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                No se pudieron cargar los datos del usuario.
            </div>
        <?php endif; ?>

        <a href="<?= base_url('landing') ?>" class="btn btn-secondary mt-3">Cancelar</a>
    </div>
    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>