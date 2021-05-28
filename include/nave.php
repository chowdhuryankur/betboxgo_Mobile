<?php 
$user = $user->row(0); 
$balance = $balance->row(0); 
?>nav
<nav class="w3-sidebar w3-bar-block w3-collapse w3-animate-left w3-card w3-black w3-border-top w3-border-teal menu" style="z-index:3;width:250px; margin-top:7px; padding-top:3px; display:none;" id="mySidebar">
   <div class="w3-bar w3-bottombar w3-border-teal w3-large w3-padding-small menu">
  	<div class="w3-row">
  		<div class="w3-col s6 w3-left">REMANING</div>
  		<div class="w3-col s5 w3-left"><?=$currency?><?=$balance->remaning_amount?></div>
	</div> 
    <div class="w3-row">
  		<div class="w3-col s6 w3-left">IN STAKE</div>
  		<div class="w3-col s6 w3-left"><span class="aciveMenu"><?=$currency.$balance->betting_amount?></span></div>
	</div> 
    <p> </p>
   </div>
   <div class="w3-xlarge">
   	  <?php echo anchor("home/live/pg/all", "<i class='fa fa-chevron-right' aria-hidden='true'></i> LIVE GAMES", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("home/today/pg/all", "<i class='fa fa-chevron-right' aria-hidden='true'></i> TODAY'S GAMES", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("home/tomorow/pg/all", "<i class='fa fa-chevron-right' aria-hidden='true'></i> TOMMOROW'S GAMES", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("game/betslip", "<i class='fa fa-chevron-right' aria-hidden='true'></i> BET SLIP", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("balance/cash_in", "<i class='fa fa-chevron-right' aria-hidden='true'></i> DEPOSIT", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("balance/cash_out", "<i class='fa fa-chevron-right' aria-hidden='true'></i> WITHDRAW", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("balance/transfer", "<i class='fa fa-chevron-right' aria-hidden='true'></i> TRANSFER", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("history", "<i class='fa fa-chevron-right' aria-hidden='true'></i> HISTORY", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("user/profile", "<i class='fa fa-chevron-right' aria-hidden='true'></i> PROFILE", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("user/setting", "<i class='fa fa-chevron-right' aria-hidden='true'></i> SETTING", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("support/msg", "<i class='fa fa-chevron-right' aria-hidden='true'></i> SUPPORT", array("class"=>"w3-bar-item w3-button")); ?>
      <?php echo anchor("support/faq", "<i class='fa fa-chevron-right' aria-hidden='true'></i> FAQ", array("class"=>"w3-bar-item w3-button")); ?>
      </div>
</nav>
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<script>
// Open and close the sidebar on medium and small screens
function w3_open() {
	if(document.getElementById("mySidebar").style.display == "none")
	{
    	document.getElementById("mySidebar").style.display = "block";
    	document.getElementById("myOverlay").style.display = "block";
	}
	else
	{
		document.getElementById("mySidebar").style.display = "none"
		document.getElementById("myOverlay").style.display = "none";
	}
}
function w3_close() {
    if(document.getElementById("mySidebar").style.display == "block")
	{
    	document.getElementById("mySidebar").style.display = "none";
    	document.getElementById("myOverlay").style.display = "none";
	}
}


// Change style of top container on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("myTop").classList.add("w3-card-4", "w3-animate-opacity");
       // document.getElementById("myIntro").classList.add("w3-show-inline-block");
    } else {
        // document.getElementById("myIntro").classList.remove("w3-show-inline-block");
        document.getElementById("myTop").classList.remove("w3-card-4", "w3-animate-opacity");
    }
	
	var topBtn = document.getElementById("topBtn");
	
	if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
    	topBtn.style.display = "block";
  	} else {
    	topBtn.style.display = "none";
  	}
}
function topFunction() {
	$("html, body").animate( 
    { scrollTop: "0" }, 1000); 
    //document.body.scrollTop = 0;
    //document.documentElement.scrollTop = 0;
}
// Accordions
function myAccordion(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme", "");
    }
}


</script>