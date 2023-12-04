<select class='cBEspecie cursor-pointer'  name="dimension" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM dimension');

  $null = null;

  echo "<option value='$null'>Seleccione un tamaño</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id'];
      $dimension = $fila1['dimension_mascota'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$dimension</option>";
  }
  ?>
</select>