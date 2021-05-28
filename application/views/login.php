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
    	<div class="w3-row" style="margin-top:80px;">
           <div class="w3-modal-content w3-card-4 w3-animate-zoom offerPanel">

                  <div class="w3-center">
                    <span class="w3-button w3-hover-red w3-display-topright text10" title=""><?php if(isset($msz)) { echo $msz; } ?></span>
                  </div>
            
                  <?php echo form_open('user/sign_in', array('id'=>"lig_in", 'class'=>"w3-container")); ?>
                    <div class="w3-section">
                      <label class="text10"><b>Username</b></label>
                      <input class="w3-input w3-border w3-margin-bottom margtp" type="text" placeholder="Enter Username" name="usrname" required>
                      <label class="text10"><b>Password</b></label>
                      <input class="w3-input w3-border margtp" type="password" placeholder="Enter Password" name="psw" required="">
                      <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                    </div>
                  </form>
            
                  <div class="w3-container w3-padding">
                    <a class="w3-button w3-grey" href="<?=base_url()?>user/registation">JOIN NOW</a>
                    <span class="w3-right w3-small text10"> <a href="#">Forgot password?</a></span>
                  </div>
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