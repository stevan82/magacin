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
include "topbar.php";
include "menu.php";
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php 
include "classes/ulaz_robe.php";
include "header.php";
if (ISSET($_GET['id'])) $_SESSION['ulaz_id']=$_GET['id'];
include "connect.php";

//update
if (ISSET($_POST['izmena'])){	 
$ulazRobe=new UlazRobe($conn);
	$ulazRobe->dobavljac_id=htmlspecialchars($_POST['dobavljac']);
	$ulazRobe->datum=htmlspecialchars($_POST['datum']);
	$ulazRobe->garancija=htmlspecialchars($_POST['garancija']);
	$ulazRobe->vrsta_robe_id=htmlspecialchars($_POST['vrsta_robe']);
	$ulazRobe->cena=htmlspecialchars($_POST['cena']);
	$ulazRobe->kolicina=htmlspecialchars($_POST['kolicina']);
	$ulazRobe->kvalitet_id=htmlspecialchars($_POST['kvalitet']);
	$ulazRobe->napomena=htmlspecialchars($_POST['napomena']);
	$ulazRobe->id=htmlspecialchars($_POST['id']);
	$ulazRobe->update($ulazRobe->dobavljac_id,$ulazRobe->datum,$ulazRobe->garancija,$ulazRobe->vrsta_robe_id,$ulazRobe->cena,$ulazRobe->kolicina,$ulazRobe->kvalitet_id,$ulazRobe->napomena,$ulazRobe->id);
}

//delete
if (ISSET($_GET['delete_id'])){	;
	$ulazRobe=new UlazRobe($conn);
	$ulazRobe->id=htmlspecialchars($_GET['delete_id']);
	$ulazRobe->delete($ulazRobe->id);
}

//insert
if (ISSET($_POST['unos'])){	
	$ulazRobe=new UlazRobe($conn);
	$ulazRobe->dobavljac_id=htmlspecialchars($_POST['dobavljac']);
	$ulazRobe->datum_prijema=htmlspecialchars($_POST['datum']);
	$ulazRobe->garancija=htmlspecialchars($_POST['garancija']);
	$ulazRobe->vrsta_robe_id=htmlspecialchars($_POST['vrsta_robe']);
	$ulazRobe->cena_robe=htmlspecialchars($_POST['cena']);
	$ulazRobe->kolicina=htmlspecialchars($_POST['kolicina']);
	$ulazRobe->kvalitet_id=htmlspecialchars($_POST['kvalitet']);
	$ulazRobe->napomena=htmlspecialchars($_POST['napomena']);
	$ulazRobe->insert($ulazRobe->dobavljac_id,$ulazRobe->datum_prijema,$ulazRobe->garancija,$ulazRobe->vrsta_robe_id,$ulazRobe->cena_robe,$ulazRobe->kolicina,$ulazRobe->kvalitet_id,$ulazRobe->napomena);
}
?>
  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Ulaz robe:<?php 
		IF (ISSET($_SESSION['ulaz_id'])) echo $_SESSION['ulaz_id']?>-<?php if(ISSET($_GET['vrsta_robe'])) echo $_GET['vrsta_robe']?></h5>
		
		<form method='post' action='#'>
		<?php 
		$sql = "SELECT id, naziv FROM mgc_dobavljaci";
		$result = $conn->query($sql);		
		?>
		<table>
		
		<tr><td>Dobavljac:</td><td><select name='dobavljac'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['id']==$_GET['dobavljac_id']) {$selected='selected';}
		else $selected='';
		echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select></td></tr>
		
        
		<tr><td>Datum prijema robe:</td><td><input type='date' required name='datum' value=<?php if (ISSET($_GET['id'])) {echo $_GET['datum_prijema'];}?>></td></tr>
		<?php 
		$sql = "SELECT id, naziv FROM mgc_vrsta_robe";
		$result = $conn->query($sql);		
		?>
		
		<tr><td>Garancija:</td><td><input type='text'  required name='garancija' value='<?php if (ISSET($_GET['id'])) {echo $_GET['garancija'];}?>'></td></tr>
		<tr><td>Vrsta robe:</td><td><select name='vrsta_robe'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['vrsta_robe_id']) {$selected='selected';}
	else $selected='';
    echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select>
		</td></tr>
		
		<tr><td>Cena robe:</td><td><input type='text'  required name='cena' value='<?php if (ISSET($_GET['id'])) {echo $_GET['cena_robe'];}?>'></td></tr>
		<tr><td>Kolicina robe:</td><td><input type='text'  required name='kolicina' value='<?php if (ISSET($_GET['id'])) {echo $_GET['kolicina'];}?>'></td></tr>
		
			<?php 
		$sql = "SELECT id, naziv FROM mgc_kvalitet_robe";
		$result = $conn->query($sql);		
		?>
		<tr><td>Kvalitet robe:</td><td><select name='kvalitet'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['kvalitet_id']) {$selected='selected';}
	else $selected='';
    echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select>
		</td></tr>
		<tr><td>Napomena:</td><td><input type='text' name='napomena' value='<?php if (ISSET($_GET['id'])) {echo $_GET['napomena'];}?>'></td></tr>
		</table>
		<?php if (ISSET($_GET['id'])) echo "<input type='hidden' name='id' value=".$_GET['id'].">";?>
		<?php if (!ISSET($_GET['id'])) echo "<input type='submit' value='Unesi' name='unos'>";?>
		<?php if (ISSET($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmena'><a href='ulaz_robe.php'><input type='button' value='Prekid'></a>";?>
		
		</form>
      </div>
      <div class="w3-twothird">
        <h5>Spisak</h5><input id="myInput" type="text" placeholder="Pretrazi..">
<?php
//select
$ulazRobe=new UlazRobe($conn);
$result = $ulazRobe->select();
$i=1;
echo "<table style='width:100%' id='myTable'  class='table'";
echo "<tr><th>RB</th><th>Dobavljac</th><th>Datum prijema robe</th><th>Vrsta robe</th><th>Kolicina</th><th>Brisanje</th><th>Izlaz</th>";
if ($result->num_rows > 0) {
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $dobavljac=$row['dobavljac'];
    echo "<tr><td style='text-align:center'>" . $i. "</td><td><a href='ulaz_robe.php?id=".$row["ulaz_id"]."&dobavljac_id=".$row['dobavljac_id']."&datum_prijema=".$row['datum_prijema']."&vrsta_robe_id=".$row['vrsta_robe_id']."&cena_robe=".$row['cena_robe']."&kolicina=".$row['kolicina']."&kvalitet_id=".$row['kvalitet_id']."&napomena=".$row['napomena']."&vrsta_robe=".$row['vrsta_robe']."&garancija=".$row['garancija']."'>" . $row["dobavljac"]. "</td><td>" .date_format (new DateTime($row['datum_prijema']), 'd.m.Y') . "<td>" . $row["vrsta_robe"]. "</td><td>" . $row["kolicina"]. "</td><td style='text-align:center'><a href='ulaz_robe.php?delete_id=".$row["ulaz_id"]."'><i style='color:red' class='fa fa-times-circle'></i></td><td><a href='izlaz_robe.php?ulaz_id=".$row["ulaz_id"]."&vrsta_robe=".$row["vrsta_robe"]."'><button type='button' class='btn btn-success'>Izlaz robe</button></a></td></tr>";
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