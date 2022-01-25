 <?php session_start(); 
  if (!ISSET($_SESSION['username'])) header('Location: '.'login.php');	
  if (!$_SESSION["godina"]) $_SESSION["godina"]=date("Y");  
  ?>