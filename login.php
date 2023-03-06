<?php
//Importar la conexion:
require 'includes/app.php';
$db = conectarDB();

//Autenticar el usuario:
$errores = [];

if ($_SERVER['REQUEST_METHOD']==='POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }

    if (!$password) {
        $errores[] = "El password es obligatorio o no es valido";
    }

    if (empty($errores)) {
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db,$query);

        

        if ($resultado->num_rows) {
            $usuario = mysqli_fetch_assoc($resultado);


            //Verificar si el password es correcto o no:
            $auth = password_verify($password, $usuario['password']);
            if($auth){

                //El usuario está autenticado:
                session_start();

                //Llenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location:/admin');

                // echo "<pre>";
                // var_dump($_SESSION);
                // echo "</pre>";

            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }



}


incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email & Password</legend>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" id="password">
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>