<?php
include 'conexion.php';

// Manejar la inserción de un nuevo estudiante
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevo_estudiante'])) { //revisa que se le este enviando informacion y comprueba que este el campo
    $nombre = $_POST['nombre'];//guarda la informacion de la bdd de el campo especifico en una variable 
    $sql = "INSERT INTO estudiantes (nombre) VALUES ('$nombre')"; //inserta datos especificos en la bdd
    if ($con->query($sql) === TRUE) { //comprueba que la consulta SQL fuece ejecutada bien 
        echo "Nuevo estudiante agregado.";//muestra el msj
    } else {
        echo "Error: " . $sql . "<br>" . $con->error; //muesttra msj y detalles 
    }
}

// Manejar la inserción de una nueva calificación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nueva_calificacion'])) { //revisa que se le este enviando informacion y comprueba que este el campo
    $estudiante_id = $_POST['estudiante_id']; //guarda la informacion de la bdd de el campo especifico en una variable 
    $materia = $_POST['materia']; //guarda la informacion de la bdd de el campo especifico en una variable 
    $calificacion = $_POST['calificacion']; //guarda la informacion de la bdd de el campo especifico en una variable 
    $sql = "INSERT INTO calificaciones (estudiante_id, materia, calificacion) VALUES ('$estudiante_id', '$materia', '$calificacion')"; //inserta datos especificos en la bdd
    if ($con->query($sql) === TRUE) { //comprueba que la consulta SQL fuece ejecutada bien 
        echo "Nueva calificación agregada."; //muestra el msj
    } else {
        echo "Error: " . $sql . "<br>" . $con->error; //muesttra msj y detalles
    }
}

// Manejar el filtro por estudiante
$estudiante_filtrado = isset($_POST['filtrar_estudiante']) ? $_POST['estudiante_filtrado'] : ''; // Verifica que el campo este presente en los datos del formulario y si esta guarda el valor en la una variable

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boletín de Calificaciones</title>
</head>
<body>
    <h1>Boletín de Calificaciones</h1>
    
    <h2>Agregar Estudiante</h2>
    <form method="POST" action=""> <!-- inicia formulario -->
        Nombre: <input type="text" name="nombre" required>
        <button type="submit" name="nuevo_estudiante">Agregar Estudiante</button>
    </form>
    
    <h2>Agregar Calificación</h2>
    <form method="POST" action=""> <!-- inicia formulario -->
        Estudiante:
        <select name="estudiante_id" required> <!-- muestra un menu desplegable para selecciionar el estudiante y es requerido-->
            <?php
            $sql = "SELECT * FROM estudiantes"; //selecciona todo de la tabla
            $result = $con->query($sql); //guarda los valores obtenidos en una variable
            while($row = $result->fetch_assoc()) { // recorre todas las filas de result y mientras haya resultados de la consulta los guarda en una variable
                echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";// hace que se muestren las opciones de la lista desplegable 
            }
            ?>
        </select>
        Materia: <input type="text" name="materia" required> <!-- Campo de texto para ingresar la materia y es requerido -->
        Calificación: <input type="number" step="0.01" name="calificacion" required> <!-- Campo de numerico para ingresar la calificacion y es requerido -->
        <button type="submit" name="nueva_calificacion">Agregar Calificación</button> <!-- hace un boton para enviar los datos cargados -->
    </form>

    <h2>Filtrar Calificaciones por Estudiante</h2>
    <form method="POST" action=""> <!-- inicia formulario -->
        Estudiante:
        <select name="estudiante_filtrado"> <!-- muestra un menu desplegable para seleccionar el estudiante -->
            <option value="">Todos</option> <!-- muestra todos los estudiantes-->
            <?php
            $sql = "SELECT * FROM estudiantes"; //selecciona todo de la tabla
            $result = $con->query($sql);//guarda los valores obtenidos en una variable
            while($row = $result->fetch_assoc()) { // recorre todas las filas de result y mientras haya resultados de la consulta los guarda en una variable
                $selected = $row['id'] == $estudiante_filtrado ? 'selected' : '';//compara que se este mostrardo al estudiante correcto por el id 
                echo "<option value='" . $row['id'] . "' $selected>" . $row['nombre'] . "</option>";//selecciona un nombre por el id y muestra el nombre en una lista desplegable
            }
            ?>
        </select>
        <button type="submit" name="filtrar_estudiante">Filtrar</button><!-- hace un boton para enviar los datos cargados -->
    </form>
    
    <h2>Calificaciones</h2>/crea una tabla para visualizar los resultados/
    <table border="1">  <!-- Inicia la tabla con un borde de 1 pixel -->
        <tr><!-- Crea una fila -->
            <th>Estudiante</th><!-- Crea una columna -->
            <th>Materia</th><!-- Crea una columna -->
            <th>Calificación</th><!-- Crea una columna -->
        </tr>
        <?php
        //permite hacer un cruce entre tabla para poder devolver la calificacion del estudiante
        $sql = "SELECT estudiantes.nombre, calificaciones.materia, calificaciones.calificacion
                FROM calificaciones
                JOIN estudiantes ON calificaciones.estudiante_id = estudiantes.id";// Realiza una consulta SQL para obtener el nombre del estudiante, la materia y la calificación uniendo las tablas 'calificaciones' y 'estudiantes'
    
        
        if ($estudiante_filtrado) { // Si hay un estudiante filtrado
            $sql .= " WHERE estudiantes.id = $estudiante_filtrado"; // Agrega un WHERE para filtrar los resultados por el ID 
        }
        // muestra el resultado de la consulta realizada en una tabla 
        $result = $con->query($sql); //guarda los valores obtenidos en una variable
        while($row = $result->fetch_assoc()) { // recorre todas las filas de result y mientras haya resultados de la consulta los guarda en una variable
            echo "<tr> <!-- Muestra la fila -->
                    <td>" . $row['nombre'] . "</td> <!-- Muestra la columna -->
                    <td>" . $row['materia'] . "</td> <!-- Muestra la columna -->
                    <td>" . $row['calificacion'] . "</td> <!-- Muestra la columna -->
                  </tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$con->close();//cierra la conexion a la base de datos
?>