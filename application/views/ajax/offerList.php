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
			} else { $clo_on = ""; $close = "";}
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
