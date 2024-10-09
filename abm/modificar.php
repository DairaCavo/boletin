<!DOCTYPE html> 
<html lang="es"> 
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="estilo.css"> <!-- Enlaza la página -->
</head>
</html>

<?php
include 'conexion.php'; // Incluye la conexión a la base de datos


if ($_SERVER['REQUEST_METHOD'] == 'POST') {// Comprueba si se ha enviado un formulario mediante el método POST
    $id = $_POST['id']; // Obtiene el ID del empleado a modificar
    $nombre = $_POST['nombre']; // Obtiene el nuevo nombre 
    $apellido = $_POST['apellido']; // Obtiene el nuevo apellido 
    $edad = $_POST['edad']; // Obtiene la nueva edad 
    $departamento = $_POST['departamento']; // Obtiene el nuevo departamento 
    $salario = $_POST['salario']; // Obtiene el nuevo salario 

   
    $sql = "UPDATE empleados SET nombre='$nombre', apellido='$apellido', edad='$edad', departamento='$departamento', salario='$salario' WHERE id='$id'"; // Consulta SQL para actualizar los datos del empleado en la base de datos
    
    
    if ($con->query($sql) == TRUE) {// Ejecuta la consulta y comprueba si esta bien
        echo "Empleado modificado."; // Msj de la modificación
    } else {
        echo "Error: " . $sql . "<br>" . $con->error; // Msj de error si la consulta falla
    }
}
?>

<!-- Formulario para modificar los datos de un empleado -->
<form method="post" action="modificar.php"> <!-- El formulario envía los datos mediante POST a la misma página -->
    Id empleado:<input type="number" name="id"><br> <!-- Campo para ingresar el ID del empleado -->
    Nombre: <input type="text" name="nombre"><br> <!-- Campo para ingresar el nuevo nombre  -->
    Apellido: <input type="text" name="apellido"><br> <!-- Campo para ingresar el nuevo apellido  -->
    Edad: <input type="number" name="edad"><br> <!-- Campo para ingresar la nueva edad -->
    Departamento: <input type="text" name="departamento"><br> <!-- Campo para ingresar el nuevo departamento -->
    Salario: <input type="text" name="salario"><br> <!-- Campo para ingresar el nuevo salario  -->
    <input type="submit" value="Modificar Empleado"> <!-- Botón para enviar el formulario -->
</form>

<?php
include 'conexion.php'; // Incluye nuevamente el archivo de conexión a la base de datos


$sql = "SELECT * FROM empleados";// Consulta SQL para seleccionar todos los empleados 
$result = $con->query($sql); // Ejecuta la consulta y guarda el resultado


if ($result->num_rows > 0) {// Comprueba si hay resultados en la consulta
    // Muestra una tabla con los resultados
    // Encabezados de la tabla
    echo "<table>
    <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Edad</th>
    <th>Departamento</th>
    <th>Salario</th>
    </tr>"; 
    // Recorre cada fila del resultado
    while($row = $result->fetch_assoc()) {
        // Muestra cada empleado en una fila de la tabla
        echo "<tr><td>".$row["id"]."</td><td>".$row["nombre"]."</td><td>".$row["apellido"]."</td><td>".$row["edad"]."</td><td>".$row["departamento"]."</td><td>".$row["salario"]."</td></tr>";
    }
    echo "</table>"; // Cierra la tabla
} else {
    echo "No hay empleados"; // Mensaje si no hay empleados en la base de datos
}
?>
