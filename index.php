<?php 
$title='TubeKids';
require_once './shared/header.php';
 ?>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a id="titulo_index_tubekids" class="navbar-brand" href="#">TubeKids</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php
	        $menu = [
	          'Login' => './security/login.php',
	          'Register' => './security/register.php'
	        ];
        ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php 
            foreach ($menu as $key => $value) {
            	echo "<li class='nav-item'>
                      	<a id='link_index_ingresar' class='nav-link' href='$value'>$key</a>
                      </li>";
            }
        ?>
    </ul>
  </div>
</nav>

<div class="welcome_box" style="display: flex; position: absolute; margin-top: 5%; margin-left: 34%;">
            <h1 class="text-info">WELCOME TO TUBEKIDS</h1>
</div>

<div class="welcome_image_box" style="display: flex; position: absolute; margin-top: 15%; margin-left: 40%;">
  <img src="./assets/images/welcome_icon.png">
</div>




 <?php require_once 'shared/footer.php'; ?>
