
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
include "classes/vracena_roba.php";
include "topbar.php";
include "menu.php";
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php 
include "header.php";
include "connect.php";

if (ISSET($_GET['ulaz_id'])){
	$_SESSION['ulaz_id']=$_GET['ulaz_id'];
	$_SESSION['vrsta_robe']=$_GET['vrsta_robe'];	
}

//update
if (ISSET($_POST['izmena'])){
$vracenaRoba=new VracenaRoba($conn);
	$vracenaRoba->radnik_id=htmlspecialchars($_POST['radnik']);
	$vracenaRoba->datum=htmlspecialchars($_POST['datum']);
	$vracenaRoba->vreme=htmlspecialchars($_POST['vreme']);			
	$vracenaRoba->status_id=htmlspecialchars($_POST['status']);
	$vracenaRoba->napomena=htmlspecialchars($_POST['napomena']);
	$vracenaRoba->stanje_id=htmlspecialchars($_POST['stanje']);
	$vracenaRoba->id=htmlspecialchars($_POST['id']);
		
		$vracenaRoba->update(
			$vracenaRoba->radnik_id,
			$vracenaRoba->datum,
			$vracenaRoba->vreme,
			$vracenaRoba->status_id,
			$vracenaRoba->napomena,
			$vracenaRoba->stanje_id,
			$vracenaRoba->id
		);
}
//delete
if (ISSET($_GET['delete_id'])){	
	$vracenaRoba=new VracenaRoba($conn);
	$vracenaRoba->id=htmlspecialchars($_GET['delete_id']);
	$vracenaRoba->delete($vracenaRoba->id);
}
//insert
if (ISSET($_POST['unos'])){
	$vracenaRoba=new VracenaRoba($conn);
	$vracenaRoba->radnik_id=htmlspecialchars($_POST['radnik']);
	$vracenaRoba->datum=htmlspecialchars($_POST['datum']);
	$vracenaRoba->vreme=htmlspecialchars($_POST['vreme']);			
	$vracenaRoba->status_id=htmlspecialchars($_POST['status']);
	$vracenaRoba->stanje_id=htmlspecialchars($_POST['stanje']);
	$vracenaRoba->napomena=htmlspecialchars($_POST['napomena']);
	$vracenaRoba->insert(
		$vracenaRoba->radnik_id,
		$vracenaRoba->datum,
		$vracenaRoba->vreme,
		$vracenaRoba->status_id,
		$vracenaRoba->napomena,
		$vracenaRoba->stanje_id
		);
} 
?>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Vraćena roba:
		<?php if (ISSET($_SESSION['vrsta_robe']) || ISSET($_GET['id'])) {
			IF (ISSET($_SESSION['ulaz_id'])) echo $_SESSION['vrsta_robe'];
			IF (ISSET($_GET['vrsta_robe']) && !ISSET($_SESSION['ulaz_id'])) echo $_GET['vrsta_robe'];
			?>			
		</h5>
		<form method='post' action='#'>
		<?php 
		$sql = "SELECT id, CONCAT(ime, ' ', prezime) as naziv FROM mgc_radnici";
		$result = $conn->query($sql);		
		?>
		<table>
		<tr><td>Radnik:</tr><td><select name='radnik'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['id']==$_GET['radnik_id']) {$selected='selected';}
		else $selected='';
		echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
		}
	}
?>
		</select>
		</td></tr>
        
		<tr><td>Datum vracanja robe:</td><td><input type='date'  required name='datum' value='<?php if (ISSET($_GET['id'])) {echo $_GET['datum_vracanja'];}?>'></td></tr>
		<tr><td>Vreme vracanja robe:</td><td><input type="time"  required id="appt" name="vreme" value='<?php if (ISSET($_GET['id'])) {echo $_GET['vreme_vracanja'];}?>'></td></tr>
		
			<?php 
		$sql = "SELECT id, naziv FROM mgc_status_robe";
		$result = $conn->query($sql);		
		?>
		<tr><td>Status robe:</td><td><select name='status'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['status_id']) {$selected='selected';}
	else $selected='';
    echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select>
		</td></tr>
	
	   <?php 
		$sql = "SELECT id, naziv FROM mgc_stanje_robe";
		$result = $conn->query($sql);		
		?>
		<tr><td>Stanje robe:</td><td><select name='stanje'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['stanje_id']) {$selected='selected';}
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
		<?php if (ISSET($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmena'><a href='vracena_roba.php'><input type='button' value='Prekid'></a>";?>
		
		</form>
		<?php }
		else echo "<br>Odaberite Vrati robu iz opcije Izlaz robe";
		?>
      </div>
      <div class="w3-twothird">
        <h5>Spisak</h5><input id="myInput" type="text" placeholder="Pretrazi..">
<?php
//select
$vracenaRoba=new VracenaRoba($conn);
$result = $vracenaRoba->select();
$i=1;
echo "<table style='width:100%' id='myTable' class='table'>";
echo "<tr><th>RB</th><th>Radnik</th><th>Datum izdavanja robe</th><th>Vreme izdavanja</th><th>Vrsta robe</th><th>Brisanje</th>";
if ($result->num_rows > 0) {
	
  // ispisi svaki red
  while($row = $result->fetch_assoc()) {	  
    echo "<tr><td style='text-align:center'>" . $i. "</td><td><a href='vracena_roba.php?id=".$row["vraceno_id"]."&radnik_id=".$row['radnik_id']."&datum_vracanja=".$row['datum_vracanja']."&vreme_vracanja=".$row['vreme_vracanja']."&vrsta_robe_id=".$row['vrsta_robe_id']."&status_id=".$row['status_id']."&stanje_id=".$row['stanje_id']."&napomena=".$row['napomena']."&vrsta_robe=".$row['vrsta_robe']."'>" . $row["imeradnika"]. "</td><td>" .date_format (new DateTime($row['datum_vracanja']), 'd.m.Y') . "<td>" . $row["vreme_vracanja"]. "</td><td>" . $row["vrsta_robe"]. "</td><td style='text-align:center'><a href='vracena_roba.php?delete_id=".$row["vraceno_id"]."'><i style='color:red' class='fa fa-times-circle'></i></td></tr>";
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