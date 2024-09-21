<?php 
    session_start()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <nav>
        <img id="logo" src="https://img.freepik.com/vector-gratis/plantilla-logotipo-biblioteca-diseno-plano-dibujado-mano_23-2149342961.jpg" alt="logo">

        <div id="links-container">
            <a href="">Libros</a>
            <a href="">Autores</a>
            <a href="">Categorias</a>
            <a href=""><?php echo $_SESSION['usuario']['username'] ?></a>
        </div>
    </nav>

    <main>

    </main>
</body>
</html>