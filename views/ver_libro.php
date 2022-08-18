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
        <div class='flex flex-col justify-center w-2/3 text-center border rounded-md p-7'>
                    <div class='p-2 min-w-fit'>
                        Nombre: <?=$data['nombre'];?>
                    </div>
                    <div class='p-2 min-w-fit'>
                        Autor: <?=$data['idautor'];?>
                    </div>
                    <form action="/libro/delete/<?=$data['id'];?>" method="POST">
                    <div class='p-2'>
                        <button type="submit" class='block px-4 py-2 mx-2 font-bold transition bg-red-500 rounded-md shadow-lg shadow-red-500/50 hover:shadow-red-500/100 text-red-50 hover:bg-red-600'>Eliminar</button>
                        </form>
                    </div>
                </div>
        </div>
    </main>
</body>

</html>