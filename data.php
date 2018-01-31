<?php
 include "config.php";
 session_start(); 
 if(!isset($_SESSION['username']))
 {
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
    <title>Kategorie prac"</title>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style2.css">
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
                      <h3 align="center">Kategorie</h3>
                <br />
                <div class="table-responsive">
                     <table id="costs_data" class="table table-striped table-bordered">
                          <thead>
                               <tr>
                                    <td>Id</td>
                                    <td>Nazwa</td>
                               </tr>
                          </thead>
                          <?php
                          $db = Db::getInstance();
                          $results = Db::getCategoryList();
                          foreach ($results as $row)
                          {
                               echo '
                               <tr>
                                    <td>'.$row["id"].'</td>
                                    <td>'.$row["nazwa"].'</td>
                               </tr>
                               ';
                          }
                          ?>
                     </table>
                </div>
                </div>
            </div>
        </div>

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
