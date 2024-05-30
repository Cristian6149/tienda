<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "names";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesar el formulario de entrada de nombre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $sql = "INSERT INTO names (name) VALUES ('$name')";
    if ($conn->query($sql) === TRUE) {
        echo "Nombre guardado en la base de datos.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consultar los nombres guardados en la base de datos
$sql = "SELECT * FROM names";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guardar Nombre en Base de Datos</title>
</head>
<body>
    <h1>Guardar Nombre en Base de Datos</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nombre: <input type="text" name="name">
        <input type="submit" name="submit" value="Guardar">
    </form>

    <h2>Nombres Guardados:</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "- " . $row["name"] . "<br>";
        }
    } else {
        echo "No se han guardado nombres.";
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>