<link rel="stylesheet" type="text/css" href="../assets/css/style_menu.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav_principal">
  <div style="width: 30%;"><a class="navbar-brand" href="#"><?=$tituloPagina?></a></div>
  <a class="navbar-brand" href="../carro/index.php"><img src="../assets/imagenes/carro_compras.svg" width="40" height="40" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--
    <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
    </a>
  </nav>
  -->

  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 30%;">
    <ul class="navbar-nav mr-auto">
        <?php
        $menu = [
          'Home'       => '../home/index.php',
          'Catálogo'   => '../catalogo/index.php',
          'Ordenes'    => '../orden/index.php',
          'Categorias' => '../categoria/index.php',
          'Productos'  => '../producto/index.php', 
          //'Salir' => '../seguridad/login.php',
        ];

            //echo "<label id='nombre_usuario' style='margin-top: 3%;''>".$_SESSION['usuario']['nombre']."|</label>";
         echo "<li class='nav-item'>
                    <strong><a class='nav-link' href='#'>" . $_SESSION['usuario']['nombre'] ."|</strong></a>
                  </li>";

        foreach ($menu as $key => $value) {
            echo "<li class='nav-item'>
                    <a class='nav-link' href='$value'>$key</a>
                  </li>";
        }
            echo "<li class='nav-item'>
                    <a class='nav-link' href='../seguridad/logout.php'>Salir</a>
                  </li>";
        ?>
    </ul>
  </div>
</nav>
