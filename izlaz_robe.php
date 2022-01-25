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
include "classes/izlaz_robe.php";
include "topbar.php";
include "menu.php";
?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

<?php include "header.php";
if (ISSET($_GET['izlaz_id'])) $_SESSION['izlaz_id']=$_GET['izlaz_id'];
if (ISSET($_GET['vrsta_robe'])) {
	$_SESSION['ulaz_id']=$_GET['ulaz_id'];
	$_SESSION['vrsta_robe']=$_GET['vrsta_robe'];
	};
include "connect.php";
 
//update
if (ISSET($_POST['izmena'])){
	$izlazRobe=new IzlazRobe($conn);
	$izlazRobe->radnik_id=htmlspecialchars($_POST['radnik']);
	$izlazRobe->datum=htmlspecialchars($_POST['datum']);
	$izlazRobe->vreme=htmlspecialchars($_POST['vreme']);	
	$izlazRobe->svrha_izdavanja_id=htmlspecialchars($_POST['svrha_izdavanja']);
	$izlazRobe->kolicina=htmlspecialchars($_POST['kolicina']);
	$izlazRobe->vrsta_kvara_id=htmlspecialchars($_POST['vrsta_kvara']);	
	$izlazRobe->status_id=htmlspecialchars($_POST['status']);
	$izlazRobe->stanje_id=htmlspecialchars($_POST['stanje']);
	$izlazRobe->napomena=htmlspecialchars($_POST['napomena']);
	$izlazRobe->id=htmlspecialchars($_POST['id']);
    $izlazRobe->update($izlazRobe->radnik_id,$izlazRobe->datum,$izlazRobe->vreme,$izlazRobe->svrha_izdavanja_id,$izlazRobe->kolicina,$izlazRobe->vrsta_kvara_id,$izlazRobe->status_id,$izlazRobe->stanje_id,$izlazRobe->napomena,$izlazRobe->id); 
}

//delete
if (ISSET($_GET['delete_id'])){		
	$izlazRobe=new IzlazRobe($conn);
	$izlazRobe->id=htmlspecialchars($_GET['delete_id']);
	$izlazRobe->delete($izlazRobe->id);
}

//insert
if (ISSET($_POST['unos'])){	
	$izlazRobe=new IzlazRobe($conn);
	$izlazRobe->radnik_id=htmlspecialchars($_POST['radnik']);
	$izlazRobe->datum=htmlspecialchars($_POST['datum']);
	$izlazRobe->vreme=htmlspecialchars($_POST['vreme']);		
	$izlazRobe->svrha_izdavanja_id=htmlspecialchars($_POST['svrha_izdavanja']);
	$izlazRobe->kolicina=htmlspecialchars($_POST['kolicina']);
	$izlazRobe->vrsta_kvara_id=htmlspecialchars($_POST['vrsta_kvara']);	
	$izlazRobe->status_id=htmlspecialchars($_POST['status']);
	$izlazRobe->stanje_id=htmlspecialchars($_POST['stanje']);
	$izlazRobe->napomena=htmlspecialchars($_POST['napomena']);
	$izlazRobe->insert($izlazRobe->radnik_id,$izlazRobe->datum,$izlazRobe->vreme,$izlazRobe->svrha_izdavanja_id,$izlazRobe->kolicina,$izlazRobe->vrsta_kvara_id,$izlazRobe->status_id,$izlazRobe->stanje_id,$izlazRobe->napomena);
}

?>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Izlaz robe:
		<?php if (ISSET($_SESSION['ulaz_id']) || ISSET($_GET['id']) && ISSET($_SESSION['vrsta_robe'])) {
			IF (ISSET($_SESSION['ulaz_id']) && ISSET($_SESSION['vrsta_robe'])) echo $_SESSION['vrsta_robe'];
			IF (ISSET($_GET['vrsta_robe']) && !ISSET($_SESSION['ulaz_id'])) echo $_GET['vrsta_robe'];
			?>
		</h5>
		<form method='post' action='#'>
		<?php 
		$sql = "SELECT id, CONCAT(ime, ' ', prezime) as naziv FROM mgc_radnici";
		$result = $conn->query($sql);		
		?>
		<table>
		
		<tr><td>Radnik:</td><td><select name='radnik'>
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
 		<tr><td>Datum izdavanja/zaduzenja robe:</td><td><input type='date' name='datum'  required value='<?php if (ISSET($_GET['id'])) {echo $_GET['datum_izdavanja'];}?>'></td></tr>
		<tr><td>Vreme izdavanja/zaduzenja robe</td><td><input type="time" id="appt" name="vreme"  required value='<?php if (ISSET($_GET['id'])) {echo $_GET['vreme_izdavanja'];}?>'></td></tr>
		
<?php 
		$sql = "SELECT id, naziv FROM mgc_svrha_izdavanja";
		$result = $conn->query($sql);		
		?>
		<tr><td>Svrha izdavanja:</td><td><select name='svrha_izdavanja'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['svrha_izdavanja_id']) {$selected='selected';}
	else $selected='';
    echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select>
		</td></tr>	
		
	<?php 
		$sql = "SELECT id, naziv FROM mgc_vrsta_kvara";
		$result = $conn->query($sql);		
		?>
		<tr><td>Vrsta kvara:</td><td><select name='vrsta_kvara'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['vrsta_kvara_id']) {$selected='selected';}
	else $selected='';
    echo "<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select>
		</td></tr>		
		
		<tr><td>Kolicina robe:</td><td><input type='text' name='kolicina' required value='<?php if (ISSET($_GET['id'])) {echo $_GET['kolicina'];}?>'></td><tr>
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
	if ($row['id']==$_GET['stanje']) {$selected='selected';}
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
		<?php if (ISSET($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmena'><a href='izlaz_robe.php'><input type='button' value='Prekid'></a>";?>
		
		</form>
		<?php }
		else echo "<br>Odaberite izlaz robe iz opcije Ulaz robe";
		?>
      </div>
      <div class="w3-twothird">
        <h5>Spisak</h5><input id="myInput" type="text" placeholder="Pretrazi..">
<?php
//select
$izlazRobe=new IzlazRobe($conn); 
$result = $izlazRobe->select();
$i=1;
echo "<table style='width:100%' id='myTable' class='table'>";
echo "<tr><th>RB</th><th>Radnik</th><th>Datum izdavanja robe</th><th>Vreme izdavanja</th><th>Vrsta robe</th><th>Brisanje</th><th>Vrati robu</th>";
if ($result->num_rows > 0) {
	
  // output data of each row
  while($row = $result->fetch_assoc()) {	  
    echo "<tr><td style='text-align:center'>" . $i. "</td><td><a href='izlaz_robe.php?id=".$row["izlaz_id"]."&radnik_id=".$row['radnik_id']."&datum_izdavanja=".$row['datum_izdavanja']."&vreme_izdavanja=".$row['vreme_izdavanja']."&vrsta_robe_id=".$row['vrsta_robe_id']."&svrha_izdavanja_id=".$row['svrha_izdavanja_id']."&vrsta_kvara_id=".$row['vrsta_kvara_id']."&kolicina=".$row['kolicina']."&status_id=".$row['status_id']."&napomena=".$row['napomena']."&stanje=".$row['stanje_id']."&izlaz_id=".$row['izlaz_id']."&ulaz_id=".$row['ulaz_id']."&vrsta_robe=".$row['vrsta_robe']."'>" . $row["imeradnika"]. "</td><td>" .date_format (new DateTime($row['datum_izdavanja']), 'd.m.Y') . "<td>" . $row["vreme_izdavanja"]. "</td><td>" . $row["vrsta_robe"]. "</td><td style='text-align:center'><a href='izlaz_robe.php?delete_id=".$row["izlaz_id"]."'><i style='color:red' class='fa fa-times-circle'></i></td><td><a href='vracena_roba.php?ulaz_id=".$row['ulaz_id']."&vrsta_robe=".$row['vrsta_robe']."'><button type='button' class='btn btn-success'>Vrati robu</button></a></td></tr>";
  $i++;
  }
} else {
  echo "0 rezultata";
}
echo "</table>";

?>
      </div>
    </div>
  </div>

<?php include "footer.php"?>

  <!-- End page content -->
</div>
</body></html>