<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="<?= base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="container-fluid custom-container d-flex justify-content-center align-items-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card p-4 justify-content-center">
                <h1 class="text-center mb-4">Bienvenido</h1>
                <div class="embed-responsive embed-responsive-16by9 mb-3 d-flex justify-content-center align-items-center">
                    <?php $video_id = session()->get('video_id', 'UJ0Z8JBFIYw'); ?>
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $video_id; ?>" allowfullscreen></iframe>
                </div>

                <!-- ACTUALIZAR VIDEO -->
                <form action="<?= base_url('landing/updateVideo') ?>" method="post">
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Nuevo Enlace del Video:</label>
                        <input type="text" class="form-control" id="video_url" name="video_url" placeholder="https://www.youtube.com/embed/UJ0Z8JBFIYw" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="update_video">Actualizar Video</button>
                </form>

                <!-- EDITAR USUARIO -->
                <form method="post" action="<?= base_url('edit') ?>">
                    <button type="submit" class="btn btn-danger w-100 mt-3" name="logout">Editar usuario</button>
                </form>

                <!-- CERRAR SESIÓN -->
                <form method="post" action="<?= base_url('logout') ?>">
                    <button type="submit" class="btn btn-danger w-100 mt-3" name="logout">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>