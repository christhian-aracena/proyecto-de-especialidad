<select class='cBEspecie cursor-pointer'  name="especieMascota" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM edad');

  $null = null;

  echo "<option value='$null'>Seleccione una edad</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id'];
      $edad = $fila1['edad_mascota'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$edad</option>";
  }
  ?>
</select>