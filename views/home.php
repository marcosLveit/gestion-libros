<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $data["titulo"]; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

    <h2><?php echo $data["titulo"]; ?></h2>


    <table border="1" width="50%">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Modelo</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data["libros"] as $dato) {
                echo "<tr>";
                echo "<td>" . $dato["id"] . "</td>";
                echo "<td>" . $dato["nombre"] . "</td>";
                echo "<td>" . $dato["idautor"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>

</body>

</html>