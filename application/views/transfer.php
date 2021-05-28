<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Transfer</title>
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
      <div class="w3-col s12 m12 w3-padding w3-center"> <span class="level_color5 w3-border-bottom w3-border-green"> BALANCE TRANSFER</span> </div>
    </div>
    <div id="panl_body"> 
      <!-- TRANSFER -->
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small padbutom">
        <div class="w3-bar w3-green s12 w3-padding w3-center marg15">
          <div class="w3-col s12 padd14"> 
          <?php $tr_fre_lim=0; $lim_locating=0;
		  if($user->group != "suspend" and $user->trnsfer == "on") { 
		  $tr_fre_lim = $limit->status-$trns_send;
		  $lim_locating = $limit->location;
	      if($tr_fre_lim < 0) { $fre_lim = 0; } else { $fre_lim = $tr_fre_lim; }?>
          	<div class="w3-col s3 padd9"> 
                <span class="level_color5">Limit</span> <span class="text1"><?=$limit->status?></span>            </div>
            <div class="w3-col s4 padd9"> 
             	<span class="level_color5">Remaning</span> 
                <span id="remLimt" class="text1"><?=$fre_lim?></span> 
            </div>
            <div class="w3-col s5 padd9"> 
            	<span class="level_color5">Fee</span> <span class="text1"> &nbsp; <?php echo $currency.$trns_fee; ?>%</span> 
            </div>
          <?php } ?>  
          </div>
        </div>
         <div class="w3-row">
         <?php if($user->group != "suspend" and $user->trnsfer == "on") { ?>
          <div class="w3-col s4 m4 w3-right-align padd144">
            <span class="level_color5 margtop">betboxgo ID</span>
          </div>
          <div class="w3-col s5 m5 w3-center level_color5 padd144">
            <input class="w3-input w3-border w3-round" name="betboxid" id="betboxid">
          </div>
          <div class="w3-col s3 m3 w3-left-align padd144">
            <button class="w3-btn w3-yellow w3-round" onclick="id_search(betboxid.value);" id="find" name="find" style="width:90%; margin-top:1px;"> Find </button>
          </div>
          <?php } else { ?>
          <div class="w3-col s12 m12 w3-center w3-padding">
            <span class="level_color5 margtop">You are not allow for transfer balance!</span>
          </div>
          <?php } ?>
        </div> 
        <div class="w3-row w3-center" id="rest_body"> </div>
        
      </div>
    </div>
    <!-- TRANSFER End --> 
  </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<script type="application/javascript">
// find box ID
var base_url = '<?=base_url()?>';

function id_search(boxid)
{
$.ajax({
'url' : base_url + 'user/betboxid',
'type' : 'POST', 
'data' : {'boxid' : boxid},
'success' : function(data){ 
var container = $('#rest_body'); 
if(data){
container.html(data);
}
}
});
}

// calculation
function trans_cal()
{
	var tns_limit = <?=$fre_lim?>;
	var v = document.getElementById("tns_amt").value;
	var amt_limit = <?php echo round($balance->remaning_amount * $lim_locating); ?>;
	
	if(v > amt_limit)
	{
		document.getElementById("tns_amt").value = amt_limit;
	}
	if(tns_limit < 1)
	{
		v = document.getElementById("tns_amt").value;
		var fee = v * <?=$trns_fee?>;
		document.getElementById("fee").innerHTML = fee;
	}
	else
	{
		document.getElementById("fee").innerHTML = 0;
	}
	if($('#tns_amount').val() != '' && $('#pin').val() != '')
	{
		document.getElementById('send').className="w3-btn w3-yellow w3-round";
	}
	else
	{
		document.getElementById('send').className="w3-btn w3-yellow w3-disabled w3-round";
	}
}
// Send transfer request
function bl_trans(){
var boxid = document.getElementById("rc_id").value;
var tns_amount = document.getElementById("tns_amt").value;
var pin = document.getElementById("pin").value;
var remLimt = <?=$fre_lim?>;
if($('#tns_amount').val() != '' && $('#pin').val() != '')
{
$.ajax({
'url' : base_url + 'balance/bl_transfer',
'type' : 'POST', 
'data' : {'rid' : boxid, 'tns_amount' : tns_amount, 'pin' : pin},
'success' : function(data){ 
var container = $('#rest_body'); 
if(data){
	container.html(data);
	if(data.search("successfully")) 
	{
		remLimt = remLimt - 1;
		$('#remLimt').html(remLimt);
	}
}
}
});
}
else
{
	document.getElementById('send').className="w3-btn w3-yellow w3-disabled w3-round";
}

}
</script>
</body>
</html>