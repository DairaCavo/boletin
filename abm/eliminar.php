<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css"> <!-- Enlaza al CSS  -->
</head>
</html>
<?php
include 'conexion.php'; // Incluye la conexión a la base de datos


if ($_SERVER['REQUEST_METHOD'] == 'POST') {// Comprueba si se ha enviado el formulario
    $id = $_POST['id']; // Obtiene el ID del empleado a eliminar desde el formulario
    
    $sql = "DELETE FROM empleados WHERE id='$id'";  // Consulta SQL para eliminar un empleado basado en el ID
    
   
    if ($con->query($sql) == TRUE) { // Ejecuta la consulta y comprueba si se ejecutó correctamente
        echo "Empleado eliminado."; // Msj de éxito
    } else {
       
        echo "Error: " . $sql . "<br>" . $con->error; // Msj de error 
    }
}
?>

<form method="post" action="eliminar.php"><!-- Formulario para eliminar un empleado -->
    Id empleado: <input type="number" name="id"><br> <!-- Campo para ingresar el ID del empleado -->
    <input type="submit" value="Eliminar empleado"> <!-- Botón para enviar el formulario -->
</form>

<?php
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
   
    while($row = $result->fetch_assoc()) { // Recorre cada fila de resultados y las muestra en la tabla
        echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["apellido"]."</td><td>".$row["edad"]."</td><td>".$row["departamento"]."</td><td>".$row["salario"]."</td></tr>";
    }
    echo "</table>"; // Cierra la tabla
} else {
    echo "No hay empleados"; // Mensaje si no hay empleados en la base de datos
}
?>
