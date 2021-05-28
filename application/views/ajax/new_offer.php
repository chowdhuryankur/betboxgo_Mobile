<div id="conten" style="color:#FFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="off_g">
  <tr>
    <td class="<?php echo $cls; ?>"><span class="modal_btn1"> <?php echo $team_name; ?></span> </td>
    <td width="30%" height="30" class="given"><span class="<?php echo $cls1; ?>"><?php echo $type; ?></span></td>
    <td width="0%" align="right">

    </td>
  </tr>
  <tr>
    <td colspan="3" style="padding-top:10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="2" align="center" valign="middle" style="padding-top:5px;">
         <i class="fa fa-arrow-circle-left level_color fa-3x" id="ratio_mns" onClick="ratio_mns()" aria-hidden="true"></i></td>
        <td height="24" align="left" valign="middle"><span class="txt_white2"> ratio </span></td>
        <td align="right" valign="bottom"><div class="txt_white2"><?=round($match->max_bet_amount,1)?></div></td>
        <td width="12%" rowspan="2" align="center" valign="middle" style="padding-top:16px;">
        <i class="fa fa-arrow-circle-right level_color fa-3x" id="ratio_pls" onClick="ratio_pls()" aria-hidden="true"></i></td>
        <td width="12%" rowspan="2" valign="middle" style="padding-top:16px;"><input type="text" id="ratio_barSliderVal" class="txtf" value="1" /></td>
      </tr>
      <tr>
        <td height="22" colspan="2" valign="bottom"><input id="ratio_bar"  type="text" data-slider-min="1" data-slider-max="<?=round($match->max_bet_amount,1)?>" data-slider-step="0.05" data-slider-tooltip="hide" data-slider-value="1"/></td>
      </tr>
      <tr>
        <td rowspan="2" align="center" valign="middle">
        <i class="fa fa-arrow-circle-left level_color fa-3x" id="lot_mns" onClick="lot_mns()" aria-hidden="true"></i></td>
        <td height="24" align="left"><span class="txt_white2">lot</span></td>
        <td align="right"><div id="lbllot" class="txt_white2"> </div></td>
        <td rowspan="2" align="center" valign="middle">
        <i class="fa fa-arrow-circle-right level_color fa-3x" id="lot_pls" onClick="lot_pls()" aria-hidden="true"></i></td>
        <td rowspan="2" valign="middle"><input type="text" id="lot_barSliderVal" class="txtf" value="1" /></td>
      </tr>
      <tr>
        <td height="22" colspan="2"><input id="lot_bar" type="text" data-slider-min="1" data-slider-max="" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
    <button onClick="box_close('offerBox');" class="of_go"> CLOSE </button>
    </td>
    <td height="40">&nbsp;</td>
    <td align="right" valign="bottom">
    <button onClick="offer_place();" class="of_go"> DONE </button>
      
    </td>
  </tr>
</table>
</div>

<script language="javascript" type="text/javascript">

var int_lot = <?=round($user_balance,1)?>;
var int_ratio = <?=round($match->max_bet_amount,1)?>;
var typer = '<?=$type?>';
document.getElementById("lbllot").textContent = int_lot.toFixed(0);
var sliderLT = new Slider("#lot_bar", {max: int_lot});

// Without JQuery
var sliderRT = new Slider("#ratio_bar");
	sliderRT.on("slide", function(sliderValue) {
	document.getElementById("ratio_barSliderVal").value = sliderValue.toFixed(2);
	
	if(typer == 'GIVEN')
	{
		var int_lotc = Math.floor(int_lot / sliderValue.toFixed(2));
		document.getElementById("lbllot").textContent = int_lotc;
		sliderLT.setAttribute("max", Math.floor(int_lotc)); 
		if(document.getElementById("lot_barSliderVal").value > int_lotc)
		{
			document.getElementById("lot_barSliderVal").value = int_lotc;
		}
	}
	
});
sliderRT.on("slideStop", function(sliderValue) {
	document.getElementById("ratio_barSliderVal").value = sliderValue.toFixed(2);
	if(typer == 'GIVEN')
	{
		var int_lotc = Math.floor(int_lot / sliderValue.toFixed(2));
		document.getElementById("lbllot").textContent = int_lotc;
		sliderLT.setAttribute("max", Math.floor(int_lotc)); 
		if(document.getElementById("lot_barSliderVal").value > int_lotc)
		{
			document.getElementById("lot_barSliderVal").value = int_lotc;
		}
	}
	else
	{
		//document.getElementById("lot_barSliderVal").value = int_lot;
	}
});

//-----------------------------------------------------------------------------------

sliderLT.on("slide", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});
sliderLT.on("slideStop", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});

//-------------------------------------------------------------------------------------
// On Click Ratio pluse
function ratio_pls(){
    var ratio = Number(document.getElementById("ratio_barSliderVal").value);
	if(ratio <= int_ratio)
		{
			if(typer == 'GIVEN')
			{
				var int_lotc = Math.floor(int_lot / ratio);
				document.getElementById("lbllot").textContent = int_lotc;
				sliderLT.setAttribute("max", int_lotc);
				if(document.getElementById("lot_barSliderVal").value > int_lotc)
				{
					document.getElementById("lot_barSliderVal").value = int_lotc;
				}
			}
			ratio = (ratio + 0.05).toFixed(2);
			document.getElementById("ratio_barSliderVal").value = ratio;
			sliderRT.setValue(ratio);
		}
		else
		{
			document.getElementById("ratio_barSliderVal").value = int_ratio;
		}
	
}; 

// On Click Ratio Minus
function ratio_mns(){
    var ratio = Number(document.getElementById("ratio_barSliderVal").value);
	if(ratio > 1.04)
	{
		if(typer == 'GIVEN')
		{
			var int_lotc = Math.floor(int_lot / ratio);
			document.getElementById("lbllot").textContent = int_lotc;
			sliderLT.setAttribute("max", int_lotc);
			if(document.getElementById("lot_barSliderVal").value > int_lotc)
			{
				document.getElementById("lot_barSliderVal").value = int_lotc;
			}
		}
			ratio = (ratio - 0.05).toFixed(2);
			document.getElementById("ratio_barSliderVal").value = ratio;
			sliderRT.setValue(ratio);
	}
	else
	{
		document.getElementById("ratio_barSliderVal").value = ratio;
	}
	
}; 

//-------------------------------------------------------------------------------------
// On Click Lot pluse
function lot_pls(){
    var lot = Number(document.getElementById("lot_barSliderVal").value);
	var int_lotc = Number(document.getElementById("lbllot").textContent);
	if(lot >= int_lotc)
	{
		document.getElementById("lot_barSliderVal").value = int_lotc;
		sliderLT.setValue(int_lotc);
	}
	else
	{
		lot = lot + 1;
		document.getElementById("lot_barSliderVal").value = lot;
		sliderLT.setValue(lot);
	}
	
}; 

// On Click Lot Minus
function lot_mns(){
    var lot = Number(document.getElementById("lot_barSliderVal").value);
	if(lot > 1)
	{
		lot = lot - 1;
		document.getElementById("lot_barSliderVal").value = lot;
		sliderLT.setValue(lot);
	}
}; 

//-------------------------------------------------------------------------------------
var countDecimals = function(value) {
  if (Math.floor(value) === value) return 0;
  return value.toString().split(".")[1].length || 0;
}

// Ratio input field
document.getElementById("ratio_barSliderVal").onkeyup = function() {
    var ratio = Number(document.getElementById("ratio_barSliderVal").value);
	var ratioDec = countDecimals(ratio);

	if(ratioDec > 2)
	{
		document.getElementById("ratio_barSliderVal").value = ratio.toFixed(2);
	}
	if(ratio <= 0)
	{
		document.getElementById("lbllot").textContent = int_lot;
	}
	else
	{
		if(ratio <= int_ratio)
		{
			if(typer == 'GIVEN')
			{
				var int_lotc = Math.floor(int_lot / ratio);
				document.getElementById("lbllot").textContent = int_lotc;
				sliderLT.setAttribute("max", int_lotc);
				if(document.getElementById("lot_barSliderVal").value > int_lotc)
				{
					document.getElementById("lot_barSliderVal").value = int_lotc;
				}
			}
			sliderRT.setValue(ratio);
		}
		else
		{
			document.getElementById("ratio_barSliderVal").value = int_ratio;
		}
	}
};

//----------------------------------------------------------------------------------
// Lot input field
document.getElementById("lot_barSliderVal").onkeyup = function() {
    var lot = Number(document.getElementById("lot_barSliderVal").value);
	document.getElementById("lot_barSliderVal").value = Math.round(lot);
	var int_lotc = Number(document.getElementById("lbllot").textContent);
	if(lot > int_lotc)
	{
		document.getElementById("lot_barSliderVal").value = int_lotc;
		sliderLT.setValue(int_lotc);
	}
	else
	{
		sliderLT.setValue(lot);
	}
	
};

//=========================================================================================

function offer_place()
{
	var controller = 'game/new_offer';
	var base_url = '<?php echo base_url();?>';	
	var incl = '';	
	var type = '<?=$type?>';
	var team_id = <?=$team_id?>;	
	var match_id = <?=$match->id?>;
	var ratio = Number(document.getElementById("ratio_barSliderVal").value);
	var lot = Number(document.getElementById("lot_barSliderVal").value);
	var balance = <?=round($user_balance,1)?>;
	var int_ratio = <?=round($match->max_bet_amount,1)?>;
	
	var us_off_bl = ratio * lot;
	
	if(us_off_bl <= balance && ratio <= int_ratio)
	{
		$.ajax({
			'url' : base_url+controller,
			'type' : 'POST',
			'data' : {'matchid' : match_id, 'type' : type, 'amount': ratio, 'share' : lot, 'supteam' : team_id, 'incl' : incl},
			'success' : function(data){ 
				if(data == 'successfull') {
					var mesShow = "<div class='offersuccess'>Offer Place Successfully!</div>";
					document.getElementById("conten").innerHTML = mesShow;
				} else if (data == 'matchover') {
					var mesShow = "<div class='matchover'>Sorry Mact Over!</div>";
					document.getElementById("conten").innerHTML = mesShow;
				} else if (data == 'balancenees') {
					var mesShow = "<div class='balancenees'>Sorry Insufficient Balance!</div>";
					document.getElementById("conten").innerHTML = mesShow;
				} else if (data == 'invalid') {
					var mesShow = "<div class='invalid'>Invalid Data!</div>";
					document.getElementById("conten").innerHTML = mesShow;
				} else {
					var mesShow = data;
					document.getElementById("conten").innerHTML = mesShow;
				}
				setTimeout(function () { 
					document.getElementById('offerPanel').innerHTML = "";
					document.getElementById('offerBox').style.display='none';
					//location.reload();
				}, 3000);
			}
		});
	}
}
function box_close(v)
{
	document.getElementById('offerPanel').innerHTML = "";
	document.getElementById('offerBox').style.display = 'none';
}
</script>
