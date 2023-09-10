<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Paginación de Entidades</title>
    <link rel="stylesheet" href="stylePaginado.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>

<body>
    <div class='contenedor-principal'>
        <table>
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Alias</th>
                    <th>Email</th>
                    <th>Activo</th>
                    <th>Bloqueado</th>
                    <th>URL Imagen Usuario</th>
                    <th>Fecha Cambio Contraseña</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entities as $entity) : ?>
                    <tr>
                        <td><?= $entity['id_usuario'] ?></td>
                        <td><?= $entity['alias'] ?></td>
                        <td><?= $entity['email'] ?></td>
                        <td><?= $entity['activo'] ?></td>
                        <td><?= $entity['bloqueado'] ?></td>
                        <td><?= $entity['url_img_usuario'] ?></td>
                        <td><?= $entity['fecha_cambio_pwd'] ?></td>
                        <td><?= $entity['rol'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Mostrar los enlaces de paginación -->
        <div class="contenedor-enlaces">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a class="boton-paginado" href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>


    </div>
</body>

</html>