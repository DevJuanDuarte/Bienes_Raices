<?php 
//Importar la conexion:
$db = conectarDB();

//Consultar:
$query = "SELECT * FROM propiedades LIMIT {$limite}";

//Obtener resultado:
$resultado = mysqli_query($db,$query);
?>


<div class="contenedor-anuncios">
            <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">
                
                <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio">$<?php echo number_format($propiedad['precio']); ?></p>


                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" 
                            alt="Icono WC">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" 
                            alt="Icono Estacionamiento">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" 
                            alt="Icono Habitaciones">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>

                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>


                </div><!--.contenido-anuncio-->
            </div><!--.anuncio-->
            <?php endwhile; ?>
        </div><!--.contenedor-anuncios-->

<?php 
//Cerrar la conexion:
mysqli_close($db);
?>