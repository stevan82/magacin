<?php
interface iVracenaRoba{
public function __construct($conn);
public function select();
public function insert($radnik,$datum,$vreme,$status,$napomena,$stanje);
public function update($radnik,$datum,$vreme,$status,$napomena,$stanje,$id);
public function delete($id);
}
?>