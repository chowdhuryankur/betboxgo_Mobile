    <?php require_once('include/function.php'); ?>
	<?php if(isset($cricket)) { $i = 0; foreach($cricket->result() as $cricket_match) { ?>
    <!-- match start -->
    <div class="w3-panel w3-green w3-round-small w3-padding-small"> <a href="<?=base_url()?>game/offer/<?=$cricket_match->id?>">
      <div class="w3-bar w3-small match nopading">
        <div class="w3-col s8 box"><img src="<?=base_url()?>images/<?=$cricket_match->sporce_typ?>.png"> <?=substr($cricket_match->series,0,35)?></div>
        <div class="w3-col s3 w3-right-align"><?=substr($cricket_match->title,0,11)?></div>
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
      </a> </div>
    <!-- match End --> 
   <?php $i++; } } $total_offer = NULL; ?>