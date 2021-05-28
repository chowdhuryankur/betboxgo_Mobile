<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Bet Slip</title>
<!-- header Start -->
<?php require('include/head.php'); ?>
<?php echo link_tag('css/bootstrap-slider.min.css'); ?>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-slider.js"></script>
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
    
    <div id="matchList">
    <div class="w3-row">
      <div class="w3-col s12 m12 w3-padding w3-center"> 
      	<span class="level_color5 w3-border-bottom w3-border-green"> BET SLIP </span> 
      </div>
    </div>
    
    <!-- bet slip start -->
    <div id="panl_body"> 

      <div class="w3-container w3-border-bottom w3-border-teal nopading margtp"> </div>
      <div class="w3-bar w3-black nopading nomargin w3-small w3-text-gray">
    	<button class="w3-bar-item w3-button slipTab w3-green w3-hover-yellow s6" onclick="betSlip(event,'offerList')" style="width:50%">MY OFFER LIST</button>
    	<button class="w3-bar-item w3-button slipTab w3-hover-yellow s6" onclick="betSlip(event,'acceptList')" style="width:50%">MY ACCEPT LIST</button>
      </div>
      
      <div id="offerList" class="w3-container w3-small nopading slipPanel">
      <?php $i = 0; foreach($offer as $off_row) { ?>
    	<div class="w3-col m12 s12 back_clr4">
        	<div class="w3-row padd144">
            	<div class="w3-col m10 s10 w3-left-align padd2 padd20"> 
                	<span class="txt_white2"><?=$off_mat_name[$i]?> </span> 
                </div>
                <div class="w3-col m2 s2 w3-left-align padd2 padd20"><img src="<?=base_url()?>images/<?=$off_mat_img[$i]?>.png" width="20" height="20">
                </div>
            </div>
            <?php foreach($off_row->result() as $off_list) { 
			if($off_list->type == 'offer') { 
				$stack = $off_list->amount*$off_list->offer_share; 
				$done = $off_list->amount*$off_list->accepted_share;
				$win = round($off_list->accepted_share - (($off_list->accepted_share/100)*$ratio),2);
				$color = "paste";
			}
			else
			{
				$stack = $off_list->offer_share; 
				$done = $off_list->accepted_share;
				$win = $off_list->accepted_share*$off_list->amount;
				$win = round($win - (($win/100)*$ratio),2);
				$color = "pink";
			}
			if($off_list->accepted_share < $off_list->offer_share) { 
			$clo_on = "level_color"; 
			$close = "onClick='close_off(".$off_list->id.")'";
			} else { $clo_on = ""; $close = ""; $edit = ""; }
			?>
           	<div class="w3-row"> 
                 <div class="w3-col s12 m12">
                      <div class="w3-col m2 s2 w3-center marg2 padd w3-medium">
                          <i class="fa fa-pencil-square-o fa-2x level_color" onClick="offUpdate('<?=$off_list->id?>')" aria-hidden="true"></i>
                      </div>
                        <div class="w3-col s5 m5 marg4">
                            <div class="w3-row <?=$color?>"> 
                                <div class="w3-col m6 s5 padd"> 
                                    <span class="level_color"><?=$off_list->amount?></span> 
                                </div>
                                <div class="w3-col m6 s7 w3-right-align padd"> 
                                    <span class="level_color"><?=$off_list->offer_share-$off_list->accepted_share?></span>
                                    <span class="w3-text-gray"> |<?=$off_list->offer_share?></span>
                                </div>
                            </div>
                        </div>
                        <div class="w3-col s2 m2 <?=$clo_on?> w3-center marg2 w3-medium"> 
                            <i class="fa fa-times-circle-o fa-2x" <?=$close?> aria-hidden="true"></i> 
                        </div>
                        <div class="w3-col s3 m4 w3-left marg2 w3-center"> 
                            <span class="text4"><?=$off_list->name?> </span>
                        </div>
                    </div>
             </div>
             <div class="w3-row">
             	<div class="w3-col s9 m8 padd10">
                	<div class="marg10 padd4"> 
                    	<div class="w3-col s4 m4 back_clr marg12">
                        	<span class="txt_white">stake $</span> <span class="text9"><?=$stack?></span>
                        </div> 
                        <div class="w3-col s4 m4 padd9 back_clr marg12">
                            <span class="txt_white">done $</span> <span class="text9"><?=$done?></span>
                        </div> 
                        <div class="w3-col s4 m4 padd9 back_clr marg12">
                            <span class="txt_white"> win $</span> <span class="text9"><?=$win?></span> 
                        </div>
                    </div>
            	</div>
            </div>
            <?php } ?>
        </div>
        <?php $i++; } ?>
    </div>
    
    <div id="acceptList" class="w3-container w3-small nopading slipPanel" style="display:none;">
    	<?php $x = 0; foreach($accept as $acc_row) { ?>
    	<div class="w3-col m12 s12 back_clr4">
        	<div class="w3-row padd144">
            	<div class="w3-col m8 s10 w3-left-align padd2 padd20"> 
                	<span class="txt_white2"><?=$acc_mat_name[$x]?> </span> 
                </div>
                <div class="w3-col m4 s2 w3-left-align padd2 padd20"><img src="<?=base_url()?>images/<?=$acc_mat_img[$x]?>.png" width="20" height="20">
                </div>
            </div>
            <?php foreach($acc_row->result() as $acc_list) { 
			if($acc_list->type == 'offer') { 
				$stack = $acc_list->share_amount; 
				$win = $acc_list->share_amount*$acc_list->amount;
				$win = round($win - (($win/100)*$ratio),2);
				$color = "paste";
			}
			else
			{
				$stack = $acc_list->share_amount*$acc_list->amount; 
				$win = $acc_list->share_amount;
				$win = round($win - (($win/100)*$ratio),2);
				$color = "pink";
			}
			if($acc_list->offer_share > $acc_list->share_amount) 
			{ 
				$add = "onClick='add_off(`".$acc_list->match_id."`,`".$acc_list->amount."`,`".$acc_list->type."`,`".$acc_list->support_team."`,`".$acc_list->incl."`)'"; 
				$edit = "level_color";
			}
			else
			{
				$edit = "";
				$add = "";
			}
			?>
           	<div class="w3-row"> 
                 <div class="w3-col s12 m12">
                      <div class="w3-col m2 s2 w3-center w3-text-gray marg2 padd w3-medium">
                          <i class="fa fa-pencil-square-o fa-2x <?=$edit?>" <?=$add?> aria-hidden="true"></i>
                      </div>
                      <div class="w3-col s5 m5 marg4">
                          <div class="w3-row <?=$color?>"> 
                                <div class="w3-col m8 s5 padd"> 
                                    <span class="level_color"><?=$acc_list->amount?></span> 
                                </div>
                                <div class="w3-col m4 s7 w3-right-align padd"> 
                                    <span class="level_color"><?=$acc_list->share_amount?></span>
                                    <span class="w3-text-gray"> |<?=$acc_list->offer_share?></span>
                                </div>
                            </div>
                      </div>
                      <div class="w3-col s5 m5 w3-center marg2"> 
                          <span class="text4"><?=$acc_list->name?></span>
                      </div>
                  </div>
             </div>
            <div class="w3-row">
               <div class="w3-col s9 m8 padd10">
                        <div class="marg10 padd4"> 
                            <div class="w3-col s4 m4 back_clr marg12">
                                <span class="txt_white">stake $</span> <span class="text9"><?=$stack?></span>
                            </div> 
                            <div class="w3-col s4 m4 padd9 back_clr marg12">
                                <span class="txt_white">win $</span> <span class="text9"><?=$win?></span>
                            </div> 
                            
                        </div>
                    </div>
            </div>
            <?php } ?>
        </div>
        <?php $x++; } ?>
    </div>
    </div>  
    </div>
    <!-- bet slip End --> 
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
</div>
<div id="offerBox" class="w3-modal w3-animate-zoom w3-center">
	<div id="offerPanel" class="w3-modal-content offerPanel w3-small">

    </div>
</div>
<div id="acceptBox" class="w3-modal w3-animate-zoom w3-center">
	<div id="acceprPanel" class="w3-modal-content acceptPanel w3-small">

    </div>
</div>
<script>

// bet slip
function betSlip(evt, TeamName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("slipPanel");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("slipTab");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-green", "");
  }
  document.getElementById(TeamName).style.display = "block";
  evt.currentTarget.className += " w3-green";
}
function close_off(v)
{
	$.get("<?=base_url()?>game/close_offer/"+v, function( data ) 
	{
		if(data == "successfull")
		{
			location.reload();
		}
	});
}
// offer update
function offUpdate(v)
{
	var dataURL = "<?=base_url()?>game/offer_update_form/"+v;
	$('#acceprPanel').load(dataURL,function(){
		$('#acceptBox').show();
	});
}
function add_off(mat,amt,typ,tm,inc)
{
	var dataURL = "<?=base_url()?>game/accept_form/"+mat+"/"+typ+"/"+tm+"/"+amt+"/"+inc;
	$('#acceprPanel').load(dataURL,function(){
		$('#acceptBox').show();
	});
}
function slpUpdate()
{
   location.reload();
}
</script>
</body>
</html>