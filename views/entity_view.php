<!-- entity_view.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Paginación de Entidades</title>
    <style>
        body {
            background-color: #F17F79;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
            box-shadow: 1px 3px 5px 1px;
        }

        thead {
            background-color: #A1F577;
            font-family: 'Oswald', sans-serif;
            font-size: 1rem;
            color: black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-family: 'Nunito', sans-serif;
        }

        .contenedor-principal {
            margin: 5rem auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .contenedor-enlaces {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .boton-paginado {
            background-color: #A1F577;
            color: black;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-family: 'Nunito', sans-serif;
            box-shadow: 1px 3px 5px 1px;
            transition: background-color 0.3s ease;
        }

        .boton-paginado:hover {
            background-color: transparent;
            color: black;
            box-shadow: none;
        }
    </style>
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