<?php
            // Obtener el identificador único desde la URL
            if (isset($_GET['id'])) {
                $identificador_mascota = $_GET['id'];

                // Conectar a la base de datos (reemplaza con tus credenciales)
                include("Datos/conexion.php");

                // Consulta para obtener detalles de la mascota
                $sql = "SELECT * FROM adopcion
                INNER JOIN salud ON salud.id = adopcion.salud_id
                INNER JOIN sexo ON sexo.id = adopcion.sexo_id
                INNER JOIN dimension ON dimension.id = adopcion.dimension_id
                INNER JOIN edad ON edad.id = adopcion.edad_id
                WHERE adopcion.id = '$identificador_mascota'";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    $fila = $resultado->fetch_assoc();
                    // Mostrar detalles de la mascota
                    $imagen_mascota = base64_encode($fila['imagen_mascota']);
                    $nombre_mascota = $fila['nombre'];
                    $raza = $fila['raza'];
                    $descripcion = $fila['descripcion'];
                    $fecha_registro = $fila['fecha_registro'];
                    $vacunas = $fila['vacunas'];
                    $sexo_mascota = $fila['sexo_mascota'];
                    $edad_mascota = $fila['edad_mascota'];
                    $salud = $fila['estado_salud'];
                    $dimension = $fila['dimension_mascota'];
                    // Mostrar más detalles según sea necesario
                } else {
                    echo "<p>No se encontraron detalles para la mascota con ID: $identificador_mascota</p>";
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();
            } else {
                echo "<p>No se proporcionó un ID de mascota válido en la URL.</p>";
            }
            ?>