<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body text-center">

                <h2>Bienvenido</h2>

                <a href="<?= base_url('register') ?>" class="btn btn-primary">Register</a>
                <a href="<?= base_url('login') ?>" class="btn btn-primary">Login</a>
            </div>

        </div>
    </div>

    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>