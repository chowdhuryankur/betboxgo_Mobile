<?php if($offer->num_rows() > 0) { ?>
<div id="conten" style="color:#FFF;">
<?php $offer = $offer->row(0); 
if($offer->accepted_share < 1) { $mini_lot = 1; } 
else { $mini_lot = $offer->accepted_share; }
$max_lot = round(($user_balance / $offer->amount),1);
if($offer->type == 'want') 
{ 
	$cls = 'tnameg_ex'; 
	$cls1 = 'of_txt_ex'; 
	$type = "EXPECTED"; 
} else 
{ 
	$cls = 'tnameg'; 
	$cls1 = 'of_txt_gv'; 
	$type = "GIVEN"; 
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="off_g">
  <tr>
    <td width="30%" class="<?php echo $cls; ?>"><span class="modal_btn1"> <?php echo $offer->name; ?></span> </td>
    <td width="30%" class="given"><span class="<?php echo $cls1; ?>"><?php echo $type; ?></span></td>
    <td width="0%" class="given"><span class="<?php echo $cls1; ?>"><?=$offer->amount?></span></td>
  </tr>
  <tr>
    <td colspan="3" style="padding-top:10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="2" align="center" valign="middle"><i class="fa fa-arrow-circle-left level_color fa-3x" id="lot_mns" onClick="lot_mns()" aria-hidden="true"></i></td>
        <td height="40"><span class="txt_white2">lot</span></td>
        <td align="right"><div id="lbllot" class="txt_white2"> </div></td>
        <td width="12%" rowspan="2" align="center" valign="middle"><i class="fa fa-arrow-circle-right level_color fa-3x" id="lot_pls" onClick="lot_pls()" aria-hidden="true"></i></td>
        <td width="12%" rowspan="2" valign="middle"><input type="text" id="lot_barSliderVal" class="txtf" value="<?=$mini_lot?>" /></td>
      </tr>
      <tr>
        <td height="22" colspan="2"><input id="lot_bar" type="text" data-slider-min="<?=$mini_lot?>" data-slider-max="<?=$max_lot?>" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?=$mini_lot?>"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
    <button onClick="box_close('acceptBox');" class="of_go"> CLOSE </button>
    </td>
    <td height="30">&nbsp;</td>
    <td align="right" valign="bottom">
    <button onClick="offer_place();" class="of_go"> DONE </button>
      
    </td>
  </tr>
</table>
</div>
</body>

<script language="javascript" type="text/javascript">

var int_lot = <?=$max_lot?>;
var typer = '<?=$type?>';
document.getElementById("lbllot").textContent = int_lot.toFixed(0);
var sliderLT = new Slider("#lot_bar", {max: int_lot});

// Without JQuery

sliderLT.on("slide", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});
sliderLT.on("slideStop", function(sliderValue) {
	document.getElementById("lot_barSliderVal").value = sliderValue;
});


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
	var controller = 'game/update_offer';
	var prev_lot = '<?php echo $offer->offer_share; ?>';
	var base_url = '<?php echo base_url(); ?>';	
	var offer_id = '<?php echo $offer->id; ?>';
	var lot = Number(document.getElementById("lot_barSliderVal").value);
	
		if(lot != prev_lot  )
		{
			$.ajax({
				'url' : base_url+controller,
				'type' : 'POST',
				'data' : {'share' : lot, 'offer_id' : offer_id, 'prev_lot' : prev_lot},
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
<?php } else { echo "Sorry This offer was settled, can not update. "; } ?>
