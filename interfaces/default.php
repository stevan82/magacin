<?php
interface iDefault{
public function __construct($conn);
public function select();
public function insert($naziv);
public function update($naziv,$id);
public function delete($id);	
}

?>