<style>
table {border-collapse: collapse;}
th,td{border:1px solid black;}
th {background-color:lightGray}
</style>

<?php
include "connect.php";
$sql = "
SELECT * FROM (
SELECT mgc_ulaz_robe.id as ulaz_id1,'1' as rb,'' as stanje,'' as datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja,datum_izdavanja,'Ulaz' AS status_robe,'' AS stanje_robe FROM mgc_izlaz_robe RIGHT JOIN mgc_ulaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_izlaz_robe.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id LEFT JOIN mgc_svrha_izdavanja ON mgc_svrha_izdavanja.id=mgc_izlaz_robe.svrha_izdavanja_id LEFT JOIN mgc_status_robe ON mgc_izlaz_robe.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_izlaz_robe.stanje_id=mgc_stanje_robe.id 
WHERE mgc_vrsta_robe.id=".$_GET['roba']." AND YEAR(datum_izdavanja)=".$_GET['godina'].
" UNION
SELECT mgc_izlaz_robe.ulaz_id as ulaz_id1 ,'2' as rb,mgc_stanje_robe.naziv as stanje,'' as datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja,datum_izdavanja,mgc_status_robe.naziv AS status_robe,mgc_stanje_robe.naziv AS stanje_robe FROM mgc_izlaz_robe RIGHT JOIN mgc_ulaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_izlaz_robe.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id LEFT JOIN mgc_svrha_izdavanja ON mgc_svrha_izdavanja.id=mgc_izlaz_robe.svrha_izdavanja_id LEFT JOIN mgc_status_robe ON mgc_izlaz_robe.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_izlaz_robe.stanje_id=mgc_stanje_robe.id 
WHERE mgc_vrsta_robe.id=".$_GET['roba']." AND YEAR(datum_izdavanja)=".$_GET['godina'].
" UNION
SELECT mgc_vracena_roba.ulaz_id as ulaz_id1,'3' as rb,mgc_stanje_robe.naziv as stanje,datum_vracanja,concat(ime,' ',prezime) as ime,mgc_vrsta_robe.naziv as vrsta_robe,mgc_dobavljaci.naziv AS dobavljac,mgc_kvalitet_robe.naziv as kvalitet,cena_robe,mgc_svrha_izdavanja.naziv as svrha_izdavanja, datum_izdavanja,mgc_status_robe.naziv AS status_robe,mgc_stanje_robe.naziv AS stanje_robe FROM mgc_vracena_roba RIGHT JOIN mgc_ulaz_robe ON mgc_vracena_roba.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_radnici ON mgc_radnici.id=mgc_vracena_roba.radnik_id LEFT JOIN mgc_vrsta_robe ON mgc_ulaz_robe.vrsta_robe_id=mgc_vrsta_robe.id LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id LEFT JOIN mgc_kvalitet_robe ON mgc_ulaz_robe.kvalitet_id=mgc_kvalitet_robe.id  LEFT JOIN mgc_status_robe ON mgc_vracena_roba.status_id=mgc_status_robe.id LEFT JOIN mgc_stanje_robe ON mgc_vracena_roba.stanje_id=mgc_stanje_robe.id LEFT JOIN mgc_izlaz_robe ON mgc_izlaz_robe.ulaz_id=mgc_vracena_roba.ulaz_id LEFT JOIN mgc_svrha_izdavanja ON mgc_izlaz_robe.svrha_izdavanja_id=mgc_svrha_izdavanja.id
WHERE mgc_vrsta_robe.id=".$_GET['roba']." AND YEAR(datum_vracanja)=".$_GET['godina'].
") p order by p.ulaz_id1,p.rb";

$result = $conn->query($sql);
$i=1;
echo "<table border=1' style='width:100%'>";
echo "<tr><th>RB</th><th>Radnik</th><th>Vrsta robe</th><th>Dobavljac</th><th>Kvalitet robe</th><th>Cena</th><th>Masina</th><th>Datum zaduzenja</th><th>Status robe</th><th>Stanje izdate robe</th><th>Datum vracanja</th>";
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
    echo "<tr><td style='text-align:center'>" . $i. "</td><td>" . $row["ime"]. "</td><td>" . $row["vrsta_robe"]. "</td><td>" . $row["dobavljac"]. "</td><td>" . $row["kvalitet"]. "</td><td>" . $row["cena_robe"]. "</td><td>" . $row["svrha_izdavanja"]. "</td><td>" . $datum_izdavanja. "</td><td>" . $row["status_robe"]. "</td><td>" . $row["stanje"]. "</td><td>" . $datum_vracanja. "</td></tr>";
  $i++;
  }
} else {
  echo "0 results";
}
echo "</table>";

$conn->close();


?>