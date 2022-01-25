<?php
include "interfaces/vracena_roba.php";

class VracenaRoba implements iVracenaRoba{
  // Properties
  public $id;
  public $radnik_id;
  public $datum_vracanja;
  public $vreme_vracanja;
  public $status_id;
  public $stanje_id;
  public $napomena;
  public $conn;

  // Methods
  function __construct($conn) {
    $this->conn = $conn;
  }
  function select(){
  $sql ="SELECT status_id,mgc_vracena_roba.napomena,mgc_ulaz_robe.vrsta_robe_id,stanje_id,vreme_vracanja,datum_vracanja,radnik_id,mgc_vracena_roba.id AS vraceno_id,concat(ime,' ',prezime) as imeradnika, datum_vracanja,vreme_vracanja,mgc_vrsta_robe.naziv as vrsta_robe FROM mgc_vracena_roba LEFT JOIN mgc_radnici ON mgc_vracena_roba.radnik_id=mgc_radnici.id LEFT JOIN mgc_ulaz_robe ON mgc_vracena_roba.ulaz_id=mgc_ulaz_robe.id LEFT JOIN mgc_vrsta_robe ON mgc_vrsta_robe.id=mgc_ulaz_robe.vrsta_robe_id WHERE YEAR(datum_vracanja)=".$_SESSION['godina'];
  $result = $this->conn->query($sql);  
  return $result;  
  }
  function insert($radnik,$datum,$vreme,$status,$napomena,$stanje){
  $sql = "INSERT INTO mgc_vracena_roba (radnik_id,datum_vracanja,vreme_vracanja,status_id,stanje_id,napomena,ulaz_id) VALUES ('".$radnik."','".$datum."','".$vreme."','".$status."','".$stanje."','".$napomena."','".$_SESSION['ulaz_id']."')";
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
  function update($radnik,$datum,$vreme,$status,$napomena,$stanje,$id){
  $sql = "UPDATE mgc_vracena_roba SET radnik_id='".$radnik."',datum_vracanja='".$datum."',vreme_vracanja='".$vreme."',status_id='".$status."',stanje_id='".$stanje."',napomena='".$napomena."' WHERE id=".$_POST['id'];
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
$sql = "DELETE FROM mgc_vracena_roba WHERE id= ('".$id."')";

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