<div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
    
    <div class="w3-bar w3-green s12 w3-padding po w3-center marg15">
        <div class="w3-col s12 m12">
			<span class="level_color5 w3-medium"><?php echo date('d M Y', strtotime(gmdate(("Y-m-d"), time()+6*60*60))); ?></span>
		</div>
    </div> 
       
		<div class="w3-bar s12 regularpaging w3-center">
			<div class="w3-col s1 m1 padd9">
				<span class="text1">Time</span>
			</div>
			<div class="w3-col s2 m3 padd9">
				<span class="text1">Method</span>
			</div>
			<div class="w3-col s3 m2 padd9">
				<span class="text1">Amount</span>
			</div>
			<div class="w3-col s2 m2 padd9">
				<span class="text1">Doller</span>
			</div>
			<div class="w3-col s2 m2 padd9">
				<span class="text1">REF No</span>
			</div>
			<div class="w3-col s2 m2 padd9">
				
			</div>
		</div>
        
<?php foreach($deposit->result() as $pending) {$onl_time = date('h:i', strtotime($pending->date)); ?>	
		<div class="w3-row back_clr w3-small padd w3-center">
			<div class="w3-col s1 m1 padd9">
				<span class="level_color"><?=$onl_time?></span>
			</div>
			<div class="w3-col s2 m3 padd9">
				<span class="level_color"><?=$pending->method?></span>
			</div>
			<div class="w3-col s3 m2 padd9">
				<span class="level_color">৳</span><span class="txt_white4"><?=$pending->bdt?></span>
			</div>
			<div class="w3-col s2 m2 padd9">
				<span class="level_color">$</span><span class="txt_white4"><?=$pending->dollar?></span>
			</div>
			<div class="w3-col s2 m2 padd9">
				<span class="txt_white4">&nbsp;<?php $sn=explode('/',$pending->sender_no); echo $sn[0]; ?></span>
			</div>
			<div class="w3-col s2 m2 padd9">
				<i class="fa fa-times-circle-o fa-2x level_color" aria-hidden="true"></i>
			</div>
         </div>
      <?php } ?>
	</div>
</div>