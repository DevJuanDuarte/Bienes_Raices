<?php

//Importar la conexión:
require '../includes/config/database.php';
$db = conectarDB();

//Escribir el query:
$query = "SELECT * FROM propiedades";

//Consultar la base de datos:
$resultadoConsulta = mysqli_query($db, $query);

//Muestra el mensaje condicional:
$resultado = $_GET['resultado'] ?? null;

//Incluye un template:
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado == 1)) : ?>
    <p class="alerta exito">Creado correctamente</p>
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
                <td><img src="/imagenes/<?php echo $propiedad['imagen']. ".jpg"; ?>" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad['precio']; ?></td>
                <td>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Editar</a>
                    <a href="#" class="boton-rojo-block">Borrar</a>
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
