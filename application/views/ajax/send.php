<div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
     <?php foreach($message->result() as $raw) { ?>
        <div class="w3-bar s12 regularpaging">
			<div class="w3-col s2 m2 padd9">
				<span class="text1"><?=date('d M', strtotime($raw->date_time))?></span>
			</div>
			<div class="w3-col s9 m9 padd9">
			    <div id="rw<?=$raw->id?>" class="oneRow bcolorb w3-opacity">
						<?php echo $raw->body; ?>
                </div>
			</div>
            <div class="w3-col s1 m1 padd9">   
                <span id="mr<?=$raw->id?>" onClick="showFull('<?=$raw->id?>','<?=$raw->status?>');" class="txt_white4 po w3-small" style="float:right;">Open</span>
            </div>
		</div>
     <?php } ?>   
      </div>