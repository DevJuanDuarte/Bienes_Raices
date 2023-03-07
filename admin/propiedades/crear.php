<?php
require '../../includes/app.php';

use App\Propiedad;


estaAutenticado();


$db = conectarDB();

//Consultar para obtener los vendedores:
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores:
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

//Ejecutar el codigo despues de que se envia el formulario:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST);
    $propiedad->guardar();
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";


    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
    $creado = date ('Y/m/d');

    //Asignar files a una variable:
    $imagen = $_FILES['imagen'];
    
    

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }

    if (strlen($descripcion) <= 50) {
        $errores[] = "Debes añadir una descripcion y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "Debes añadir un numero de lugares deestacionamiento";
    }

    if (!$vendedorId) {
        $errores[] = "Debes añadir un vendedor";
    }

    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La imagen es obligatoria';
    }

    //Validar por tamaño en (1mb máximo):
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La imagen es muy pesada';
    }

    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio:
    if (empty($errores)) {

        //Crear la carpeta de imagenes:
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(), true)) ;

        //Subir la imagen:
        $nombreImagen = md5(uniqid(rand(), true));
 
        if($imagen['type'] === 'image/jpeg'){
            $nombreImagen .= ".jpg";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }elseif($imagen['type'] === 'image/png'){
            $nombreImagen .= ".png";
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $errores[] = "El formato de la imagen tiene que ser jpg o png";
        }
      


        //Insertar en la base de datos:
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId)
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado',  '$vendedorId')";
        // echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario:
            header("Location: /admin?resultado=1");
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo"  placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" value="<?php echo $imagen; ?>">

            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>


        <fieldset>
            <legend>Informacion de la Propiedad</legend>


            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" value="<?php echo $habitaciones; ?>" placeholder="Ejemplo: 3" min="1" max="9">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" value="<?php echo $wc; ?>" placeholder="Ejemplo: 3" min="1" max="9">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="estacionamiento" value="<?php echo $estacionamiento; ?>" placeholder="Ejemplo: 3" min="1" max="9">
        </fieldset>


        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">Seleccione una opción</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>


        <input type="submit" value="Crear" class="boton boton-verde">


    </form>

</main>

<?php
incluirTemplate('footer');
?>