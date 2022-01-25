<?php
class Radnik {
  // Properties
  public $id;
  public $ime;
  public $prezime;
  public $conn;

  // Methods
  function __construct($conn) {
    $this->conn = $conn;
  }
  function select(){
  $sql = "SELECT id,ime,prezime FROM mgc_radnici";
  $result = $this->conn->query($sql);  
  return $result;  
  }
  function insert($ime,$prezime){
  $sql = "INSERT INTO mgc_radnici (ime,prezime) VALUES ('".$ime."','".$prezime."')";

if ($this->conn->query($sql) === TRUE) {
  echo "Podatak uspesno unet";
} else {
  echo "Greska: " . $sql . "<br>" . $this->conn->error;
}
  }
  function update($ime,$prezime,$id){
  $sql = "UPDATE mgc_radnici SET ime='".$ime."',prezime='".$prezime."' WHERE id=".$id;

  if ($this->conn->query($sql) === TRUE) {
  echo "Podaci o radniku uspesno izmenjeni";
} else {
  echo "Greska: " . $this->conn->error;
}	  
	  
}
 function delete($id){
 $sql = "DELETE FROM mgc_radnici WHERE id= ('".$id."')";

  if ($this->conn->query($sql) === TRUE) {
  echo "Podatak uspesno obrisan";
} else {
  echo "Greska: " . $sql . "<br>" . $this->conn->error;
}
 }
  function topRadnik($limit){
  $sql = "SELECT id,ime,prezime FROM mgc_radnici LIMIT ".$limit;
  $result = $this->conn->query($sql);  
  return $result;  
  }
  
}
?>