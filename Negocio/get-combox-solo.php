<select class='cBEspecie cursor-pointer'  name="solo" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM solo');

  $null = null;

  echo "<option value='$null'>Selecciona una opción</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id_solo'];
      $tiempo = $fila1['tiempo'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$tiempo</option>";
  }
  ?>
</select>