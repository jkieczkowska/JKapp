<div class="col-md-3">
                    <ul class="list-group">
                      <a href="news.php" class="list-group-item">O mnie</a>
					  <a href="galeria.php" class="list-group-item">Zobacz galerię</a>
					  <a href="kontakt.php" class="list-group-item">Kontakt</a> 
                      
                          <?php
                          if($_SESSION['type']=='Administrator'){

                          ?>
                      <a href="dodajkategorie.php" class="list-group-item">Dodaj Kategorie</a>
					  <a href="usunkategorie.php" class="list-group-item">Usuń Kategorie</a>
                      <a href="dodajzdjecia.php" class="list-group-item">Dodaj Zdjęcie</a>
					  <a href="edytujzdjecia.php" class="list-group-item">Edytuj Zdjęcia</a>
                      <a href="users.php" class="list-group-item">Lista użytkowników</a>
                      <?php
                          }else{ 
						  

                      ?>
                     <!-- <a href="profil.php" class="list-group-item">Profil</a>-->
                      <?php
                      }

                      ?>
                      <a href="logout.php"class="list-group-item">Logout</a>
                    </ul>
                </div>
