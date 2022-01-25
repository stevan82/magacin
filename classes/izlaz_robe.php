<?php
include "interfaces/izlaz_robe.php";

class IzlazRobe implements iIzlazRobe{
  // Properties
  public $id;
  public $radnik_id;
  public $datum_izdavanja;
  public $vreme_izdavanja;
  public $svrha_izdavanja_id;
  public $vrsta_kvara_id;
  public $kolicina;
  public $stanje_id;
  public $status_id;
  public $napomena;
  public $ulaz_id;

  // Methods
  function __construct($conn) {
    $this->conn = $conn;
  }
  function select(){
  $sql ="SELECT ulaz_id,status_id,mgc_izlaz_robe.napomena,mgc_izlaz_robe.kolicina,vrsta_kvara_id,stanje_id,svrha_izdavanja_id,mgc_ulaz_robe.vrsta_robe_id,vreme_izdavanja,datum_izdavanja,radnik_id,mgc_izlaz_robe.id AS izlaz_id,concat(ime,' ',prezime) as imeradnika, datum_izdavanja,vreme_izdavanja,mgc_vrsta_robe.naziv as vrsta_robe FROM mgc_izlaz_robe LEFT JOIN mgc_radnici ON mgc_izlaz_robe.radnik_id=mgc_radnici.id LEFT JOIN mgc_ulaz_robe ON mgc_ulaz_robe.id=mgc_izlaz_robe.ulaz_id LEFT JOIN mgc_vrsta_robe ON mgc_vrsta_robe.id=mgc_ulaz_robe.vrsta_robe_id  WHERE YEAR(datum_izdavanja)=".$_SESSION['godina'];
  $result = $this->conn->query($sql);  
  return $result;  
  }
  function insert($radnik,$datum,$vreme,$svrha_izdavanja,$kolicina,$vrsta_kvara,$status,$stanje,$napomena){
  $sql = "INSERT INTO mgc_izlaz_robe (radnik_id,datum_izdavanja,vreme_izdavanja,svrha_izdavanja_id,vrsta_kvara_id,kolicina,status_id,napomena,ulaz_id) VALUES ('".$radnik."','".$datum."','".$vreme."','".$svrha_izdavanja."','".$vrsta_kvara."','".$kolicina."','".$status."','".$napomena."','".$_SESSION['ulaz_id']."')";
if ($this->conn->query($sql) === TRUE) {
    ?>  
  <div class="alert alert-success" role="alert">
  Podatak uspesno unet!
  </div>
<?php 
} else {
?>
  <div class="alert alert-danger" role="alert">
  <?php echo "Greska: " . $sql . "<br>" . $this->conn->error;?>
  </div>	
<?php   
}
  }
  function update($radnik,$datum,$vreme,$svrha_izdavanja,$kolicina,$vrsta_kvara,$status,$stanje,$napomena,$id){
  $sql = "UPDATE mgc_izlaz_robe SET radnik_id='".$radnik."',datum_izdavanja='".$datum."',vreme_izdavanja='".$vreme."',svrha_izdavanja_id='".$svrha_izdavanja."',vrsta_kvara_id='".$vrsta_kvara."',kolicina='".$kolicina."',status_id='".$status."',napomena='".$napomena."',stanje_id='".$stanje."' WHERE id=".$id;
if ($this->conn->query($sql) === TRUE) {
    ?>  
  <div class="alert alert-success" role="alert">
  Podatak uspesno izmenjen!
  </div>
<?php 
} else {
	?>
  <div class="alert alert-danger" role="alert">
  <?php echo "Greska: " . $sql . "<br>" . $this->conn->error;?>
  </div>	
<?php  
} 
}
 function delete($id){
$sql = "DELETE FROM mgc_izlaz_robe WHERE id= ('".$id."')";

if ($this->conn->query($sql) === TRUE) {
    ?>  
  <div class="alert alert-success" role="alert">
  Podatak uspesno obrisan!
  </div>
<?php 
} else {
	?>
  <div class="alert alert-danger" role="alert">
  <?php echo "Greska: " . $sql . "<br>" . $this->conn->error;?>
  </div>	
<?php  
}
}
  
}
?>