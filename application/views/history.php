<?php require('include/function.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Transation</title>
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
  
  <div class="w3-container nopading miniHight"> 
    <!-- Start Top Tiny manu -->
    <?php require('include/tny_manue.php'); ?> 
    <!-- End Top Tiny manu -->
    <div id="matchList">
    <div class="w3-row">
      <div class="w3-col s12 m12 w3-padding w3-center"> <span level_color5 class="level_color5 w3-border-bottom w3-border-green"> HISTORY</span> </div>
    </div>
    <div id="panl_body"> 
    
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
        <div class="w3-bar w3-green s12 w3-padding po w3-center marg15">
        	<div class="w3-col s3">&nbsp; </div>
            
        	<div class="w3-col s4" style="margin-right:5px;">
          		<input type="date" name="qdate" id="qdate" class="w3-input w3-border w3-round">
            </div>
            <div class="w3-col s2">
          		<button id="deateSearch" style="margin-top:1px;" class="w3-btn w3-yellow w3-round"> SEARCH </button>
            </div>
            <div class="w3-col s2">&nbsp; </div>     
        </div>
        
        <?php foreach($transaction->result() as $tran) {
			$color = 'defult';
			$my = "null";
			$cat = explode("|",$tran->category);
			if($tran->category == "GIVEN"){ $color = "pastets"; }
			if($tran->category == "EXCEPTED"){ $color = "pinkts"; } ?>
        <div class="w3-bar s12 regularpaging">
          <div class="w3-row margin0 padd border_radi">
            <div class="w3-col s2"> 
            	<span class="text1"><?=date('d M', strtotime($tran->date_time))?></span>
            </div>
            <div class="w3-col s7">
                <div class="w3-col s5"> 
                  	<span class='text1'>
                    <?php if($my != "null") { echo match_name_short($tran->source); } else { echo $tran->category; }?> 
                    </span>      
                </div>
              <div class="w3-col s7 marg_top">
                <div class="w3-row <?=$color?> magtopminus">
                  <div class="w3-col s4 padd"> 
                  <span class="level_color"><?=$tran->first_vl?></span> </div>
                  <div class="w3-col s8 w3-right-align padd"> 
                  <span class="level_color"><?=substr($tran->second_vl,0,9)?></span> </div>
                </div>
              </div>
            </div>
            <div class="w3-col s3 w3-right-align"> 
            	<span class="level_color"><?=$tran->amount_statue?></span> 
                <span class="text1"> <?=$tran->amount?> </span> 
            </div>
          </div>
        </div>
        <?php } ?>
        
      </div>
    </div>

    </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
</body>
</html>