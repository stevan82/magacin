<?php
include "interfaces/ulaz_robe.php";
class UlazRobe implements iUlazRobe {
  // Properties
  public $id;
  public $dobavljac_id;
  public $datum_prijema;
  public $garancija;
  public $vrsta_robe_id;
  public $cena_robe;
  public $kolicina;
  public $kvalitet_id;
  public $napomena;
  public $conn;

  // Methods
  function __construct($conn) {
    $this->conn = $conn;
  }
  function select(){
  $sql = "SELECT garancija,napomena,kvalitet_id,kolicina,dobavljac_id,vrsta_robe_id,cena_robe,mgc_ulaz_robe.id AS ulaz_id,mgc_dobavljaci.naziv AS dobavljac,datum_prijema,mgc_vrsta_robe.naziv AS vrsta_robe FROM mgc_ulaz_robe LEFT JOIN mgc_dobavljaci ON mgc_dobavljaci.id=mgc_ulaz_robe.dobavljac_id LEFT JOIN mgc_vrsta_robe ON mgc_vrsta_robe.id=mgc_ulaz_robe.vrsta_robe_id WHERE YEAR(datum_prijema)=".$_SESSION['godina'];
  $result = $this->conn->query($sql);  
  return $result;  
  }
  function insert($dobavljac_id,$datum_prijema,$garancija,$vrsta_robe_id,$cena_robe,$kolicina,$kvalitet_id,$napomena){
  $sql = "INSERT INTO mgc_ulaz_robe (dobavljac_id,datum_prijema,garancija,vrsta_robe_id,cena_robe,kolicina,kvalitet_id,napomena) VALUES ('".$dobavljac_id."','".$datum_prijema."','".$garancija."','".$vrsta_robe_id."','".$cena_robe."','".$kolicina."','".$kvalitet_id."','".$napomena."')";
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
  function update($dobavljac,$datum,$garancija,$vrsta_robe,$cena,$kolicina,$kvalitet,$napomena,$id){
  $sql = "UPDATE mgc_ulaz_robe SET dobavljac_id='".$dobavljac."',datum_prijema='".$datum."',vrsta_robe_id='".$vrsta_robe."',cena_robe='".$cena."',kolicina='".$kolicina."',kvalitet_id='".$kvalitet."',napomena='".$napomena."',garancija='".$garancija."' WHERE id=".$id;
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
$sql = "DELETE FROM mgc_ulaz_robe WHERE id= ('".$id."')";

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