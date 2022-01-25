<?php include "session.php" ?>
<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Magacin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/w3.css">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/css.css">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/font-awesome.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head><body class="w3-light-grey">

<!-- Top container -->

<?php
include "classes/vrsta_kvara.php";
include "topbar.php";
include "menu.php";
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php include "header.php";
include "connect.php";

//update
if (ISSET($_POST['izmena'])){	
	$vrstaKvara=new VrstaKvara($conn);
	$vrstaKvara->naziv=htmlspecialchars($_POST['naziv']);
	$vrstaKvara->id=htmlspecialchars($_POST['id']);
	$vrstaKvara->update($vrstaKvara->naziv,$vrstaKvara->id);
}

//delete
if (ISSET($_GET['delete_id'])){	
	$vrstaKvara=new VrstaKvara($conn);
	$vrstaKvara->id=htmlspecialchars($_GET['delete_id']);
	$vrstaKvara->delete($vrstaKvara->id);
}

//insert
if (ISSET($_POST['unos'])){	
	$vrstaKvara=new VrstaKvara($conn);
	$vrstaKvara->naziv=htmlspecialchars($_POST['naziv']);
	$vrstaKvara->insert($vrstaKvara->naziv);
}
?>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Vrsta kvara</h5>
		<form method='post' action='#'>
        <input type='text' name='naziv' value='<?php if (ISSET($_GET['id'])) {echo $_GET['naziv'];}?>'>
		<?php if (ISSET($_GET['id'])) echo "<input type='hidden' name='id' value=".$_GET['id'].">";?>
		<?php if (!ISSET($_GET['id'])) echo "<input type='submit' value='Unesi' name='unos'>";?>
		<?php if (ISSET($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmena'><a href='vrsta_kvara.php'><input type='button' value='Prekid'></a>";?>
		
		</form>
      </div>
      <div class="w3-twothird">
        <h5>Spisak</h5><input id="myInput" type="text" placeholder="Pretrazi..">
<?php
//select
$vrstaKvara=new VrstaKvara($conn);
$result = $vrstaKvara->select();
$i=1;
echo "<table style='width:100%' class='table'>";
echo "<tr><th>RB</th><th>Naziv</th><th>Obrisi</th>";
if ($result->num_rows > 0) {
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $naziv=$row['naziv'];
    echo "<tr><td style='text-align:center'>" . $i. "</td><td><a href='vrsta_kvara.php?id=".$row["id"]."&naziv=".$naziv."'>" . $row["naziv"]. "</td><td style='text-align:center'><a href='vrsta_kvara.php?delete_id=".$row["id"]."'><i style='color:red' class='fa fa-times-circle'></i></td></tr>";
  $i++;
  }
} else {
  echo "0 rezultata";
}
echo "</table>";
$conn->close();
?>
      </div>
    </div>
  </div>
<?php include "footer.php"?>

  <!-- End page content -->
</div>

</body></html>