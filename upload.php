<!DOCTYPE html>
<html>
<head>
  <title>UPLOAD a image here</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
  
    body {background: linear-gradient(#333, black, #222) fixed;}
      .uzivatele {background: darkviolet; }

   .uzivatele:hover {background: linear-gradient(#af82e8, darkorchid);}
   
</style>
</head><center style="box-shadow: 0 0 1em whitesmoke; border-radius: 2em; background: #EEE;">
<body>

<?php
$db = mysqli_connect('localhost','root','password','dbname');

if(!$db)
{
    die('Chyba: ' . mysqli_connect_error());
}

if(isset($_POST['submit']))
{
    $typ = $_FILES['image']['type'];
    if ((($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/jpg")
|| ($_FILES["image"]["type"] == "image/png"))
&& ($_FILES["image"]["size"] < 100000000)) // checks the image type and size
    $povolene = array('jpg', 'jpeg', 'png', 'gif'); 
    $cislo1 = rand(1111,9999); 
    $cislo2 = rand(1111,9999);
	$povolene = array_flip($povolene);
    $cislo3 = $cislo1.$cislo2;  
    $cislo3 = md5($cislo3);  
 
    
    $obr_nm = $_FILES['image']['name']; 
    $umistit = 'images/'.$cislo3.$obr_nm; // the folder in which it will be
    $umisteni = 'images/'.$cislo3.$obr_nm; // 

    move_uploaded_file($_FILES['image']["tmp_name"],$umistit);  // upload file in folder 
    $check = mysqli_query($db,"INSERT INTO images (images, kod) VALUES('$umisteni', '$cislo2')");  //insert image URL and code in DB
		
    if($check)
    { 
    	?>
    	

    	<input type="text" class="zkopirovat" onclick="this.select();" readonly style="text-align: center;" value="http://example.com/<?php echo $cislo2; ?>">
  <script>
function zkopirovat(el) {  
  var range = document.createRange();  
  range.selectNode(el);  
  window.getSelection().addRange(range);  
    
  try {  
    var zkopirovano = document.execCommand('copy'); 
        if (zkopirovano) document.getElementById("kopirovat").innerHTML = "✔";
    document.getElementById('nahrat').innerHTML='Upload';
    else alert('Not make a copy.');
  } catch(err) {  
    alert('This browser is not valid in the copy files.');
    
  window.getSelection().removeAllRanges();  
}

</script>
<button id="kopirovat" onclick="zkopirovat(document.querySelector('.zkopirovat'))">Copy link</button>

    	<?php 
    }
    else
    {
    	echo '<script> alert("Error of uploading image."); </script>'; 
    }
}

else {
}
    

?>

<h2>Nahrát obrázek:</h2>
<script>
    function nahravam() {
        document.getElementById('nahrat').innerHTML('Uploading…');
    }
</script>
<form method="POST" enctype="multipart/form-data">
      Nahraj nebo přetáhni soubory sem:
      <input type="file" name="image" required style="cursor: pointer; padding: 10px;" size="800">
     
      <button name="submit" id="nahrat" value="Nahrát" onclick="nahravam();">Upload</button>		
</form>


<br>
