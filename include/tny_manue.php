 <!-- Start Top Tiny manu -->
    <div class="w3-bar w3-bottombar w3-border-teal w3-dark-grey w3-large w3-padding-small ndenu">
      <div class="w3-left"> 
      <span id="time" class="w3-opacity po">TIME</span> | 
      <span id="myGame" class="w3-opacity po <?=$mygame?>">MY GAME</span> 
      </div>
      <div class="w3-right"> 
      <span id="live" class="w3-opacity po <?=$live?>">LIVE</span> | 
      <span id="today" class="w3-opacity po <?=$today?>">TODAY</span> | 
      <span id="betSlip" class="w3-opacity po <?=$betSlip?>">BET SLIP</span> 
      </div>
    </div>
    <!-- End Top Tiny manu -->
<script type="application/javascript">
$("#live").click(function(){
  if($("#live").hasClass("aciveMenu"))
  {
	  $('#matchList').load("<?=base_url()?>home/live/aj/"+tpMenu);
  }
  else
  {
	  $("#live").removeClass("w3-opacity").addClass("aciveMenu");
	  $("#today").removeClass("aciveMenu").addClass("w3-opacity");
	  $("#betSlip").removeClass("aciveMenu").addClass("w3-opacity");
	  
	  $('#matchList').load("<?=base_url()?>home/live/aj/"+tpMenu);
  }
}); 

$("#today").click(function(){
  if($("#today").hasClass("aciveMenu"))
  {
	  $('#matchList').load("<?=base_url()?>home/today/aj/"+tpMenu);
  }
  else
  {
	  $("#today").removeClass("w3-opacity").addClass("aciveMenu");
	  $("#betSlip").removeClass("aciveMenu").addClass("w3-opacity");
	  $("#live").removeClass("aciveMenu").addClass("w3-opacity");
	  
	  $('#matchList').load("<?=base_url()?>home/today/aj/"+tpMenu);
  }
});
$("#betSlip").click(function(){
  if($("#betSlip").hasClass("aciveMenu"))
  {
	  document.location.href = '<?=base_url()?>game/betslip';
  }
  else
  {
	  $("#live").removeClass("aciveMenu").addClass("aciveMenu");
	  $("#today").removeClass("aciveMenu").addClass("w3-opacity");
	  $("#betSlip").removeClass("w3-opacity").addClass("w3-opacity");
	  
	  document.location.href = '<?=base_url()?>game/betslip';
  }
}); 
</script>