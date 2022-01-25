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

<?php include "header.php";
include "connect.php";
?>








  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Izvestaj po svrsi izdavanja</h5>
		<form method='post' action='#'>
        
		<?php 
		$sql = "SELECT id, naziv FROM mgc_svrha_izdavanja";
		$result = $conn->query($sql);		
		?>
		<tr><td>Svrha izdavanja:</td><td><select name='masina'>
	<?php	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	if ($row['id']==$_GET['radnik_id']) {$selected='selected';}
	else $selected='';
    echo "Dobavljac:<option value=" . $row["id"]. " ".$selected.">" . $row["naziv"]. "</option> ";
	}
	}
?>
		</select><br>
		
		Godina:<input type=text name=godina>
		
		
		
		
		
		<?php if (ISSET($_GET['id'])) echo "<input type='hidden' name='id' value=".$_GET['id'].">";?>
		<?php if (!ISSET($_GET['id'])) echo "<input type='submit' value='Prikazi' name='unos'>";?>
		
		
		</form>
      </div>
      <div class="w3-twothird">
        <h5>Spisak</h5>
<?php
//select
if (ISSET($_POST['unos'])){

include "connect.php";
//prikazi podatke izvestaja
$sql = "SELECT * FROM (
SELECT mgc_ulaz_robe.id as ulaz_id1,'1' as rb,'' as stanje,'' as datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja,datum_izdavanja,'Ulaz' AS status_robe,'' AS stanje_robe FROM mgc_izlaz_robe RIGHT JOIN mgc_ulaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_izlaz_robe.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id LEFT JOIN mgc_svrha_izdavanja ON mgc_svrha_izdavanja.id=mgc_izlaz_robe.svrha_izdavanja_id LEFT JOIN mgc_status_robe ON mgc_izlaz_robe.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_izlaz_robe.stanje_id=mgc_stanje_robe.id 
WHERE mgc_dobavljaci.id=".$_POST['masina']." AND YEAR(datum_izdavanja)=".$_POST['godina'].
" UNION
SELECT mgc_izlaz_robe.ulaz_id as ulaz_id1 ,'2' as rb,mgc_stanje_robe.naziv as stanje,'' as datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja,datum_izdavanja,mgc_status_robe.naziv AS status_robe,mgc_stanje_robe.naziv AS stanje_robe FROM mgc_izlaz_robe RIGHT JOIN mgc_ulaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_izlaz_robe.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id LEFT JOIN mgc_svrha_izdavanja ON mgc_svrha_izdavanja.id=mgc_izlaz_robe.svrha_izdavanja_id LEFT JOIN mgc_status_robe ON mgc_izlaz_robe.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_izlaz_robe.stanje_id=mgc_stanje_robe.id 
WHERE mgc_dobavljaci.id=".$_POST['masina']." AND YEAR(datum_izdavanja)=".$_POST['godina'].
" UNION
SELECT mgc_vracena_roba.ulaz_id as ulaz_id1,'3' as rb,mgc_stanje_robe.naziv as stanje,datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja, datum_izdavanja,mgc_status_robe.naziv AS status_robe,mgc_stanje_robe.naziv AS stanje_robe FROM mgc_vracena_roba RIGHT JOIN mgc_ulaz_robe ON mgc_vracena_roba.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_vracena_roba.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id  LEFT JOIN mgc_status_robe ON mgc_vracena_roba.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_vracena_roba.stanje_id=mgc_stanje_robe.id LEFT JOIN mgc_izlaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_vracena_roba.ulaz_id LEFT JOIN mgc_svrha_izdavanja ON mgc_izlaz_robe.svrha_izdavanja_id=mgc_svrha_izdavanja.id
WHERE mgc_dobavljaci.id=".$_POST['masina']." AND YEAR(datum_vracanja)=".$_POST['godina'].
") p ORDER BY p.ulaz_id1,p.rb";


$result = $conn->query($sql);
$i=1;
echo "<table border=1' style='width:100%'>";
echo "<tr><th>RB</th><th>Radnik</th><th>Vrsta robe</th><th>Dobavljac</th><th>Kvalitet robe</th><th>Cena</th><th>Masina</th><th>Datum zaduzenja</th><th>Status robe</th><th>Stanje robe</th><th>Datum vracanja</th>";
if ($result->num_rows > 0) {
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
	if ($row["datum_vracanja"]!='') {
	$datum_vracanja=date("d.m.Y", strtotime($row["datum_vracanja"]));
	}
	else $datum_vracanja='';
	if ($row["datum_izdavanja"]!='') {
	$datum_izdavanja=date("d.m.Y", strtotime($row["datum_izdavanja"]));
	}
	else $datum_vracanja=''; 
    echo "<tr><td style='text-align:center'>" . $i. "</td><td>" . $row["ime"]. "</td><td>" . $row["vrsta_robe"]. "</td><td>" . $row["dobavljac"]. "</td><td>" . $row["kvalitet"]. "</td><td>" . $row["cena_robe"]. "</td><td>" . $row["svrha_izdavanja"]. "</td><td>" . $datum_izdavanja. "</td><td>" . $row["status_robe"]. "</td><td>" . $row["stanje_robe"]. "</td><td>" . $datum_vracanja. "</td></tr>";
  $i++;
  }
} else {
  echo "0 results";
}
echo "</table>";
echo "<a href='izvestaj4print.php?masina=".$_POST['masina']."&godina=".$_POST['godina']."' target='_blank'><img src='images/print.png' style='width:100px;height:100px'></a>";
$conn->close();
}

?>
      </div>
    </div>
  </div>

<?php include "footer.php"?>

  <!-- End page content -->
</div>



</body></html>