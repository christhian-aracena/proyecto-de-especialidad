<div class="container-register ajuste-adopcion container-options">
    <h2>En adopción</h2>
    <form action="Negocio/publicar-adopcion.php" method="post" enctype="multipart/form-data">
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
            <?php include("Negocio/get-combox-especie.php"); ?>
        </div>
        <div class="form-group">
            <?php include("Negocio/get-combox-salud.php"); ?>
        </div>
        <div class="form-group">
            <?php include("Negocio/get-combox-sexo.php"); ?>
        </div>
        <div class="form-group">
            <?php include("Negocio/get-combox-dimension.php"); ?>
        </div>
        <div class="form-group">
            <?php include("Negocio/get-combox-edad.php"); ?>
        </div>
        <div class="form-group">
            <textarea type="text" name="descripcion" required placeholder="Incluye la mayor cantidad de detalles."></textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Foto de Perfil (Por el momento solo puedes subir 1 imagen):</label>
            <input type="file" id="avatar" name="imagen_mascota" accept="image/*" required>
        </div>
        <button type="submit" id="btnRegister">Dar en adopción</button>
    </form>
</div>