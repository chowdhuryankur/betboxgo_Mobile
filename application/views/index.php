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
    	<div class="w3-row" style="margin-top:40px;">
            <div class="w3-col s6 m6 w3-padding"> 
                <span class="level_color5"> <strong>NEWS FEED </strong></span> 
            </div>
    	</div>
        
        <div class="w3-col s12 m12 w3-center" style="margin-top:20px;"> 
            <span class="level_color5">CRICKET</span> 
        </div>
        
        <div class="ofpanel">
			<?php
            $rssCr = simplexml_load_file('http://www.espncricinfo.com/rss/content/story/feeds/0.xml');
            $i=1;
            foreach ($rssCr->channel->item as $item) { ?>
            <div class="w3-row">
                <div class="w3-col s12 m12 w3-padding" id="<?=$i?>ti" onClick="newsPanel('<?=$i?>ti');"> 
                    <span class="w3-tiny level_color5"><i class="fa fa-chevron-right_" aria-hidden="true"></i></span>
                    <span class="w3-small text10 po"><?=$item->title?></span> 
                </div>
                <div class="w3-col s12 m12 w3-padding w3-tiny displayNo"> 
                    <div class="detail">
                        <img src="<?=$item->coverImages?>" width="99%">
                        <span><?=$item->description?> &nbsp;</span><span class="level_color5"><?=$item->pubDate?></span>&nbsp;<a href="<?=$item->link?>" target="_new"><span>details</span> </a>
                    </div>
                </div>
            </div>
            <?php if($i>=5) { break; } $i++; } ?>
        </div>
        
        <div class="w3-col s12 m12 w3-center" style="margin-top:20px;"> 
            <span class="level_color5"> FOOTBALL </span> 
        </div>
        
        <div class="ofpanel">
			<?php
            $rssFt = simplexml_load_file('https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=soccer');
            $f=1;
            foreach ($rssFt->channel->item as $item) { ?>
            <div class="w3-row">
                <div class="w3-col s12 m12 w3-padding" id="<?=$f?>fi" onClick="newsPanel('<?=$f?>fi');"> 
                  <span class="w3-tiny level_color5"><i class="fa fa-chevron-right_" aria-hidden="true"></i></span>
                  <span class="w3-small text10 po"><?=$item->title?></span> 
                </div>
                <div class="w3-col s12 m12 w3-padding w3-tiny displayNo"> 
                    <div class="detail">
                        <span><?=$item->description?> &nbsp;</span>
                        <span class="level_color5"><?=$item->pubDate?></span>&nbsp;<a href="<?=$item->link?>" target="_new"><span>details</span></a>
                    </div>
                </div>
            </div>
            <?php if($f>=5) { break; } $f++; } ?>
        </div>
      
    
    	<div class="w3-col s12 m12" style="margin-top:20px;"> 
            <a href="<?=base_url()?>user/registation"><img src="<?=base_url()?>img/bonus.png" width="65%"></a>
        </div>
            
    </div>

<!-- footer Start -->
<?php require('include/footer.php'); ?>
<!-- footer End --> 
</div>

<div id="login" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom offerPanel">

      <div class="w3-center">
        <span onclick="document.getElementById('login').style.display='none'" class="w3-button w3-hover-red w3-display-topright text10" title="Close">×</span>
      </div>
		<?php echo form_open('user/sign_in', array('id'=>"lig_in", 'class'=>"w3-container")); ?>
        <div class="w3-section">
          <label class="text10"><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom margtp" type="text" placeholder="Enter Username" name="usrname" required="">
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

</body>
<script type="application/javascript">
function newsPanel(title)
{
  $(document).ready(function(){
    $("#"+title).next(".w3-col").slideToggle(1000);
  });
}
</script>
</html>