<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/botonera.css">
    <link rel="stylesheet" href="css/form.css">
    <title>import</title>
</head>

<body>
    <?php include "databaseManagement.inc.php";
    $confirmacion = '';
    if (count($_FILES) > 0) {
        $fichero = $_FILES["dataToImport"]["name"];
        $temp = $_FILES['dataToImport']['tmp_name'];
        $cont = 0;
        if (preg_match('/.+\.csv$/', $fichero) && move_uploaded_file($temp, $fichero)) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            chmod($fichero, 0777);
            //Recuperando la informacion del fichero
            if ($file = fopen($fichero, "r")) {
                while (($datos = fgetcsv($file)) != false) {
                    insertaGato($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], '');
                    $cont++;
                }
                fclose($file);
            }
        }
        if ($cont > 0) {
            $confirmacion = "Se han leido " . $cont . " líneas";
        } else {
            $confirmacion = "No se ha podido leer ningún dato.";
        }
    }

    ?>
    <nav>
        <ul>
            <li><a href="index.php">Página principal</a></li>
            <li><a href="create.php">Nuevo gato</a></li>
            <li><a href="list.php">Lista gato</a></li>
            <li><a class="active" href="import.php">Importar gato</a></li>
            <li><a href="export.php">Exportar gatos</a></li>
        </ul>
    </nav>
    <form class="form-register" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <h2 class="form-titulo">Importar:</h2>
        <input type="file" name="dataToImport" accept=".csv" required />
        <input type="submit" value="Upload" />
    </form>
    <h2><?php echo $confirmacion; ?></h2>
</body>

</html>