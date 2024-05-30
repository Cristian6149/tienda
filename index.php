<!DOCTYPE html>
<html>
<head>
    <title>Página PHP Simple</title>
</head>
<body>
    <h1>examen</h1>
    
    <?php
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "mi_base_de_datos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Crear tabla de usuarios si no existe
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50),
        email VARCHAR(50)
    )";

    if ($conn->query($sql) === FALSE) {
        echo "Error al crear la tabla: " . $conn->error;
    } else {
        echo "Tabla de usuarios creada exitosamente.<br>";
    }

    // Insertar datos de ejemplo
    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('Juan Pérez', 'juan@example.com'), ('María García', 'maria@example.com')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos de ejemplo insertados en la tabla.<br>";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    // Mostrar datos de la tabla
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Usuarios registrados:</h2>";
        echo "<table><tr><th>ID</th><th>Nombre</th><th>Email</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["nombre"]. "</td><td>" . $row["email"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }

    // Cerrar conexión
    $conn->close();
?>
</body>
</html>