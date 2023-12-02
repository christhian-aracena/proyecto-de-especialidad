<select class='cBEspecie cursor-pointer'  name="especieMascota" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM especies');

  $null = null;

  echo "<option value='$null'>Selecciona especie</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $idEspecie = $fila1['idEspecie'];
      $especie = $fila1['tipoEspecie'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$idEspecie'>$especie</option>";
  }
  ?>
</select>