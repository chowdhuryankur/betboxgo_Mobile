 <div id="myTop" class="w3-container w3-top w3-theme w3-large nopading">
  <div class="w3-col s5 m4">
	<div class="w3-col s2 m2">
  		<i class="fa fa-bars w3-button w3-teal w3-hide-large w3-xxlarge nopading" onclick="w3_open()"></i>
    </div>
    <div class="w3-col s10 m10 po">
  		<img src="<?=base_url()?>img/logo.jpg" width="100%" onclick="window.location.replace('<?=base_url()?>home/page');">
    </div>
  </div>
  <div class="w3-col s5 m6 margtp">
    <div class="w3-col s4 m3 w3-right-align">
    	<i class="fa fa-refresh w3-teal w3-large po" onclick="window.location.reload();"></i>
    </div>
    <div class="w3-col s4 m3 w3-center">
    	<i class="fa fa-commenting w3-teal w3-large po" onclick="window.location.replace('<?=base_url()?>support/msg');"></i>
    </div>
    <div class="w3-col s4 m3 w3-left-align">
    	<i class="fa fa-flag w3-teal w3-large po" onclick="window.location.replace('<?=base_url()?>user/profile');"></i>
    </div>
  </div>
  <div class="w3-col s2 m2 w3-right-align">
  	<button class="w3-btn w3-grey w3-tiny w3-round" onclick="window.location.replace('<?=base_url()?>user/log_out');" style="widows:100%">LOGOUT</button>
  </div>
 </div>
 
