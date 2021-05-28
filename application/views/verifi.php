<!DOCTYPE html>
<html>
<head>
<title>betboxgo</title>
<!-- header Start -->
<?php require_once('include/head.php'); ?>
<!-- header End -->
</head>
<body>

<div class="w3-main w3-black">
	<div id="myTop" class="w3-container w3-top w3-theme w3-large nopading w3-bottombar w3-border-teal">
  		<div class="w3-col s12 m12">
    		<div class="w3-col s4 m4">
  				<img src="<?=base_url()?>img/logo.jpg" width="100%">
			</div>
            <div class="w3-col s4 m4"> &nbsp; </div>
            <div class="w3-col s4 m4 w3-right-align padright">
                <button onclick="document.getElementById('login').style.display='block'" class="w3-btn w3-grey w3-small w3-round">LOGIN</button>
            </div>
		</div>
	</div> 
	
    <div class="w3-container" style="min-height:300px;">
    	<div class="w3-row" style="margin-top:60px;">
        
        <h3 class="level_color">CONFIRMATION</h3>
        <div class="text10 w3-bottombar w3-border-teal w3-small w3-padding"> You have registerd successfully. Please chose anyone of the following method to confirm your registation. </div>  
        
        <div class="text10 w3-border-teal w3-small w3-padding w3-border-bottom w3-border-teal">
        <i class="fa fa-star text1" aria-hidden="true"></i>
        A comfirmation <span class="level_color">URL</span> has send to your e-mail address. Please check your mail inbox and click <span class="level_color">URL</span> to complete email varification.  
        </div>
        
        <div class="text10 w3-border-teal w3-small w3-padding">
        <i class="fa fa-star text1" aria-hidden="true"></i>
        A comfirmation <span class="level_color">PIN CODE</span> has send to your mobile number. Please check your inbox and enter the <span class="level_color">PIN CODE</span> to complete mobile varification.  
        </div>
        
           <div class="w3-content w3-card-4 offerPanel">
                <div class="w3-center">
                    <span class="w3-button w3-hover-red w3-display-topright text10" title=""><?php if(isset($msz)) { echo $msz; } ?></span>
                  </div>
                <?php echo form_open('user/check_code', array('class'=>"w3-container")); ?>
                    <div class="w3-section">
                     	 <span class="w3-small text10">Varification SMS Code Within 24 Hour.</span>
                         <input class="w3-input w3-border w3-margin-bottom margtp" type="text" placeholder="Enter Code" name="code" style="width:60%;"required>
                         <a href="#">Re-Send SMS Code?</a>
                         <span class="w3-right w3-small text10">
                         <input type="submit" value="SUBMEET" class="w3-button w3-block w3-grey w3-section w3-padding" >
                         </span>
                    </div>
                    <input type="hidden" name="ssid" value="<?=$cus_id?>" >
                  </form>
            </div> 
    	</div>
        
        
    
    	<div class="w3-col s12 m12" style="margin-top:20px;"> 
            <a href="<?=base_url()?>user/registation"><img src="<?=base_url()?>img/bonus.png" width="65%"></a>
        </div>
            
    </div>

<!-- footer Start -->
<?php require('include/footer.php'); ?>
<!-- footer End --> 
</div>

    

</body>
</html>