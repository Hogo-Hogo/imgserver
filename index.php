<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Image server in PHP</title>
        <style>
    body {background: linear-gradient(#333, black, #222) fixed;}
.cursive {
    font-family: cursive;
}
@media (max-width: 50em) {
    .cursive {
        font-family: arial;
    }
}
.a {
  text-decoration: none; 
  padding: 10px; 
  font-variant: small-caps;
  color: white;
  border: 1px solid;
  background: #AF95E9;
          }
    </style>
</head>
    <center style="box-shadow: 0 0 1em whitesmoke; border-radius: 2em; background: #EEE; ">
    <br><br><a href="/upload.php" class="a">Upload a image</a><br><br>
<?php
$db = mysqli_connect('localhost','root','password','dbname');

if(!$db)
{
    die('Chyba: ' . mysqli_connect_error());
}
$get = $_GET['img'];
$sql = "SELECT * FROM images WHERE kod='$get'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
          ?>
          <br><hr>
          <table border="0" style="border: 2px solid black;"><tr><td><img src="<?php echo $row['images']; ?>" alt=""></td></tr></table><hr><br><br>
          <?php } } ?>
          
