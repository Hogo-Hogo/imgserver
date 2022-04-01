<!DOCTYPE html>
<html>
<head>
	<!-- This code is without styles, style updates and nothing, what is not related to JavaScript. -->
  <title>Uploading image</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="zobrazit.js"></script>
    <center>
<body>
<?php
$db = mysqli_connect('localhost','root','','images');

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
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/png"))
&& ($_FILES["image"]["size"] < 4000000))
    $povolene = array('jpg', 'jpeg', 'png', 'gif', 'svg');
    $kod = htmlspecialchars($_POST['kod']); 
    $cislo1 = rand(1111,9999); 
    $cislo2 = rand(1111,9999);
	$povolene = array_flip($povolene);
    $cislo3 = $cislo1.$cislo2;  
    $cislo3 = md5($cislo3);  
 
    
    $obr_nm = $_FILES['image']['name']; 
    $umistit = 'images/'.$cislo3.$obr_nm;
    $umisteni = 'images/'.$cislo3.$obr_nm; 

    move_uploaded_file($_FILES['image']["tmp_name"],$umistit);  
    $check = mysqli_query($db,"INSERT INTO images (images, kod) VALUES('$umisteni', '$kod')");  
		
    if($check)
    { 
    	?>
    	

    	<input type="text" class="textarea zkopirovat" onclick="this.select();" readonly style="text-align: center;" value="https://yourdreamwebsitename.com/<?php echo $kod; ?>"><script>
function zkopirovat(el) {  
  var range = document.createRange();  
  range.selectNode(el);  
  window.getSelection().addRange(range);  
    
  try {  
    var zkopirovano = document.execCommand('copy'); 
        if (zkopirovano) document.getElementById("kopirovat").innerHTML = "Copied!";
    else alert('It is not copied to the clipboard, sorry.');
  } catch(err) {  
    alert('Your browser can not copying.');
  }  
    
  window.getSelection().removeAllRanges();  
}
document.getElementById('nahrat').innerHTML = 'Upload';
</script>
<button class="prehled" id="kopirovat" onclick="zkopirovat(document.querySelector('.zkopirovat'))">Copy to clipboard</button>

    	<?php 
    }
    else
    {
    	echo '<script> alert("Error in uploading image."); </script>'; 
    }
}

else {
}
    

?>

<h2>Nahrát obrázek:</h2>
<script>
    function nahravam() {
        document.getElementById('nahrat').innerHTML = 'Uploading…';
    }
</script>
<div class="img">
    <img style="display: none" id="nahrany-obr">
</div>
<form method="POST" enctype="multipart/form-data" id="fileform">
      Upload, paste or drag and drop files here:
      <input type="file" onchange="zobrazit(this)" id="imageform" name="image" required class="prehled" style="cursor: pointer; padding: 10px;" size="800">
      <input type="hidden" name="kod" value="<?php $sql = "SELECT * FROM nahodne ORDER BY RAND() LIMIT 4";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { echo $row['kod']; } } ?>">
      <button name="submit" id="nahrat" value="Upload" class="uzivatele" onclick="nahravam();">Upload</button>		
</form>

<script>
    const form = document.getElementById("fileform");
const fileInput = document.getElementById("imageform");

fileInput.addEventListener('change', () => {
  form.submit();
});

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
});
</script>

<br>
</body>
