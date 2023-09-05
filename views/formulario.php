<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Turista</title>
</head>
<body>
    <h1>Formulario de Turista</h1>
    <form id="turistaForm" method='post'>
        <label for="alias">Alias:</label>
        <input type="text" name="alias" id="alias" value="ejemplo" required><br>
        <label for="urlImg">URL de la imagen:</label>
        <input type="text" name="urlImg" id="urlImg" value="imagen.jpg" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="correo@example.com" required><br>
        <input type="text" name="idUsuario" id="idUsuario" value="123" required><br>
        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia" value="contrasena123" required><br>
        <label for="rol">Rol:</label>
        <input type="text" name="rol" id="rol" value="usuario" required><br>
        <button type="button" onclick="enviarDatos()">Enviar</button>
    </form>

    <script>
        function enviarDatos() {
            var form = document.getElementById("turistaForm");
            var data = {
                accion: "altaUsuario",
                alias: form.alias.value,
                email: form.email.value,
                contrasena: form.contrasenia.value,
                activo:"S",
                bloqueado:"N",
                url_img_usuario: form.urlImg.value,
                fecha_cambio_pwd:null,
                rol: form.rol.value
            };

            var jsonData = JSON.stringify(data);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/usuarioController.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };

            xhr.send(jsonData);
        }
    </script>
</body>
</html>
