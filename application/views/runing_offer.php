<?php require_once('include/function.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Live Offer</title>
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
<!-- secondnave Start -->
<?php require('include/secondnave.php'); ?>
<!-- secondnave End -->
<div id="matchList">
<div class="w3-container w3-dark-grey nopading">
    <!-- match start detail-->
   <div class="w3-bar w3-large nopading w3-green">
      <div class="w3-col s2">
           <?php live_sign($mat->start_date_time); ?>
      </div>
      <div class="w3-col s10 w3-medium">
      <?=$team1_nm?> <?=img('images/flag/'.$team1_fg)?> VS <?=img('images/flag/'.$team2_fg)?> <?=$team2_nm?>
      </div>
   </div>
   <div class="w3-container nopading nomargin w3-small w3-text-gray">
   		<div class="w3-col w3-left s6 nopading">
        	 <?=$mat->series?> <br /> <?=$mat->vanue?>
    	</div> 
		<div class="w3-col w3-right s6 nopading"> 
            <?=$mat->title?> <br /> <?=gmdate(("g.i a, d M, Y"),strtotime($mat->start_date_time))?>
            <!-- 1.5pm, Feb 17 2019 -->
        </div>
   </div> 
   <div class="w3-container w3-bottombar w3-border-teal w3-small w3-text-gray nopading nomargin">
   		<div class="w3-container w3-left s6 nopading nomargin">
        	offer <span class="aciveMenu"><?=$my_total_offer?></span> accept <span class="aciveMenu"><?=$my_total_accept?></span> 		</div> 
		<div class="w3-container w3-right s6 nopading nomargin"> 
        	stake <span class="aciveMenu"><?=$currency?><?=$my_total_stak_amount?></span> done <span class="aciveMenu"><?=$currency?><?=$my_total_done?></span>
        </div>
   </div> 
    <!-- match End details-->
   <!-- match offer start-->
    <div class="w3-bar w3-black nopading nomargin w3-small w3-text-gray">
    	<button class="w3-bar-item w3-button tablink w3-green w3-hover-yellow padtb" onclick="openTeam(event,'team1')" style="width:50%"><?=img('images/flag/'.$team1_fg)?> <?=$team1_nm?></button>
    	<button class="w3-bar-item w3-button tablink w3-hover-yellow padtb" onclick="openTeam(event,'team2')" style="width:50%"><?=img('images/flag/'.$team2_fg)?> <?=$team2_nm?></button>
    </div>
    
    <div id="team1" class="w3-container ofpanel padd w3-small">
        <div class="w3-row padd">
              <div class="w3-col s6">
                <div class="w3-row">
                  <div class="w3-col s7 po" onClick="offer('<?=$team_1?>','GIVEN');"> <span class="level_color"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> </span> <span class="text1">GIVEN</span> </div>
                  <div class="w3-col s5 w3-center"> <span class="level_color ">
                   <?=$of1_sm->total-$of1_sm->total_acpt?>
                    </span> <span class="w3-text-gray "> | 
                    <?=$of1_sm->total?>
                    </span> </div>
                </div>
              </div>
              <div class="w3-col s6">
                <div class="w3-row">
                  <div class="w3-col s7 po" onClick="offer('<?=$team_1?>','EXPECTED');"> <span class="level_color"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> </span> <span class="text3">EXPECTED</span> </div>
                  <div class="w3-col s5 w3-center"> <span class="level_color ">
                   <?=$wn1_sm->total-$wn1_sm->total_acpt?>
                    </span> <span class="w3-text-gray "> | 
                    <?=$wn1_sm->total?>
                    </span> </div>
                </div>
              </div>
        </div>
        <div class="w3-row padd">
        
              <div class="w3-col s6 m6 offwi mrg">
              <?php foreach($t1_gv->result() as $t1offer) { ?>
                  <div class="w3-row paste po" onClick="openAccept('offer','<?=$team_1?>','<?=$t1offer->amount?>','<?=$t1offer->incl?>');"> 
              		  <div class="w3-col m7 s7 padd"> 
                      	<span class="level_color "><?=$t1offer->amount?></span> 
                      </div>
                      <div class="w3-col m5 s5 w3-center padd"> 
                      	<span class="level_color">
						<?=$t1offer->total-$t1offer->total_acpt?></span>
                        <span class="w3-text-gray"> | <?=$t1offer->total?></span>
                  	  </div>
                 </div>
              <?php } ?> 
              </div>
        
              <div class="w3-col s6 offwi m6 mrg">
              <?php foreach($t1_ex->result() as $t1expect) { ?>   
                  <div class="w3-row pink po" onClick="openAccept('want','<?=$team_1?>','<?=$t1expect->amount?>','<?=$t1expect->incl?>');"> 
                  	<div class="w3-col m8 s7 padd"> <span class="level_color ">
						<?=$t1expect->amount?></span> 
                    </div>
                  	<div class="w3-col m4 s5 w3-center padd"> <span class="level_color">
                    	<?=$t1expect->total-$t1expect->total_acpt?>
                    	</span> <span class="w3-text-gray"> | 
                    	<?=$t1expect->total?></span>
                  	</div>
                  </div>
              <?php } ?>  
              </div>
             
        </div>
    </div>
   <div id="team2" class="w3-container ofpanel padd w3-small" style="display:none">
      <div class="w3-row padd">
              <div class="w3-col s6">
                <div class="w3-row">
                  <div class="w3-col s7 po" onClick="offer('<?=$team_2?>','GIVEN');"> <span class="level_color"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> </span> <span class="text1">GIVEN</span> </div>
                  <div class="w3-col s5 w3-center"> <span class="level_color ">
                   <?=$of2_sm->total-$of2_sm->total_acpt?>
                    </span> <span class="w3-text-gray"> | 
                    <?=$of2_sm->total?>
                    </span> </div>
                </div>
              </div>
              <div class="w3-col s6">
                <div class="w3-row">
                  <div class="w3-col s7 po" onClick="offer('<?=$team_2?>','EXPECTED');"> <span class="level_color"> <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> </span> <span class="text3">EXPECTED</span> </div>
                  <div class="w3-col s5 w3-center"> <span class="level_color">
                   <?=$wn2_sm->total-$wn2_sm->total_acpt?>
                    </span> <span class="w3-text-gray"> | 
                    <?=$wn2_sm->total?>
                    </span> </div>
                </div>
              </div>
        </div>
        <div class="w3-row padd">
        
              <div class="w3-col s6 m6 offwi mrg">
                  <?php foreach($t2_gv->result() as $t2offer) { ?>
                  <div class="w3-row paste po" onClick="openAccept('offer','<?=$team_2?>','<?=$t2offer->amount?>','<?=$t2offer->incl?>');"> 
              		  <div class="w3-col m7 s7 padd"> 
                      	<span class="level_color "><?=$t2offer->amount?></span> 
                      </div>
                      <div class="w3-col m5 s5 w3-center padd"> 
                      	<span class="level_color">
						<?=$t2offer->total-$t2offer->total_acpt?></span>
                        <span class="w3-text-gray "> | <?=$t2offer->total?></span>
                  	  </div>
                  </div>
              	  <?php } ?> 
              </div>
              
              <div class="w3-col s6 offwi m6 mrg">
              <?php foreach($t2_ex->result() as $t2expect) { ?>   
                  <div class="w3-row pink openAccept po" onClick="openAccept('want','<?=$team_2?>','<?=$t2expect->amount?>,'<?=$t2expect->incl?>'');"> 
                  	<div class="w3-col m8 s7 padd"> <span class="level_color ">
						<?=$t2expect->amount?></span> 
                    </div>
                  	<div class="w3-col m4 s5 w3-center padd"> <span class="level_color">
                    	<?=$t2expect->total-$t2expect->total_acpt?>
                    	</span> <span class="w3-text-gray"> | 
                    	<?=$t2expect->total?></span>
                  	</div>
                  </div>
              <?php } ?>   
              </div>
              
        </div>
   </div>
   <!-- match Offer End -->
   
   <br />
   <br />
   
   <div class="w3-container w3-bottombar w3-border-teal nopading margtp"> </div>
   <div class="w3-bar w3-black nopading nomargin w3-small w3-text-gray">
    	<button class="w3-bar-item w3-button slipTab w3-green w3-hover-yellow s6" onclick="betSlip(event,'offerList')" style="width:50%">MY OFFER LIST</button>
    	<button class="w3-bar-item w3-button slipTab w3-hover-yellow s6" onclick="betSlip(event,'acceptList')" style="width:50%">MY ACCEPT LIST</button>
    </div>
  
  <!-- offer list -->
    <div id="offerList" class="w3-container w3-small nopading slipPanel">
    	<div class="w3-col m12 s12 back_clr4">
        	<div class="w3-row padd144">
            	<div class="w3-col m10 s10 w3-left-align padd2 padd20"> 
                	<span class="txt_white2"> <?=$team1_nm?> vs <?=$team2_nm?> </span> 
                </div>
                <div class="w3-col m2 s2 w3-left-align padd2 padd20"><img src="<?=base_url()?>images/<?=$mat_img?>" width="20" height="20">
                </div>
            </div>
            <div id="of_list">
            <?php foreach($my_offer->result() as $off_list) { 
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
                                <div class="w3-col m5 s5 padd"> 
                                    <span class="level_color"><?=$off_list->amount?></span> 
                                </div>
                                <div class="w3-col m7 s7 w3-right-align padd"> 
                                    <span class="level_color"><?=$off_list->offer_share-$off_list->accepted_share?></span>
                                    <span class="w3-text-gray"> | <?=$off_list->offer_share?></span>
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
        </div>
    </div>
  <!-- accept list -->
    <div id="acceptList" class="w3-container w3-small nopading slipPanel" style="display:none;">
    	<div class="w3-col m12 s12 back_clr4">
        	<div class="w3-row padd144">
            	<div class="w3-col m8 s10 w3-left-align padd2 padd20"> 
                	<span class="txt_white2"><?=$team1_nm?> vs  <?=$team2_nm?>  </span> 
                </div>
                <div class="w3-col m4 s2 w3-left-align padd2 padd20"><img src="<?=base_url()?>images/<?=$mat_img?>" width="20" height="20">
                </div>
            </div>
             <div id="ac_list">
            <?php foreach($my_accept->result() as $acc_list) { 
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
				$add = "onClick='add_off(`".$acc_list->amount."`,`".$acc_list->type."`,`".$acc_list->support_team."`,`".$acc_list->incl."`)'"; 
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
                                <div class="w3-col m4 s5 padd"> 
                                    <span class="level_color"><?=$acc_list->amount?></span> 
                                </div>
                                <div class="w3-col m8 s7 w3-right-align padd"> 
                                    <span class="level_color"><?=$acc_list->offer_share-$acc_list->share_amount?></span>
                                    <span class="w3-text-gray"> | <?=$acc_list->offer_share?></span>
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
        </div>
        </div>
    </div>
</div>
<!-- footer Start -->
<?php require('include/footer.php'); ?>
<!-- footer End -->
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
// offer and accept model controle
function offer(tm,typ) 
{
        var dataURL = "<?=base_url()?>game/offer_form/<?=$match_id?>/"+tm+"/"+typ;
        $('#offerPanel').load(dataURL,function(){
            $('#offerBox').show();
        });
};

function openAccept(typ,tm,amt,nil)
{
	var dataURL = "<?=base_url()?>game/accept_form/<?=$match_id?>/"+typ+"/"+tm+"/"+amt+"/"+nil;
	$('#acceprPanel').load(dataURL,function(){
		$('#acceptBox').show();
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
function add_off(amt,typ,tm,inc)
{
	var dataURL = "<?=base_url()?>game/accept_form/<?=$match_id?>/"+typ+"/"+tm+"/"+amt+"/"+inc;
	$('#acceprPanel').load(dataURL,function(){
		$('#acceptBox').show();
	});
}

// open team data
function openTeam(evt, TeamName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("ofpanel");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-green", "");
  }
  document.getElementById(TeamName).style.display = "block";
  evt.currentTarget.className += " w3-green";
}
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

setInterval(function(){
        var dataURL = "<?=base_url()?>game/live_offer/<?=$match_id?>/<?=$team_1?>";
        $('#team1').load(dataURL);
}, 50000);
setInterval(function(){
        var dataURL = "<?=base_url()?>game/live_offer/<?=$match_id?>/<?=$team_2?>";
        $('#team2').load(dataURL);
}, 50000);


setInterval(function(){
        var dataURL = "<?=base_url()?>game/my_offer/<?=$match_id?>";
        $('#of_list').load(dataURL);
}, 50000);
setInterval(function(){
        var dataURL = "<?=base_url()?>game/my_acpt/<?=$match_id?>";
        $('#ac_list').load(dataURL);
}, 50000);

function slpUpdate()
{
   var dataURL1 = "<?=base_url()?>game/my_offer/<?=$match_id?>";
   $('#of_list').load(dataURL1);
   var dataURL2 = "<?=base_url()?>game/my_acpt/<?=$match_id?>";
   $('#ac_list').load(dataURL2);
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

</script>
 </body>
 </html>