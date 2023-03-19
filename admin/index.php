<?php

require '../includes/app.php';
$auth = estaAutenticado();
if (!$auth) {
    header('Location: /');
}


$db = conectarDB();

//Escribir el query:
$query = "SELECT * FROM propiedades";

//Consultar la base de datos:
$resultadoConsulta = mysqli_query($db, $query);

//Muestra el mensaje condicional:
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        //Eliminar el archivo:
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../imagenes/' . $propiedad['imagen']);



        //Eliminar la propiedad:
        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('location:/admin?resultado=3');
        }
    }
}

//Incluye un template:

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado == 1)) : ?>
        <p class="alerta exito">Creado Correctamente</p>
    <?php elseif (intval($resultado == 2)) : ?>
        <p class="alerta exito">Actualizado Correctamente</p>
    <?php elseif (intval($resultado == 3)) : ?>
        <p class="alerta exito">Eliminado Correctamente</p>
    <?php endif ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Crear</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo number_format($propiedad['precio']); ?></td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo-block">Editar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


</main>

<?php

//Cerrar la conexión (opcional):
mysqli_close($db);



incluirTemplate('footer');
?>