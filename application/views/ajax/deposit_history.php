	<div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
    
    	<div class="w3-bar w3-green s12 w3-padding po w3-center marg15">
			<div class="w3-col s9 m8 w3-small w3-center">
            	<div class="w3-col s5 m5">
					<input type="date" class="w3-input w3-border w3-round" id="start_date" name="start_date" <?php if($start_date!=NULL) {?>value="<?=date('d-m-Y', strtotime($start_date))?>" <?php } ?> >
                </div>
                <div class="w3-col s2 m2 w3-center" style="margin-top:4px;">
                	<span class="level_color5">To</span>
                </div>
                <div class="w3-col s5 m5">
                	<input type="date" class="w3-input w3-border w3-round" id="end_date" name="end_date" <?php if($end_date!=NULL) {?>value="<?=date('d-m-Y', strtotime($end_date))?>" <?php } ?>>
                </div>
			</div>
            <div class="w3-col s3 m4 w3-small w3-center" style="margin-top:1px;">
            	<button id="deateSearch" class="w3-btn w3-yellow w3-round"> SEARCH </button>
            </div>
        </div>
        
		<div class="w3-bar s12 regularpaging w3-center">
			<div class="w3-col s2 m1 padd9">
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
		</div>
        
<?php if($deposit != NULL) { foreach($deposit->result() as $pending) { $onl_time = date('d M', strtotime($pending->date));?>	
		<div class="w3-row back_clr w3-small padd w3-center">
			<div class="w3-col s2 m1 padd9">
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
			<div class="w3-col s1 m2 padd9">
				<?php if($pending->status == "Accepted") { ?>
                    <span class="level_color">	
                    <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
				<?php } ?>
                <?php if($pending->status == "Rejected") { ?>
                    <span class="w3-text-red">	
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    </span>
				<?php } ?>
			</div>
         </div>
      <?php } } else { echo "<span class='level_color5'>No record found!</span>"; } ?>
	</div>
</div>
<script>
// search deposit histoer
$(document).ready(function(){
    $('#deateSearch').on('click',function(){
		var start_date = $("#start_date").val();
		var end_date = $("#end_date").val();
        var dataURL = "<?php echo base_url(); ?>balance/hissearch/"+start_date+"/"+end_date;
        $('#panl_body').load(dataURL);
    }); 
});
</script>