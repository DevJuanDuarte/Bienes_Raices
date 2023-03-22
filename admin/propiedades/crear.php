<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}


$db = conectarDB();

//Consultar para obtener los vendedores:
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores: ( Para que no nos marquen undefined )
$errores = Propiedad::getErrors();
// debuguear($errors);

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

//Ejecutar el codigo despues de que se envia el formulario:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Creamos una nueva instancia, de esa forma tendremos la referencia y podremos leer los atributos del objeto
    $propiedad = new Propiedad($_POST);
    //Agregar random a la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    //Setear la imagen:
    //Realiza un rezise con intervention:
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImage($nombreImagen);
    }

    //Luego hacemos una validación
    $errores = $propiedad->validar();

    if (empty($errores)) {

        //Crear la carpeta para subir imagenes:
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
        //Guardar la imagen en el servidor:
        $image->save(CARPETA_IMAGENES . $nombreImagen);
        //Mostrar la extensión de la imagen guardada:
        $extension = pathinfo(CARPETA_IMAGENES . $nombreImagen, PATHINFO_EXTENSION);
        echo "La imagen se ha guardado con éxito en la carpeta " . CARPETA_IMAGENES . " con la extensión " . $extension;
        //Guardar en la base de datos:
        $resultado = $propiedad->guardar();
        //Mensaje de exito o error:
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
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

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