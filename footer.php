  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>www.taraba.in.rs</h4>
    <p>Powered by <a href="www.taraba.in.rs" target="_blank">Stevan Nikolic</a></p>
  </footer>
  
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