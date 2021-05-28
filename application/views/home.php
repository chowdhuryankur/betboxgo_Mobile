<?php require_once('include/function.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Home</title>
<!-- header Start -->
<?php require_once('include/head.php'); ?>
<!-- header End -->
</head>
<body>
<!-- navegation Start -->
<?php require_once('include/nave.php'); ?>
<!-- navegation End --> 
<!-- myTop Start -->
<div class="w3-main w3-black" style="margin-left:250px;">
  <?php require_once('include/mytop.php'); ?>
  <!-- myTop End --> 
  <!-- navegation Start -->
  <?php require_once('include/secondnave.php'); ?>
  <!-- navegation End -->
  <div class="w3-container nopading">
    <?php require('include/tny_manue.php'); ?> 
    <div class="w3-bar w3-black w3-large w3-padding-small"> 
    	<span class="aciveMenu"><?=$date?> <?=$dateShow?></span> 
    </div>
    
    <div id="matchList">
    <?php if(isset($cricket)) { $i = 0; foreach($cricket->result() as $cricket_match) { ?>
    <!-- match start -->
    <div class="w3-panel w3-green w3-round-small w3-padding-small"> <a href="<?=base_url()?>game/offer/<?=$cricket_match->id?>">
      <div class="w3-bar w3-small match nopading">
        <div class="w3-col s8 box"><img src="<?=base_url()?>images/<?=$cricket_match->sporce_typ?>.png"> <?=substr($cricket_match->series,0,35)?></div>
        <div class="w3-col s3 w3-right-align"><?=substr($cricket_match->title,0,10)?></div>
        <div class="w3-col s1 aciveMenu w3-right-align"><?php $total_offer = $cri_total_offer[$i]->row(0); echo $total_offer->cri_total_offer; ?></div>
      </div>
      <div class="w3-bar nopading">
        <div class="w3-col s2">
          <?php live_sign($cricket_match->start_date_time)?>
        </div>
        <div class="w3-col s10 w3-small">
		<?=team_name($cricket_match->team_1)?> 
		<?=team_flag($cricket_match->team_1)?> VS 
        <?=team_flag($cricket_match->team_2)?>
        <?=team_name($cricket_match->team_2)?>
        </div>
      </div>
      </a> 
      </div>
    <!-- match End --> 
   <?php $i++; } } $total_offer = NULL; ?>
   
   
   <?php if(isset($football)) { $i = 0; foreach($football->result() as $football_match) { ?> 
    <!-- match start -->
    <div class="w3-panel w3-green w3-round-small w3-padding-small"> <a href="<?=base_url()?>game/offer/<?=$football_match->id?>">
      <div class="w3-bar w3-small match nopading">
        <div class="w3-col s8 box"><img src="<?=base_url()?>images/<?=$football_match->sporce_typ?>.png" > <?=substr($football_match->series,0,35)?></div>
        <div class="w3-col s3 w3-right-align"><?=substr($football_match->title,0,10)?></div>
        <div class="w3-col s1 aciveMenu w3-right-align"><?php $total_offer = $foot_total_offer[$i]->row(0); echo $total_offer->foot_total_offer; ?></div>
      </div>
      <div class="w3-bar nopading">
        <div class="w3-col s2">
          <?php live_sign($football_match->start_date_time)?>
        </div>
        <div class="w3-col s10 w3-small">
		<?=team_name($football_match->team_1)?> 
		<?=team_flag($football_match->team_1)?> VS 
        <?=team_flag($football_match->team_2)?>
        <?=team_name($football_match->team_2)?>
        </div>
      </div>
      </a>
    </div>
    <!-- match End --> 
    <?php $i++; } } $total_offer = NULL; ?>
    </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>

</body>

</html>