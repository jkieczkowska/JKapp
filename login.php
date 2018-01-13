<?php
include "config.php";
session_start();
if(isset($_SESSION['username'])){
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <p><br/><br/><br/></p>
   <div class="container">
       <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                     <?php
                        include "config.php";
                        if(isset($_POST['login'])&&isset($_POST['haslo'])){
                            $login=$_POST['login'];
                            $haslo=md5($_POST['haslo']);
                            $stmt=$db->prepare("SELECT*FROM uzytkownik WHERE login=? AND haslo=? ");
                            $stmt->bindParam(1,$login);
                            $stmt->bindParam(2,$haslo);
                            $stmt->execute();
                            $row=$stmt->fetch();
                            $user=$row['login'];
                            $pass=$row['haslo'];
                            $name=$row['imie'];
                            $surname=$row['nazwisko'];
                            $id=$row['id'];
                            $type=$row['type'];
                            if($login==$user && $pass==$phaslo){
                                //session_start();
                                $_SESSION['login']=$user;
                                $_SESSION['haslo']=$pass;
                                $_SESSION['id']=$id;
                                $_SESSION['type']=$type;
                                $_SESSION['imie']=$name;
                                $_SESSION['nazwisko']=$surname;
                                ?>
                                <script>window.location.href='index.php'</script>
                                <?php

                            }else{
                                ?>
                                  <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>UWAGA!</strong> Niepoprawny login lub hasło.
</div>
                                <?php
                            }
                        }
                     ?>
                      <form method="post">
                          <div class="form-group">
                              <label>Nazwa Użytkownika</label>
                              <input type="text" class="form-control" name="username" required/>
                          </div>
                          <div class="form-group">
                              <label>Hasło</label>
                              <input type="password" class="form-control" name="password" required/>
                          </div>

                          <input type="submit" value="Login" class="btn btn-primary"/>
                          <a href="register.php" class="btn btn-link">Rejestruj</a>

                                   </div>
                      </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">


                          </div>
            <div class="col-md-4"></div>

   </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
