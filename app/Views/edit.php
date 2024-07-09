<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">

        <div class="col-12 col-sm-8 col-md-6 col-lg-4">

            <div class="card-header text-center">
                <h2>Actualiza tus datos</h2>
            </div>

            <?php if (isset($message)) : ?>
                <div class="alert alert-success">
                    <?= esc($message) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('edit-users') ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?= esc($userData['name']) ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= esc($userData['email']) ?>">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>

            </form>

        </div>

    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>