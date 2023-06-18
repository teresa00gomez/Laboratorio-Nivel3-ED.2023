<?php

    if ($_POST){
        $nombre = $_POST['nombre'];
        $primerApellido = $_POST['primerApellido'];
        $segundoApellido = $_POST['segundoApellido'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        if (empty($nombre) || empty($primerApellido) || empty($segundoApellido) || empty($email) || empty($login) || empty($password)) {
            echo "<script>alert('Por favor, completa todos los campos.'); window.location.href = 'index.html';</script>";
            exit;
        }

        if (!validarNombre($nombre) || !validarPrimerApellido($primerApellido) || !validarSegundoApellido($segundoApellido)){
            echo "<script>alert('El nombre y los apellidos no pueden contener números o símbolos.'); window.location.href = 'index.html';</script>";
            exit;
        }
        

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Por favor, ingresa un correo electrónico válido.'); window.location.href = 'index.html';</script>";
            exit;
        }

        if (strlen($password) < 4 || strlen($password) > 8) {
            echo "<script>alert('La contraseña debe tener entre 4 y 8 caracteres.'); window.location.href = 'index.html';</script>";
            exit;
        }

        $servername = 'localhost';
        $username = 'root';
        $passwordDB = '';
        $dbname = 'laboratoriofinal';

        $conn = new mysqli($servername, $username, $passwordDB, $dbname);
        if ($conn->connect_error){
            die('Error en la conexión con la base de datos: ' . $conn->connect_error);
        }

        $consultEmail = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($consultEmail);

        if ($result->num_rows > 0){
            echo '<script>alert("No se ha podido registrar el usuario en la base de datos porque el email ya existe. Por favor, introduzca otro.");
            window.location.href = "index.html";</script>';
        } else {
            $sql = "INSERT INTO usuarios (nombre, primerapellido, segundoapellido, email, login, pass) 
                VALUES ('$nombre', '$primerApellido', '$segundoApellido', '$email', '$login', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Registro completado correctamente"); window.location.href = "index.html";</script>';
            } else {
                echo 'Error al registrar al usuario: ' . $sql . '<br>' . $conn->error;
            }
        }

        $conn->close();
    }

    function validarNombre($nombre){
        $patron = '/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u';
        return preg_match($patron, $nombre);
    }

    function validarPrimerApellido($primerApellido){
        $patron = '/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u';
        return preg_match($patron, $primerApellido);
    }

    function validarSegundoApellido($segundoApellido){
        $patron = '/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u';
        return preg_match($patron, $segundoApellido);
    }
?>