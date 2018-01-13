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
    <title>Rejestracja</title>

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
                        if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['surname'])&&isset($_POST['email'])){
                            $username=$_POST['username'];
                            $password=md5($_POST['password']);
                            $name=($_POST['name']);
                            $surname=($_POST['surname']);
                            $email=($_POST['email']);
                            $stmt=$db->prepare("SELECT*FROM login WHERE username=? AND password=? ");
                            $stmt->bindParam(1,$username);
                            $stmt->bindParam(2,$email);

                            $stmt->execute();
                            $row=$stmt->fetch();
                            $user=$row['username'];
                            $ema=$row['email'];
                            $id=$row['id'];
                            $type=$row['type'];
                            if($username!=$user && $email!=$ema){
                               $sql="INSERT INTO login (username, password, name, surname, email) VALUES ('$username', '$password', '$name', '$surname', '$email')";
                                if($db->query($sql)== TRUE){
                                ?>
                                <script>window.location.href='login.php'</script>
                                <?php }

                            }else{
                                ?>
                                  <div class="alert alert-danger alert-dismissible" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <strong>UWAGA!</strong> Nazwa użytkownika lub adres email został już dodany.
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
                          <div class="form-group">
                              <label>Imię</label>
                              <input type="text" class="form-control" name="name" required/>
                          </div>
                          <div class="form-group">
                              <label>Nazwisko</label>
                              <input type="text" class="form-control" name="surname" required/>
                          </div>
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email" required/>
                          </div>
                          <input type="submit" value="Rejestruj" class="btn btn-primary" />
                          <a href="login.php" class="btn btn-link">Logowanie</a>

                      </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>

   </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
