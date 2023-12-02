<select class='cBEspecie cursor-pointer'  name="especieMascota" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM salud');

  $null = null;

  echo "<option value='$null'>Selecciona un estado</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id'];
      $especie1 = $fila1['estado_salud'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$especie1</option>";
  }
  ?>
</select>