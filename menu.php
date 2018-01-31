<div class="col-md-3">
  <ul class="list-group">
    <a href="about.php" class="list-group-item">O mnie</a>
    <a href="photos.php" class="list-group-item">Zobacz galerię</a>
    <a href="contact.php" class="list-group-item">Kontakt</a> 
    <?php
      if($_SESSION['type']=='Administrator')
      {
        ?>
          <a href="addCategory.php" class="list-group-item">Dodaj Kategorie</a>
          <a href="removeCategory.php" class="list-group-item">Usuń Kategorie</a>
          <a href="addPhoto.php" class="list-group-item">Dodaj Zdjęcie</a>
          <a href="editPhoto.php" class="list-group-item">Edytuj Zdjęcia</a>
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
