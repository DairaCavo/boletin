<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css"> <!-- Enlaza la página -->
</head>
</html>
<?php
include 'conexion.php'; // Incluye la conexión la base de datos

// Comprueba si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $departamento = $_POST['departamento'];
    $salario = $_POST['salario'];

    // Consulta SQL para insertar un nuevo empleado en la base de datos
    $sql = "INSERT INTO empleados (nombre, apellido, edad, departamento, salario) VALUES ('$nombre', '$apellido', '$edad', '$departamento', '$salario')";
    
    if ($con->query($sql) == TRUE) { // Ejecuta la consulta y verifica si se ha realizado correctamente
        echo "Nuevo empleado agregado."; // Msj de éxito
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;    // Msj de error 
    }
}
?>

<form method="post" action="agregar.php"><!-- Formulario para agregar un nuevo empleado -->
    Nombre: <input type="text" name="nombre"><br> <!-- Campo para ingresar el nombre -->
    Apellido: <input type="text" name="apellido"><br> <!-- Campo para ingresar el apellido -->
    Edad: <input type="number" name="edad"><br> <!-- Campo para ingresar la edad -->
    Departamento: <input type="text" name="departamento"><br> <!-- Campo para ingresar el departamento -->
    Salario: <input type="text" name="salario"><br> <!-- Campo para ingresar el salario -->
    <input type="submit" value="Agregar Empleado"><br> <!-- Botón para enviar el formulario -->
</form>

<?php
include 'conexion.php'; // Incluye nuevamente el archivo de conexión a la base de datos


$sql = "SELECT * FROM empleados";// Consulta SQL para obtener todos los empleados
$result = $con->query($sql); // Ejecuta la consulta


if ($result->num_rows > 0) {// Comprueba si hay empleados en la base de datos
    // Crea una tabla para mostrar los empleados
    echo "<table>
    <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Edad</th>
    <th>Departamento</th>
    <th>Salario</th>
    </tr>";
    
    
    while($row = $result->fetch_assoc()) {// Recorre cada fila de resultados y las muestra en la tabla
        echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["apellido"]."</td><td>".$row["edad"]."</td><td>".$row["departamento"]."</td><td>".$row["salario"]."</td></tr>";
    }
    echo "</table>"; // Cierra la tabla
} else {
    echo "No hay empleados"; // Mensaje si no hay empleados en la base de datos
}
?>
