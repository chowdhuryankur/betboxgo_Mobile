<div class="w3-row">
    <div class="w3-col s4 m4 w3-right-align w3-padding">
       <span class="level_color5 margtop">Amount $</span>
    </div>
    <div class="w3-col s4 m4 w3-center level_color5 w3-padding">
        <input name="tns_amt" class="w3-input w3-border w3-round" id="tns_amt" onchange="trans_cal();" onkeyup="trans_cal();" maxlength="5">
    </div>
    <div class="w3-col s4 m4 w3-left-align w3-padding">
        <div class="w3-col s4">
            <span class="level_color5"> FEE $</span>
        </div>
        <div class="w3-col s8 padd back_clr w3-left-align" id="fee">0</div>
	</div>						
</div>
<div class="w3-row">
    <div class="w3-col s4 m4 w3-right-align w3-padding">
       <span class="level_color5 margtop">PIN</span>
    </div>
    <div class="w3-col s4 m4 w3-center level_color5 w3-padding">
        <input name="pin" class="w3-input w3-border w3-round" id="pin" onchange="trans_cal();" onkeyup="trans_cal();" maxlength="4" type="password" autocomplete="off">
    </div>
    <div class="w3-col s4 m4 w3-left-align w3-padding">
        <button class="w3-btn w3-yellow w3-disabled w3-round" id="send" onclick="bl_trans();"> Send </button>
	</div>	
    <input type="hidden" name="rc_id" id="rc_id" value="56156"  />					
</div>
