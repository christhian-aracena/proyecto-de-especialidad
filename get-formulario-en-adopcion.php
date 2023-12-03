<div class="container-register container-options">
    <h2>En adopción</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="nombre" required placeholder="Nombre de mascota">
        </div>
        <div class="form-group">
            <input type="text" name="raza" required placeholder="raza">
        </div>
        <div class="form-group">
            <input type="text" name="vacunas" required placeholder="Vacunas">
        </div>       
        <div class="form-group">
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
        </div>

        <div class="form-group">
            <textarea type="text" name="vacunas" required placeholder="Incluye la mayor cantidad de detalles."></textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Foto de Perfil (Por el momento solo puedes subir 1 imagen):</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
        </div>
        <button id="btnRegister">Dar en adopción</button>
    </form>
</div>