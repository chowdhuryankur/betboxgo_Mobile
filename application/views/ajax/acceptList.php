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
                                <div class="w3-col m5 s5 padd"> 
                                    <span class="level_color"><?=$acc_list->amount?></span> 
                                </div>
                                <div class="w3-col m7 s7 w3-right-align padd"> 
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
