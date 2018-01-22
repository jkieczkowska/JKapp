<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header('location:index.php');

}
?>


<!DOCTYPE html>
<html lang="pl_PL">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- <meta charset="utf-8"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Justyna Kięczkowska - DIY</title>


    <!-- JQuery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
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
							   echo "<img src=\"zdjecie.jpg\" border=\"0\" width=\"325\" height=\"450\" style=\"float: right\" />";
							  ?>
							  <h1>O mnie:</h1>
							  
							  <?php
							  
                              echo 'Nazywam się Justyna Kięczkowska. Jestem studentką informatyki na Politechnice Rzeszowskiej. 
							  Obecnie jestem na drugim semestrze studiów magisterskich. 
							  W wolnych chwilach zajmuję się tworzeniem kartek lub innych ręcznie wykonywanych rzeczy. 
							  W zakładce "Zobacz galerię" możesz obejrzeć dużą część moich prac - dużą, ponieważ nie wszystkie zostały uwiecznione na zdjęciach.'
                              
                               
                              							  
                               ?>
							 
                              
                    </div>
                </div>
            </div>
        <//div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<script>
 $(document).ready(function(){
      $('#costs_data').DataTable();
 });
 </script>
