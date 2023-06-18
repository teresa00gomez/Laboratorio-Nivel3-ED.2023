<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios registrados</title>
    <link href='style.css' rel='stylesheet' type='text/css'>
    <script src="script.js"></script>
</head>
<body>
<div class="bloque-form">
    <h2>Resultados en la base de datos:</h2>

    <?php

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'cursosql';

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error){
            die('Error en la conexión con la base de datos: ' . $conn->connect_error);
        }

        $sql = "SELECT nombre, primerapellido, segundoapellido, email, login FROM Usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["primerapellido"] . "</td>";
                echo "<td>" . $row["segundoapellido"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["login"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron datos";
        }

        $conn->close();
    ?>

    <button class="btn-submit" id="volver" onclick="volver()">Volver al formulario</button>
</div>
</body>
</html>