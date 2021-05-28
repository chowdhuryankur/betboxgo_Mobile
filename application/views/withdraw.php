<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Withdraw</title>
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
  	<?php require('include/tny_manue.php'); ?> 
    
    <div class="w3-row">
      <div class="w3-col s12 m12 w3-padding w3-center"> 
      	<span class="level_color5 w3-border-bottom w3-border-green"> WITHDRAW </span> 
      </div>
    </div>
    
    <!-- withdeaw start -->
    <div id="panl_body"> 

      <div class="w3-container w3-border-bottom w3-border-teal nopading margtp"> </div>
      <div class="w3-bar w3-black nopading nomargin w3-small">
    	<button class="w3-bar-item w3-button slipTab w3-green w3-hover-yellow s6" onclick="withdraSlip(event,'bank')" style="width:50%">TO BANK</button>
    	<button class="w3-bar-item w3-button slipTab w3-hover-yellow s6" onclick="withdraSlip(event,'mobile')" style="width:50%">TO MOBILE</button>
      </div>
      <div id="bank" class="w3-container w3-small nopading slipPanel">
    	<div class="w3-col m12 s12 back_clr4 w3-padding">
            <div class="w3-col s12 m12">
            	<div class="w3-col s6 m6 text10 margtop padd144">
                A/c: <span id="bNumber">XXXXXXXXXX</span>
                </div>
                <div class="w3-col s6 m6 padd144">
                <select id="bWithdra" onChange="changeAcno(this.value,'b');" class="w3-input w3-border w3-round">
                	<option selected>SELECT BANK</option>
                    <?php foreach($bank->result() as $bnk) { if(!in_array($bnk->ac_no, $with_to)) { ?>
                		<option value="<?=$bnk->ac_no?>"><?=$bnk->withdra?></option>
                    <?php } }?>
                </select>
                </div>
            </div>
            <div class="w3-col s12 m12">
            	<div class="w3-col s6 m6 padd144">
                	<label> <span id="cpitxta" class="text10">Amount </span><span class="level_color5"> $ </span> </label>
                	<input id="bAmount" class="w3-input margtp w3-border w3-round" type="number" maxlength="3" min="50" max="500">
              	</div>
            	<div class="w3-col s6 m6 padd144">
                	<label> <span class="text10">PIN </span> </label>
                	<input id="bPin" class="w3-input margtp w3-border w3-round" type="password" maxlength="4">
              	</div>
            </div>
            <div class="w3-col s12 m12 w3-padding w3-center margtp">
               <button onclick="withdraw('b');" class="w3-btn w3-yellow  w3-round" style="width:50%"> SEND </button>
            </div>
        </div>
      </div>
    
      <div id="mobile" class="w3-container w3-small nopading slipPanel" style="display:none;">
    	<div class="w3-col m12 s12 back_clr4 w3-padding">
        	<div class="w3-col s12 m12">
            	<div  class="w3-col s6 m6 text10 margtop padd144">
                A/c: <span id="mNumber">XXXXXXXXXX</span>
                </div>
                <div class="w3-col s6 m6 padd144">
                <select id="mWithdra" onChange="changeAcno(this.value,'m');" class="w3-input w3-border w3-round">
                	<option selected>SELECT OPARETOR</option>
                	<?php foreach($mobile->result() as $mob) { if(!in_array($mob->ac_no, $with_to)) {?>
                	<option value="<?=$mob->ac_no?>"><?=$mob->withdra?></option>
                    <?php } } ?>
                </select>    
                </div>
            </div>
            <div class="w3-col s12 m12">
            	<div class="w3-col s6 m6 padd144">
                	<label> <span id="cpitxta" class="text10">Amount </span><span class="level_color5"> $ </span> </label>
                	<input id="mAmount" class="w3-input margtp w3-border w3-round" type="" maxlength="3" min="20" max="300">
              	</div>
            	<div class="w3-col s6 m6 padd144">
                	<label> <span class="text10">PIN </span> </label>
                	<input id="mPin" class="w3-input margtp w3-border w3-round" type="password" maxlength="4">
              	</div>
            </div>
            <div class="w3-col s12 m12 w3-padding w3-center margtp">
               <button onclick="withdraw('m');" class="w3-btn w3-yellow w3-round" style="width:50%"> SEND </button>
            </div>
        </div>
      </div>
      
    </div>
    <!-- withdeaw End --> 
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<script>
// withdraw panel
function withdraSlip(evt, panelName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("slipPanel");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("slipTab");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-green", "");
  }
  document.getElementById(panelName).style.display = "block";
  evt.currentTarget.className += " w3-green";
}
function changeAcno(v,t)
{
	$("#"+t+"Number").html(v);
}
function withdraw(v)
{
	var number = $("#"+v+"Number").html();
	var amount = $("#"+v+"Amount").val();
	var pin = $("#"+v+"Pin").val();
	if(v == 'b') { pnl = "#bank"; } else { pnl = "#mobile"; }
	
	$.ajax({
		'url' : '<?=base_url()?>balance/add_withdraw',
		'type' : 'POST',
		'data' : {'typ' : v, 'number' : number, 'amount' : amount, 'pin' : pin},
		'success' : function(data){ 
			var container = $(pnl);
			if(data){
				if(data== 'success')
				$(pnl).html("<div class='bx level_color'><i class='fa fa-spinner fa-pulse fa-5x fa-fw'></i></div>");
				setTimeout(function () { 
				$(pnl).load("<?=base_url()?>notify/with_proce.php"); }, 1000);
			}
		}
	});
}
</script>
</body>
</html>