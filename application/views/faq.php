<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Deposit</title>
<!-- header Start -->
<?php require('include/head.php'); ?>
<!-- header End -->
</head>
<body>
<!-- navegation Start -->
<?php require('include/nave.php'); ?>
<!-- navegation End --> 
<!-- myTop Start -->
<div class="w3-main w3-black" style="margin-left:250px;">
  <?php require('include/mytop.php'); ?>
  <!-- myTop End --> 
  <!-- navegation Start -->
  <?php require('include/secondnave.php'); ?>
  <!-- navegation End -->
  <div id="matchList">
  <div class="w3-container nopading miniHight"> 
    <!-- Start Top Tiny manu -->
    <?php require('include/tny_manue.php'); ?> 
    <!-- End Top Tiny manu -->
    <div class="w3-row">
      <div class="w3-col s12 m12 w3-padding w3-center"> <span class="level_color5 w3-border-bottom w3-border-green"> FREQUENTLY ASK QUESTION </span> </div>
    </div>
    
    <!-- faq start -->
    <div id="panl_body"> 
	
    <?php foreach($faq->result() as $row) { ?>
      <div class="w3-panel w3-round marg6 ofpanel nopad">
        <div id="q<?=$row->id?>" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="faqtPanel('q<?=$row->id?>');"> <i class="fa fa-question-circle level_color5" aria-hidden="true"></i>
        <?=$row->question?> ?
        <div id="depArowq<?=$row->id?>" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
            <div class="w3-row margrbot">
            	<?=$row->answer?>
            </div>
          </div>
        </div>
      </div>
     <?php } ?>
      
    </div>
  <!-- faq End --> 
  </div>
</div>
<!-- footer Start -->
<?php require('include/footer.php'); ?>
<!-- footer End -->
</div>
<script>
// FAQ Panel
function faqtPanel(detail)
{
  $(document).ready(function(){
    $("#"+detail).next(".w3-bar").slideToggle(1000);
  	if(document.getElementById("depArow"+detail).className == 'arrow_color fa fa-chevron-left fa-lg margtp w3-right')
      	{
        	document.getElementById("depArow"+detail).className = 'arrow_color fa fa-chevron-down fa-lg margtp w3-right';
      	}
    	else
      	{
        	document.getElementById("depArow"+detail).className = 'arrow_color fa fa-chevron-left fa-lg margtp w3-right';
      	}
  });
}

</script>
</body>
</html>