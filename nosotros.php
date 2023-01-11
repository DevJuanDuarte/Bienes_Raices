<?php 
    include './includes/templates/header.php';
?>

    <main class="contenedido seccion">
        <h1>Más sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Imagen sobre nosotros" loading="lazy">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, maxime repudiandae laudantium
                    commodi, ratione reiciendis earum praesentium voluptate dicta a quia ipsum dolorem laboriosam
                    dolorum iure incidunt. Veritatis, quidem perspiciatis.
                </p>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet aspernatur laborum ipsam, eum expedita
                    recusandae esse suscipit possimus ipsa quo velit, incidunt ratione, perspiciatis iusto dolorum
                    tenetur sunt delectus quibusdam.
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más sobre nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium saepe repellat, sequi quidem
                    repudiandae quasi cupiditate, corporis tempore quos quam exercitationem, reiciendis illo dolor
                    commodi. Eos aliquid ad debitis ut?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium saepe repellat, sequi quidem
                    repudiandae quasi cupiditate, corporis tempore quos quam exercitationem, reiciendis illo dolor
                    commodi. Eos aliquid ad debitis ut?
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium saepe repellat, sequi quidem
                    repudiandae quasi cupiditate, corporis tempore quos quam exercitationem, reiciendis illo dolor
                    commodi. Eos aliquid ad debitis ut?
                </p>
            </div>
        </div>
    </section>




    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.html">Nosotros</a>
                <a href="anuncios.html">Anuncios</a>
                <a href="blog.html">Blog</a>
                <a href="contacto.html">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2023&copy;.</p>
    </footer>



    <script src="build/js/bundle.min.js"></script>
</body>

</html>