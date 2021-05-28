<div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
     <?php foreach($message->result() as $raw) { 
	 if($raw->status=="pending") { $txt="level_color5"; } else { $txt="w3-opacity"; } ?>   
        <div class="w3-bar s12 regularpaging">
			<div class="w3-col s2 m2 padd9">
				<span class="text1"><?=date('d M', strtotime($raw->date_time))?></span>
			</div>
			<div class="w3-col s9 m9 padd9">
			    <div id="rw<?=$raw->id?>" class="oneRow bcolorb <?=$txt?>">
						<?php echo $raw->body; ?>
                </div>
                
                <span id="dlt<?=$raw->id?>" onClick="dlt('<?=$raw->id?>');" class="level_color5 po w3-hide w3-small" style="float:left; margin-bottom:5px;">Delete</span>
                <span id="rp<?=$raw->id?>" onClick="showReplay('<?=$raw->id?>');" class="level_color5 po w3-hide w3-small" style="float:right; padding-right:13px; margin-bottom:5px;">Replay</span>
                <div style="margin-top:20px; text-align:center;" id="cnMsg<?=$raw->id?>" class="w3-hide level_color5"> </div>
                <textarea class="w3-input margtp w3-border w3-round rpb w3-hide" id="rpBx<?=$raw->id?>"></textarea>
				<button id="snd<?=$raw->id?>" class="w3-btn w3-yellow w3-round w3-tiny w3-hide" onclick="send('<?=$raw->id?>');" style="width:20%; float:right; margin-top:10px; margin-bottom:5px; margin-right:13px;"> SEND </button>
                		
			</div>
            <div class="w3-col s1 m1 padd9">   
                <span id="mr<?=$raw->id?>" onClick="showFull('<?=$raw->id?>','<?=$raw->status?>');" class="txt_white4 po w3-small" style="float:right;">Open</span>
            </div>
		</div>
     <?php } ?>   
      </div>