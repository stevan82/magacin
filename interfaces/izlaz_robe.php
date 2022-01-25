<?php
interface iIzlazRobe{
public function __construct($conn);
public function select();
public function insert($radnik,$datum,$vreme,$svrha_izdavanja,$kolicina,$vrsta_kvara,$status,$stanje,$napomena);
public function update($radnik,$datum,$vreme,$svrha_izdavanja,$kolicina,$vrsta_kvara,$status,$stanje,$napomena,$id);
public function delete($id);
}
?>