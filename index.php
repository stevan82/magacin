<?php include "session.php" ?>
<!DOCTYPE html>
<?php
include "connect.php";
include "classes/radnik.php";

?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Magacin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/w3.css">
<link rel="stylesheet" href="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/css.css">
<link rel="stylesheet" href="/fontawesome/css/fontawesome.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head><body class="w3-light-grey">

<!-- Top container -->

<?php
include "topbar.php";
include "menu.php";
?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
 <?php include "header.php"; ?>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third">
        <h5>Regions</h5>
        <img src="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/region.jpg" style="width:100%" alt="Google Regional Map">
      </div>
      <div class="w3-twothird">
        <h5>Feeds</h5>
        <table class="w3-table w3-striped w3-white">
          <tbody><tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td>New record, over 90 views.</td>
            <td><i>10 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Database error.</td>
            <td><i>15 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>New record, over 40 users.</td>
            <td><i>17 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>New comments.</td>
            <td><i>25 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Check transactions.</td>
            <td><i>28 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
            <td>CPU overload.</td>
            <td><i>35 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>New shares.</td>
            <td><i>39 mins</i></td>
          </tr>
        </tbody></table>
      </div>
    </div>
  </div>
  <hr>

  <hr>

  <div class="w3-container">
    <h5>Dobavljaci na ulazu</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
	<?php
	$sql = "SELECT DISTINCT mgc_dobavljaci.naziv as dobavljac,count(dobavljac_id) AS ukupno 
	FROM mgc_ulaz_robe 
	LEFT JOIN mgc_dobavljaci ON mgc_ulaz_robe.dobavljac_id=mgc_dobavljaci.id 
	WHERE YEAR(datum_prijema)=".date('Y')."
	GROUP BY dobavljac_id";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {	
	?>
      <tbody><tr>
        <td><?php echo $row['dobavljac']; ?></td>
        <td><?php echo $row['ukupno']; ?></td>
      </tr>
  <?php } 
}?>
    </tbody></table><br>    
  </div>
  <hr>
  <div class="w3-container">
    <h5>Skorasnji radnici</h5>
	<?php
	$radnik=new Radnik($conn);
	$result = $radnik->topRadnik(3);
	?>
    <ul class="w3-ul w3-card-4 w3-white">
	<?php
	if ($result->num_rows > 0) {	
  // ispisi svaki red
		while($row = $result->fetch_assoc()) {
	?>
      <li class="w3-padding-16">
        <img src="W3.CSS%20Template_%D0%BF%D0%BE%D0%B4%D0%B0%D1%86%D0%B8/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge"><?php echo $row['ime'].' '.$row['prezime'];?></span><br>
      </li>
	<?php }
	}else {
  echo "";
} ?>

    </ul>
  </div>
  <hr>


  <br>
  <div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
     
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>


</body></html>