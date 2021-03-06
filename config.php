<?php
 class DB 
 {
  private static $instance = NULL;
  private function __construct() {}
  public static function getInstance() 
  {
   if (!isset(self::$instance)) 
   {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
     self::$instance = new PDO('mysql:host=mysql.cba.pl;dbname=justynafelicyta','jkroot','P@$$word1', $pdo_options);
   }
   return self::$instance;
  }
  public static function getUsersList() 
  {
   $stmt = self::$instance->query('SELECT * FROM login ORDER BY ID DESC');
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function getCategoryList() 
  {
   $stmt = self::$instance->query('SELECT * FROM kategoria;');
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function getDeleteFromCategory($id) 
  {
    $stmt = self::$instance->prepare('DELETE FROM kategoria WHERE id = '.$id.';');
    return $stmt->execute();
  } 
  public static function addCategory($nazwa)
  {
   $stmt = self::$instance->prepare("INSERT INTO kategoria (nazwa) values ('$nazwa');");
   return $stmt->execute();
  }
  public static function getPhotoList($kategoria)
  {
   if(is_numeric($kategoria))
	$sql = 'SELECT id, id_kategorii, nazwa, opis FROM zdjecia where id_kategorii = '.$kategoria.';';
   else
	$sql = 'SELECT id, id_kategorii, nazwa, opis FROM zdjecia;';

   $stmt = self::$instance->query($sql);
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public static function addPhotoToCategory($name, $category)
  {
   $stmt = self::$instance->prepare("INSERT INTO zdjecia (id_kategorii, nazwa) values (".$category.",'".$name."');");
   return $stmt->execute();
  }
  public static function removePhoto($id)
  {
   $stmt = self::$instance->prepare('DELETE FROM zdjecia WHERE id = '.$id.';');
   return $stmt->execute();
  }
  public static function changePhotoDescription($id, $description)
  {
   $stmt = self::$instance->prepare('UPDATE zdjecia SET opis = "'.$description.'" WHERE id = '.$id.';');
   return $stmt->execute();
  }
    
  public static function checkUser($username, $email)
  {
   $sql = 'SELECT * FROM login WHERE username="'.$username.'" AND email="'.$email.'"';
   $stmt = self::$instance->query($sql);
   return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  public static function checkCredentials($username, $password)
  {
   $sql = 'SELECT * FROM login WHERE username="'.$username.'" AND password="'.$password.'"';
   //echo ">>$sql";
   $stmt = self::$instance->query($sql);
   return $stmt->fetch(PDO::FETCH_ASSOC);
  }
   
  public static function addUser($username, $password, $name, $surname, $email)
  {
   $sql='INSERT INTO login (username, password, name, surname, email) VALUES ("'.$username.'", "'.$password.'", "'.$name.'", "'.$surname.'", "'.$email.'")';
   //echo ">>$sql";
   
   $stmt = self::$instance->prepare($sql);
   return $stmt->execute();
  }
 }
?>