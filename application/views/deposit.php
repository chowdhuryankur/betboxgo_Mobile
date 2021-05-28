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
  
  <div class="w3-container nopading miniHight"> 
    <!-- Start Top Tiny manu -->
    <?php require('include/tny_manue.php'); ?> 
    <!-- End Top Tiny manu -->
    <div id="matchList">
    <div class="w3-row">
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('cash_in');" id="cash_in" class="level_color5 w3-border-bottom w3-border-green po"> CASH IN </span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('inqueue');" id="inqu" class="txt_white3 w3-border-bottom w3-border-green po"> IN QUEUE </span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('inhistory');" id="inhistory" class="txt_white3 w3-border-bottom w3-border-green po"> RECORD </span> </div>
    </div>
    
    <!-- deposit start -->
    <div id="panl_body"> 
      <!-- bkash -->
      <div class="w3-panel w3-round marg6 ofpanel nopad">
      <a class="dropdown-link" href="#">
        <div id="bKash" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('bKash');"> <img src="<?=base_url()?>images/bkash.jpg" height="22">
          <div id="depArowbKash" class="arrow_color fa fa-chevron-left fa-lg"></div>
        </div>
      </a>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($bkash != 'wait') { ?>
            <div class="w3-row margrbot" id="bkpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="bktyp" type="radio" id="bkpersonal" onClick="shoNo('bk','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="bktyp" type="radio" id="bkagent" onClick="shoNo('bk','agnt');" value="agent">
                  AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span> 
              	<span id="bkpers" class="text10"><?=$bkno_personal->sim_number?></span>
                <span id="bkagnt" class="text10 dsply_n"><?=$bkno_agent->sim_number?></span> 
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="bkmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" max="15000" min="500" placeholder="500" name="bkbdt" id="bkbdt" onChange="call_dollar('bk');" onKeyPress="call_dollar('bk');" onKeyUp="call_dollar('bk');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="bkdlr" type="text" class="w3-input margtp w3-border w3-round" id="bkdlr" maxlength="3" readonly="readonly" placeholder="6.25">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="text" id="bktrx" onKeyPress="sendButton('bk');" onKeyDown="sendButton('bk');" onKeyUp="sendButton('bk');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" maxlength="4" id="bksno" onKeyPress="sendButton('bk');" onKeyDown="sendButton('bk');" onKeyUp="sendButton('bk');">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="reset('bk');" id="bkreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center">
                <button id="bksend" onclick="depRequest('bk');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- roket -->
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
      <a class="dropdown-link" href="#">
        <div id="roket" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('roket');"> <img src="<?=base_url()?>images/roket.jpg" height="22">
          <div id="depArowroket" class="arrow_color fa fa-chevron-left fa-lg"></div>
        </div>
      </a>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($Roket != 'wait') { ?>
            <div class="w3-row margrbot" id="rkpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="rktyp" type="radio" id="rkpersonal" onClick="shoNo('rk','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="rktyp" id="rkagent" type="radio" onClick="shoNo('rk','agnt');" value="agent"> AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span>
              <span id="rkpers" class="text10"><?=$Rkno_personal->sim_number?></span> 
              <span id="rkagnt" class="text10 dsply_n"><?=$Rkno_agent->sim_number?></span> 
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="rkmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" min="500" max="15000" placeholder="500" maxlength="5" name="rkbdt" id="rkbdt" onChange="call_dollar('rk');" onKeyPress="call_dollar('rk');" onKeyUp="call_dollar('rk');" required>
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="rkdlr" type="text" class="w3-input margtp w3-border w3-round" id="rkdlr" value="" readonly="readonly" placeholder="6.25" required>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" id="rktrx" type="text" onKeyPress="sendButton('rk');" onKeyDown="sendButton('rk');" onKeyUp="sendButton('rk');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" id="rksno" maxlength="4" type="number" onKeyPress="sendButton('rk');" onKeyDown="sendButton('rk');" onKeyUp="sendButton('rk');" required >
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="reset('rk');" id="rkreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center">
                <button id="rksend" onclick="depRequest('rk');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- nagad -->
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
      <a class="dropdown-link" href="#">
        <div id="nagad" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('nagad');"> <img src="<?=base_url()?>images/nagad.jpg" height="22">
          <div id="depArownagad" class="arrow_color fa fa-chevron-left fa-lg"></div>
        </div>
      </a>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($Nagad != 'wait') { ?>
            <div class="w3-row margrbot" id="ngpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="ngtyp" type="radio" id="ngpersonal" onClick="shoNo('ng','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="ngtyp" type="radio" id="ngagent" onClick="shoNo('ng','agnt');" value="agent"> AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span> 
              <span id="ngpers" class="text10"><?=$nagad_personal->sim_number?></span> 
              <span id="ngagnt" class="text10 dsply_n"><?=$nagad_agent->sim_number?></span>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="ngmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" min="500" max="15000" placeholder="500" maxlength="3" name="ngbdt" id="ngbdt" onChange="call_dollar('ng');" onKeyPress="call_dollar('ng');" onKeyUp="call_dollar('ng');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="ngdlr" type="text" class="w3-input margtp w3-border w3-round" id="ngdlr" readonly="readonly" placeholder="6.25">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="text" name="ngtrx" id="ngtrx" required onKeyPress="sendButton('ng');" onKeyDown="sendButton('ng');" onKeyUp="sendButton('ng');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" maxlength="4" id="ngsno" name="ngsno" onKeyPress="sendButton('ng');" onKeyDown="sendButton('ng');" onKeyUp="sendButton('ng');" required>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="ng_reset();" id="ngreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center w3-round">
                <button id="ngsend" onclick="depRequest('ng');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- deposit End --> 
    </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<script>
var base_url = '<?php echo base_url(); ?>';
// bkash deposit
function depositPanel(detail)
{
  $(document).ready(function(){
    $("#"+detail).next(".w3-bar").slideToggle(1000);
  	if(document.getElementById("depArow"+detail).className == 'arrow_color fa fa-chevron-left fa-lg')
      	{
        	document.getElementById("depArow"+detail).className = 'arrow_color fa fa-chevron-down fa-lg';
      	}
    	
  });
}
$(document).ready(function(){
    $(document).on("click", "a", function(event2){
        $(this).siblings().show(1000)
            $(this).parent().siblings().each(function(index2,element2){
            $(element2).find(".displayNo:visible").hide(1000);
			if($(element2).find(".arrow_color").hasClass('fa fa-chevron-down fa-lg'))
			{
				$(element2).find(".arrow_color").removeClass("fa fa-chevron-down fa-lg").addClass("fa fa-chevron-left fa-lg");
			}
            });
    });
});
// Add diperent panel
function i_ue(val)
{
	var inqu = val;
	if(inqu == 'cash_in')
	{
		document.getElementById("cash_in").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("inqu").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("inhistory").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'inqueue')
	{
		document.getElementById("cash_in").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("inqu").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("inhistory").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'inhistory')
	{
		document.getElementById("cash_in").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("inqu").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("inhistory").className = 'level_color5 w3-border-bottom w3-border-green po';
	}
	
	var controller = "balance";
	$.ajax({
		'url' : base_url + controller + '/panel',
		'type' : 'POST', //the way you want to send data to your URL
		'data' : {'inqu' : inqu},
		'success' : function(data){ //probably this request will return anything, it'll be put in 	var "data"
			var container = $('#panl_body'); //jquery selector (get element by id)
			if(data){
				container.html(data);
			}
		}
	});
}
// show number
function shoNo(pnl,typ)
{
	$("#"+pnl+typ).removeClass("dsply_n");
	if(typ == 'pers')
    {
	  $("#"+pnl+"agnt").addClass("dsply_n");
	  $("#"+pnl+"mnytp").html("Send money");
    }
    else
    {
	  $("#"+pnl+"pers").addClass("dsply_n");
	  $("#"+pnl+"mnytp").html("Cash out");
    }
	call_dollar(pnl);
}

function call_dollar(pnl)
{
	var bdt = $("#"+pnl+"bdt").val();
	var chg = 0;
	if($("#"+pnl+"personal").is(":checked")) { chg = 2; }
	
	if(bdt > 499 && bdt < 15001)
	{
		var bk_ch = (bdt/100)*chg;
		var t_bdt = bdt - bk_ch;
		var dollar = t_bdt / 80;
		$("#"+pnl+"dlr").val(dollar.toPrecision(4));
	}
	else
	{
		$("#"+pnl+"dlr").val(0);
	}
	sendButton(pnl);
}
// show send button
function sendButton(pnl)
{
	var bdt = $("#"+pnl+"bdt").val();
	var dlr = $("#"+pnl+"dlr").val();
	var trx = $("#"+pnl+"trx").val();
	var sno = $("#"+pnl+"sno").val();
	
	if(bdt > 499 && dlr > 5 && sno.length > 3) 
	{
		$("#"+pnl+"send").removeClass("w3-disabled");
	}
	else
	{
		$("#"+pnl+"send").addClass("w3-disabled");
	}
}
// send deposit
function depRequest(pnl)
{
	var bdt = $("#"+pnl+"bdt").val();
	var dlr = $("#"+pnl+"dlr").val();
	var trx = $("#"+pnl+"trx").val();
	var sno = $("#"+pnl+"sno").val();
	if($("#"+pnl+"personal").is(":checked")) { number = $("#"+pnl+"pers").html(); typ = "personal"; }	else {number = $("#"+pnl+"agnt").html(); typ = "agent"; }
	
	var controller = 'balance';
	
	$.ajax({
		'url' : base_url + controller + '/add_deposit',
		'type' : 'POST', 
		'data' : {'dollar' : dlr, 'bdt' : bdt, 'sender_no' : sno, 'trxid' : trx, 'number' : number, 'num_typ' : typ, 'method' : pnl},
		'success' : function(data)
		{ 
			var container = $("#"+pnl+"panel"); 
			if(data)
			{
				container.empty();
				container.html(data);
			}
		}
	});
}
// search deposit histoer
</script>

</body>
</html>