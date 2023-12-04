<select class='cBEspecie cursor-pointer'  name="salud" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM salud');

  $null = null;

  echo "<option value='$null'>Selecciona un estado de salud</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id'];
      $salud = $fila1['estado_salud'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$salud</option>";
  }
  ?>
</select>