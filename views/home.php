<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resources/css/output.css">
</head>

<body class="min-w-full min-h-screen text-white bg-slate-800">
    <main class="grid w-screen place-items-center gap-y-5 px-60">
        <div id="content" class="flex justify-center w-3/4">
            <table class='w-2/3 text-center border border-collapse table-auto'>
                <thead>
                    <th class='border'>ID</th>
                    <th class='border'>Nombre</th>
                    <th class='border'>Autor</th>
                    <th class='border'></th>
                </thead>
                <tbody>
                    <?php
                    foreach ($data["libros"] as $dato) {
                        echo "<tr>";
                        echo "<td class='border'>" . $dato["id"] . "</td>";
                        echo "<td class='border'>" . $dato["nombre"] . "</td>";
                        echo "<td class='border'>" . $dato["idautor"] . "</td>";
                        echo "<td class='border'><a class='block w-1/2 p-px ml-4 text-xs text-center transition bg-indigo-500 rounded-md shadow-lg shadow-indigo-500/50 color-indigo-50' href='/libro/".$dato['id']."'>Ver</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>