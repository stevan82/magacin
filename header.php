 
 <!DOCTYPE html>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8">
 <title>Magacin</title>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/w3.css">
<link rel="stylesheet" href="/fontawesome/css/all.css">
<link rel="stylesheet" href="/fontawesome/css/fontawesome.css"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
table {
  border-collapse: collapse;
}
th {background-color:#B3DBFA;text-align: center;!IMPORTANT}
tr {padding:5px!IMPORTANT}
#myTable tr:hover  {background-color: lightGray;}
input[type=text]:focus {
  border: 3px solid #555;
}
</style>  
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>  
  
<?php 
include "connect.php";
$sql = "SELECT count(*) as total from mgc_ulaz_robe WHERE YEAR(datum_prijema)=".$_SESSION['godina'];
		$result = $conn->query($sql);
		$data=$result->fetch_assoc();
		$ulaz=$data['total'];
$sql = "SELECT count(*) as total from mgc_izlaz_robe WHERE YEAR(datum_izdavanja)=".$_SESSION['godina'];
		$result = $conn->query($sql);
		$data=$result->fetch_assoc();
		$izlaz=$data['total'];
$sql = "SELECT count(*) as total from mgc_vracena_roba WHERE YEAR(datum_vracanja)=".$_SESSION['godina'];
		$result = $conn->query($sql);
		$data=$result->fetch_assoc();
		$vraceno=$data['total'];
?>  
  
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Statistika</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-calendar w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $_SESSION['godina']?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Godina</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $ulaz?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Broj ulaza</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $izlaz;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Broj izlaza</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo $vraceno;?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Vracena roba</h4>
      </div>
    </div>
  </div>