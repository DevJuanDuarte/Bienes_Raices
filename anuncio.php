<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
// var_dump($id);

if (!$id) {
    header('location: /');
}

require 'includes/config/database.php';
$db = conectarDB();

//Consultar:
$query = "SELECT * FROM propiedades WHERE id = {$id}";

//Obtener resultado:
$resultado = mysqli_query($db, $query);
if (!$resultado->num_rows) {
    header('location: /');
}
$propiedad = mysqli_fetch_assoc($resultado);


require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo number_format($propiedad['precio']); ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                <p><?php echo $propiedad ['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                <p><?php echo $propiedad ['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                <p><?php echo $propiedad ['habitaciones']; ?></p>
            </li>
        </ul>

        <p>
        <?php echo $propiedad ['descripcion']; ?>
        </p>

    </div>
</main>

<?php
mysqli_close($db);
incluirTemplate('footer');
?>