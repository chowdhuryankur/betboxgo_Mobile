<html>
<?php require_once('includes/function.php'); ?>
<?php echo link_tag('css/bootstrap-slider.min.css'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/angular.min.js"></script>

<?php
$offer = $offers->row(0);  
$free_share = $offer->offer_share - $offer->accepted_share; 
$team_name = team_name($offer->support_team);
$base_bid_amount = based_amount($offer->match_id);
				
if($free_share > 0) {
	
	$free_shares = $free_share;
	$type = $offer->type; 
	
	if($type == 'offer')
	{
		$balance = (int)$user_balance;
		$based_amount = $base_bid_amount;
		$share_limit = $balance / $based_amount;
		$share_limit = (int)$share_limit;
		if($free_share > $share_limit)
		{
			$free_shares = $share_limit;
		}
		$cls = 'tnameg';
		$cls1 = 'of_txt_gv';
		$types = 'GIVEN'; 
	}
	
	if($type == 'want')
	{
		$balance = (int)$user_balance;
		$share_limit = $balance / $offer->amount;
		$share_limit = (int)$share_limit;
		
		if($free_share > $share_limit)
		{
			$free_shares = $share_limit;
		}
		$cls = 'tnameg_ex'; 
		$cls1 = 'of_txt_ex';
		$types = 'EXPECTED';
	}
	
?>
<body style="padding:10px; margin:0;" ng-app="myApp" ng-controller="myCtrl">
<div id="conten" style="color:#FFF;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="off_g">
  <tr>
    <td width="25%" class="<?php echo $cls; ?>"><span class="modal_btn1"> <?php echo $team_name; ?></span> </td>
    <td width="25%" height="30" class="given"><span class="<?php echo $cls1; ?>"><?php echo $types; ?></span></td>
    <td width="25%" class="given"><span class="<?php echo $cls1; ?>"><?=$offer->amount?></span></td>
    <?php if($offer->incl=='Draw'){ ?> <td width="25%" class="given"><span class="<?php echo $cls1; ?>"><?=$offer->incl?></span></td><?php } ?>
  </tr>
  <tr>
    <td colspan="4" style="padding-top:16px;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="2" align="center" valign="middle"><img src="<?php echo base_url('images/modal_arrow_left.png'); ?>" id="lot_mns" onClick="lot_mns()" /></td>
        <td height="40"><span class="txt_white2">lot</span></td>
        <td align="right"><div id="lbllot" class="txt_white2"> </div></td>
        <td width="12%" rowspan="2" align="center" valign="middle"><img src="<?php echo base_url('images/modal_arrow_right.png'); ?>" id="lot_pls" onClick="lot_pls()" /></td>
        <td width="12%" rowspan="2" valign="middle"><input type="text" id="lot_barSliderVal" class="txtf" value="1" /></td>
      </tr>
      <tr>
        <td height="22" colspan="2"><input id="lot_bar" type="text" data-slider-min="1" data-slider-max="" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="1"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="30" colspan="2">&nbsp;</td>
    <td align="right" valign="bottom"><button ng-click="offer_accept()" class="of_go" > GO </button>
      
    </td>
  </tr>
</table>
</div>
</body>

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

  
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
$scope.offer_accept = function () 
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
			$http({
				url: base_url+controller,
				method: 'POST',
				data: {'match_id' : match_id, 'amount' : amount, 'type' : type, 'support_team' : support_team, 'share' : share, 'incl' : incl}
			}).success(function(data, status, headers, config) {
				document.getElementById("conten").textContent = data;
				//$scope.divText = data;
				setTimeout(function () { 
					parent.$.fancybox.close();
				}, 3000);
			}).error(function(data, status, headers, config) {
				$scope.status = status;
			});
			
		}
}
});
</script>

<?php
} 
else
{
	echo "<body style='padding:25px; margin:0;'>";
		
	echo "<div class='offer_body' style='color:#FFDF18; height:30px; font-size:20px; text-align:center;'>Sorry! No available offer.</div>";
	
	echo "</body>";
}
?>
</html>