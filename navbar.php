 <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Justyna Kięczkowska - DIY</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                 <li class="active"><a href="index.php">Strona główna <span class="sr-only">(current)</span></a></li>

                <li><a href="news.php">O mnie</a></li>
				<li><a href="galeria.php">Zobacz galerię</a></li>
                <li><a href="data.php">Kontakt</a></li>
                <?php
                  if($_SESSION['type']=='Administrator'){

                  ?>
                <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dodaj <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="dodajzdjecia.php">Dodaj zdjęcia</a></li>
						<li><a href="dodajkategorie.php">Dodaj kategorię</a></li>
					</ul>
				</li>
    
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Edytuj <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="edytujzdjecia.php">Edytuj zdjęcia</a></li>
					</ul>
				</li>
    
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuń <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="usunkategorie.php">Usuń kategorię</a></li>
					</ul>
				</li>
                <?php
                  }else{
                  ?>
               <!-- <li><a href="profil.php">Profil</a></li>-->

                <?php
                  }
                  ?>
              </ul>
              <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Szukaj</button>
              </form>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
               </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
