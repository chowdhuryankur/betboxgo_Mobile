<?php
$offer = $offers->row(0);

$free_share = $offer->total_offer - $offer->total_accept; 
if($free_share > 0) {
	
	$free_shares = $free_share;
	$type = $offer->type; 
	
	if($type == 'offer')
	{
		$balance = (int)$balance;
		$based_amount = $offer->base_bid_amount;
		$share_limit = $balance / $based_amount;
		$share_limit = (int)$share_limit;
		
		if($free_share > $share_limit)
		{
			$free_shares = $share_limit;
		}
	}
	
	if($type == 'want')
	{
		$balance = (int)$balance;
		$share_limit = $balance / $offer->amount;
		$share_limit = (int)$share_limit;
		
		if($free_share > $share_limit)
		{
			$free_shares = $share_limit;
		}
	}
	
?>
<div id="conten" style="color:#FFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="off_g">
  <tr>
    <td width="" class="<?php echo $cls; ?>"><span class="modal_btn1"> <?php echo substr($team_name,0,13); ?></span> </td>
    <td width="25%" height="30" class="given"><span class="<?php echo $cls1; ?>"><?php echo $types; ?></span></td>
    <td width="25%" class="given"><span class="<?php echo $cls1; ?>"><?=$offer->amount?></span></td>
    <?php if($offer->incl=='Draw'){ ?> 
    <td width="25%" class="given"><span class="<?php echo $cls1; ?>"><?=$offer->incl?></span></td><?php } ?>
  </tr>
  <tr>
    <td colspan="4" style="padding-top:16px;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="2" align="center" valign="middle">
        <i class="fa fa-arrow-circle-left level_color fa-3x" id="lot_mns" onClick="lot_mns()" aria-hidden="true"></i></td>
        <td height="40"><span class="txt_white2">lot</span></td>
        <td align="right"><div id="lbllot" class="txt_white2"> </div></td>
        <td width="12%" rowspan="2" align="center" valign="middle">
        <i class="fa fa-arrow-circle-right level_color fa-3x" id="lot_pls" onClick="lot_pls()" aria-hidden="true"></i></td>
        <td width="12%" rowspan="2" valign="middle"><input type="text" id="lot_barSliderVal" class="txtf" value="1" /></td>
      </tr>
      <tr>
        <td height="22" colspan="2"><input id="lot_bar" type="text" data-slider-min="1" data-slider-max="" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
    <button onClick="box_close('acceptBox');" class="of_go"> CLOSE </button></td>
    <td height="30" colspan="2">&nbsp;</td>
    <td align="right" valign="bottom"><button onClick="offer_accept()" class="of_go" > DONE </button>
      
    </td>
  </tr>
</table>
</div>

<script language="javascript" type="text/javascript">

var int_lot = <?=$free_shares?>;
document.getElementById("lbllot").textContent = int_lot.toFixed(0);
var sliderLT = new Slider("#lot_bar", {max: int_lot});

//-----------------------------------------------------------------------------------

sliderLT.on("slide", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});
sliderLT.on("slideStop", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});

//-------------------------------------------------------------------------------------

document.getElementById("lot_barSliderVal").onkeyup = function() 
{
    var lot = Number(document.getElementById("lot_barSliderVal").value);
	document.getElementById("lot_barSliderVal").value = Math.round(lot);
	var int_lotc = Number(document.getElementById("lbllot").textContent);
	if(lot > int_lotc)
	{
		document.getElementById("lot_barSliderVal").value = int_lotc;
	}
	sliderLT.setValue(lot);
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

//=========================================================================================

function offer_accept()
{
	var int_lot = <?=$free_shares?>;
	var controller = 'game/offer_accept';
	var base_url = '<?php echo base_url();?>';	
	var incl = '<?=$offer->incl?>';	
	var type = '<?=$type?>';
	var support_team = <?=$offer->support_team?>;	
	var match_id = <?=$offer->match_id?>;
	var amount = <?=$offer->amount?>;
	var share = Number(document.getElementById("lot_barSliderVal").value);
		
	if(share <= int_lot)
	{
		$.ajax({
			'url' : base_url+controller,
			'type' : 'POST',
			'data' : {'match_id' : match_id, 'amount' : amount, 'type' : type, 'support_team' : support_team, 'share' : share, 'incl' : incl},
			'success' : function(data){ 
				$('#conten').html(data);
				setTimeout(function () { 
					document.getElementById('acceprPanel').innerHTML = "";
					document.getElementById('acceptBox').style.display='none';
					slpUpdate();
				}, 3000);
			}
		});
	}
}

function box_close(v)
{
	document.getElementById('acceprPanel').innerHTML = "";
	document.getElementById('acceptBox').style.display = 'none';
}
</script>

<?php
} 
else
{
	echo "<div style='padding:30px; margin:0;'>";
		
	echo "<div class='offer_body' style='color:#FFDF18; height:30px; font-size:20px; text-align:center;'>Sorry! No available offer.</div>";
	
	echo "</div>";
	$cls = "document.getElementById('acceptBox').style.display='none'";
	echo "<button onClick=".$cls." class='of_go'> CLOSE </button>";
}
?>
