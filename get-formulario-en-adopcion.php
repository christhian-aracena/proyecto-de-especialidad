<div class="container-register container-options">
    <h2>Registrate</h2>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="nombre" required placeholder="Nombre">
        </div>
        <div class="form-group">
            <input type="text" name="apellido" required placeholder="apellido">
        </div>
        <div class="form-group">
            <input type="email" name="correo" required placeholder="correo">
        </div>
        <div class="form-group">
            <input type="password" name="contrasena" required placeholder="contraseña">
        </div>
        <div class="form-group">
            <label for="avatar">Foto de Perfil (opcional):</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
        </div>
        <button id="btnRegister">Registrarse</button>
    </form>
</div>