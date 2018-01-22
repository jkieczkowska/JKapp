<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header('location:index_nz.php');
}
?>


<!DOCTYPE html>
<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Justyna Kięczkowska - DIY </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>


    <?php
      include "navbar.php";
      ?>

        <div class="container">
            <div class="row">

                <?php
                include "menu.php";
                ?>

                <div class="col-md-9">
                    <div class="jumbotron">
                             <?php
                              if($_SESSION['type']=='Administrator'){

                              ?>
                              <h1>Witaj Justyno!</h1>
                              <p>Wzbogać swoją stronę o nowe zdjęcia</p>
                              <?php
                              }else{
								   
                              ?>
                              <h1>Witaj użytkowniku!</h1>
                              <p>Witamy na stronie dotyczącej prac wykonanych przez Justynę.</p>
                               <?php
                              }
							  
                               ?>
							 
                              
                    </div>
                </div>
            </div>
        </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
