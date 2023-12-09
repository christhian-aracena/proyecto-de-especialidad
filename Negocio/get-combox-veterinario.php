<select class='cBEspecie cursor-pointer'  name="veterinario" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM veterinario');

  $null = null;

  echo "<option value='$null'>Selecciona una opción</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $idEspecie = $fila1['id'];
      $especie = $fila1['disposicion'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$idEspecie'>$especie</option>";
  }
  ?>
</select>