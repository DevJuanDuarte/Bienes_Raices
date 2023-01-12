<?php
    require 'includes/funciones.php';
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoracion de tu hogar</h1>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el <span>01/09/2023</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, maxime repudiandae laudantium
                commodi, ratione reiciendis earum praesentium voluptate dicta a quia ipsum dolorem laboriosam
                dolorum iure incidunt. Veritatis, quidem perspiciatis.</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet aspernatur laborum ipsam, eum expedita
                recusandae esse suscipit possimus ipsa quo velit, incidunt ratione, perspiciatis iusto dolorum
                tenetur sunt delectus quibusdam.</p>
        </div>      
    </main>

    <?php
        incluirTemplate('footer');
    ?>



    <script src="build/js/bundle.min.js"></script>
</body>

</html>