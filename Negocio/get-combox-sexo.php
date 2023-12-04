<select class='cBEspecie cursor-pointer'  name="sexo" id="especieMascota" required>
  <?php
  include('Datos/conexion.php');
  $ejecutarConsulta = $conexion->query('SELECT * FROM sexo');

  $null = null;

  echo "<option value='$null'>Selecciona un sexo</option>";

  while ($fila1 = mysqli_fetch_assoc($ejecutarConsulta)) {
      $id = $fila1['id'];
      $sexo = $fila1['sexo_mascota'];

      // Imprimir la opción dentro del elemento <select>
      echo "<option value='$id'>$sexo</option>";
  }
  ?>
</select>