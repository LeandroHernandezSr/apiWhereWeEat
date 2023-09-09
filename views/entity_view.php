<!-- entity_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paginación de Entidades</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
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
            <?php foreach ($entities as $entity): ?>
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
    <ul>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
    </ul>
</body>
</html>

