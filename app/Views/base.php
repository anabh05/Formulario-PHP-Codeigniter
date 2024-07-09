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
    // CONEXION BBDD
    $servername = "localhost";
    $username = "ana_nuevo";
    $password = "root";
    $dbname = "users";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully!<br>";

    // FORMULARIO
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

    $query = "SELECT name FROM user";
    $result = $conn->query($query);

    echo "<h1>Listado de Usuarios</h1>";
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "<p>Nombre: " . $row["name"] . "</p>";
        }
    } else {
        echo "No se encontraron usuarios.";
    }

    $conn->close();
    ?>
 </body>

 </html>