<div class="w3-container w3-theme" style="margin-top:7%; padding-top:2%;">
	<div class="w3-row">
 		 <div class="w3-col s4 m4 w3-center"> <span id="allNv" class="w3-xxlarge aciveMenu po">ALL </span></div>
         <div class="w3-col s4 m4 w3-center"> <span id="criNv" class="w3-xxlarge menu po">CRICKET </span></div>
         <div class="w3-col s4 m4 w3-center"> <span id="footNv" class="w3-xxlarge menu po">SOCCER </span></div>     
 	</div>
</div>
<script type="application/javascript">
var tpMenu = 'all';
$("#allNv").click(function(){
  if($("#allNv").hasClass("aciveMenu"))
  {
	  $('#matchList').load("<?=base_url()?>home/all_match");
  }
  else
  {
	  $("#allNv").removeClass("menu").addClass("aciveMenu");
	  $("#criNv").removeClass("aciveMenu").addClass("menu");
	  $("#footNv").removeClass("aciveMenu").addClass("menu");
	  $('#matchList').load("<?=base_url()?>home/all_match");
  }
  tpMenu = 'all';
  tnyClear();
}); 

$("#criNv").click(function(){
  if($("#criNv").hasClass("aciveMenu"))
  {
	  $('#matchList').load("<?=base_url()?>home/cricket");
  }
  else
  {
	  $("#criNv").removeClass("menu").addClass("aciveMenu");
	  $("#allNv").removeClass("aciveMenu").addClass("menu");
	  $("#footNv").removeClass("aciveMenu").addClass("menu");
	  $('#matchList').load("<?=base_url()?>home/cricket");
  }
  tpMenu = 'cricket';
  tnyClear();
}); 

$("#footNv").click(function(){
  if($("#footNv").hasClass("aciveMenu"))
  {
	  $('#matchList').load("<?=base_url()?>home/soccer");
  }
  else
  {
	  $("#footNv").removeClass("menu").addClass("aciveMenu");
	  $("#criNv").removeClass("aciveMenu").addClass("menu");
	  $("#allNv").removeClass("aciveMenu").addClass("menu");	  
	  $('#matchList').load("<?=base_url()?>home/soccer");
  }
  tpMenu = 'football';
  tnyClear();
}); 

function tnyClear()
{
$(document).ready(function(){
    $("#time").removeClass("w3-opacity").addClass("aciveMenu");
	
	$("#live").removeClass("aciveMenu").addClass("w3-opacity");
	$("#today").removeClass("aciveMenu").addClass("w3-opacity");
	$("#betSlip").removeClass("aciveMenu").addClass("w3-opacity");
	$("#myGame").removeClass("aciveMenu").addClass("w3-opacity");
});
}

</script>