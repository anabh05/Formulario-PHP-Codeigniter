 <h1>Registro de Usuario</h1>
 <form method="post" action="<?php echo base_url() ?>register-users">

     <label for="name">Nombre de Usuario:</label>
     <input type="text" name="name" required /><br />

     <label for="email">Correo Electrónico:</label>
     <input type="email" name="email" required /><br />

     <label for="password">Contraseña:</label>
     <input type="password" name="password" required /><br />

     <input type="submit" name="submit" value="Register" />
 </form>

 <?php
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "ana_nuevo";
    $password = "root";
    $dbname = "users";

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully!<br>";

    // Procesamiento del formulario de registro
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Insertar datos en la base de datos
        $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso!<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Consulta SQL para obtener usuarios
    $query = "SELECT name FROM user";
    $result = $conn->query($query);

    echo "<h1>Listado de Usuarios</h1>";
    if ($result->num_rows > 0) {
        // Mostrar los datos usando un bucle while
        while ($row = $result->fetch_assoc()) {
            echo "<p>Nombre: " . $row["name"] . "</p>";
        }
    } else {
        echo "No se encontraron usuarios.";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
 </body>

 </html>