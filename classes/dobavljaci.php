<?php

include "interfaces/default.php";


class Dobavljaci implements iDefault {
  // Properties
  public $id;
  public $naziv;
  public $conn;

  // Methods
  function __construct($conn) {
    $this->conn = $conn;
  }
  function select(){
  $sql = "SELECT id,naziv FROM mgc_dobavljaci";
  $result = $this->conn->query($sql);  
  return $result;  
  }
  function insert($naziv){
  $sql = "INSERT INTO mgc_dobavljaci (naziv) VALUES ('".$naziv."')";

if ($this->conn->query($sql) === TRUE) {
  echo "Podatak uspesno unet";
} else {
  echo "Greska: " . $sql . "<br>" . $this->conn->error;
}
  }
  function update($naziv,$id){
  $sql = "UPDATE mgc_dobavljaci SET naziv='".$naziv."' WHERE id=".$id;

  if ($this->conn->query($sql) === TRUE) {
  echo "Podatak uspesno izmenjen";
} else {
  echo "Greska: " . $this->conn->error;
}  
}
 function delete($id){
$sql = "DELETE FROM mgc_dobavljaci WHERE id= ('".$id."')";

if ($this->conn->query($sql) === TRUE) {
  echo "Podatak uspesno obrisan";
} else {
  echo "Error: " . $sql . "<br>" . $this->conn->error;
}
 }
  
}
?>