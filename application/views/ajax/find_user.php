<div class="w3-col s4 m4 w3-right-align padd144"> 
	<span class="level_color5 margtop">Amount <?=$currency?></span> 
</div>
<div class="w3-col s5 m5 w3-center level_color5 padd144">
  <input name="tns_amt" class="w3-input w3-border w3-round" id="tns_amt" onchange="trans_cal();" onkeyup="trans_cal();" maxlength="5">
</div>
<div class="w3-col s3 m3 w3-left-align padd144">
  <span class="level_color1"> &nbsp;fee <?=$currency?></span>
  <span id="fee"> </span>
</div>

<div class="w3-col s4 m4 w3-right-align padd144"> 
	<span class="level_color5 margtop">Pin</span> 
</div>
<div class="w3-col s5 m5 w3-center level_color5 padd144">
  <input name="pin" type="password" class="w3-input w3-border w3-round" id="pin" maxlength="4" onchange="trans_cal();" onkeyup="trans_cal();">
</div>
<div class="w3-col s3 m3 w3-left-align padd144">
	<input type="hidden" name="rc_id" id="rc_id" value="<?=$receiver->id?>"  />
	<button class="w3-btn w3-yellow w3-round" onclick="bl_trans();" id="send" style="width:90%;"> Send </button>
</div>