<?php

require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">

        <h2>Casas & Apartamentos en Venta</h2>
        <?php
        $limite = 9;
        include 'includes/templates/anuncios.php';
        ?>
</main>

<?php
incluirTemplate('footer');
?>