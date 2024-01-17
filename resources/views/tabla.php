<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas Redimensionables</title>
</head>
<body>

<table id="miTabla" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
         <?php
            // Simula la conexión a la base de datos y recuperación de datos
            $conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_bd");

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $query = "SELECT * FROM mi_tabla";
            $result = $conexion->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }

            $conexion->close();
        ?>
    </tbody>
</table>

<script>
    // Código JavaScript para hacer la tabla redimensionable
    // Este es un ejemplo simple usando la librería DataTables
    // Asegúrate de incluir DataTables en tu proyecto

    $(document).ready(function() {
        $('#miTabla').DataTable();
    });
</script>

</body>
</html>
