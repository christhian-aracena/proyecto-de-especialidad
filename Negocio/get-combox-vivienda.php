<select class='cBEspecie cursor-pointer'  name="vivienda" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM vivienda');

  $null = null;

  echo "<option value='$null'>Selecciona una opción</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $idEspecie = $fila1['id_vivienda'];
      $especie = $fila1['vivienda'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$idEspecie'>$especie</option>";
  }
  ?>
</select>