<?php
interface iUlazRobe{
public function __construct($conn);
public function select();
public function insert($dobavljac_id,$datum_prijema,$garancija,$vrsta_robe_id,$cena_robe,$kolicina,$kvalitet_id,$napomena);
public function update($dobavljac,$datum,$garancija,$vrsta_robe,$cena,$kolicina,$kvalitet,$napomena,$id);
public function delete($id);
}
?>