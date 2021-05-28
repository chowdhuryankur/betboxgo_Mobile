<html>
<?php echo link_tag('css/bootstrap-slider.min.css'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<body style="padding:10px; margin:0;">
<div id="conten" style="color:#FFF;">

    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="150" align="center" valign="middle">
        <div id="return_value">
         <span id="con_msz" style="display:none;"> <img src="<?=base_url()?>images/icon_loading.gif" width="90"  /> </span>
         <button id="butcl" onClick="offer_close()" class="of_go" >Colse This Offer </button>
        </div>
        </td>
      </tr>
  </table>      
      
</div>
</body>

<script language="javascript" type="text/javascript">
var base_url = '<?php echo base_url();?>';	
var offer_id = <?=$offer_id?>;
function offer_close()
{
	document.getElementById("butcl").style.display = "none";
	document.getElementById("con_msz").style.display = "block";
	setTimeout(function () { 
		$.ajax({
		'url' : base_url + 'game/close_offer',
		'type' : 'POST', //the way you want to send data to your URL
		'data' : {'off_id' : offer_id},
		'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
		var container = $('#return_value'); //jquery selector (get element by id)
		if(data){
			parent.$.fancybox.close();
		}
		}
		});
	}, 2000);
}
</script>
</html>