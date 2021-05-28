<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>betboxgo</title>
<!-- header Start -->
<?php require_once('include/head.php'); ?>
<?php //echo link_tag('css/bootstrapValidator.css'); ?>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.js"></script>
<!-- header End -->
</head>
<body>
<div class="w3-main w3-black">
  <div id="myTop" class="w3-container w3-top w3-theme w3-large nopading w3-bottombar w3-border-teal">
    <div class="w3-col s12 m12">
      <div class="w3-col s4 m4"> <img src="<?=base_url()?>img/logo.jpg" width="100%"> </div>
      <div class="w3-col s4 m4"> &nbsp; </div>
      <div class="w3-col s4 m4 w3-right-align padright">
        <button onclick="document.getElementById('login').style.display='block'" class="w3-btn w3-grey w3-small w3-round">LOGIN</button>
      </div>
    </div>
  </div>
  <div class="w3-container reg" style="margin-top:45px;">
    <div class="w3-row">
      <div class="w3-large padright margtp"><span class="level_color5">OPEN ACCOUNT</span> </div>
    </div>
    <div class="w3-container  w3-tiny text1 marg"> Accurate personal information is required for the verification and security of your account. Please note, for you to continue to use your account, we will need to successfully verify your identity. </div>
    <span class="text1 w3-tiny"><i class="fa fa-star" aria-hidden="true"></i> Fields must be completed</span> </div>
  <div class="w3-container" style="margin-top:20px;">
    
      <?php echo form_open('user/new_user', array('id'=>"registrationForm")); ?>
      <div class="w3-row padbutom" style="border-bottom: 1px solid #105E46; margin-top:10px; margin-bottom: 10px;">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">Country of Residence</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="country" class="w3-input w3-border w3-round w3-small" value="Bangladesh" type="text" data-toggle="tooltip" title="Your Country" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">Title</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="title" class="w3-input w3-border w3-round w3-small" data-toggle="tooltip" title="Name Title" type="text" value="<?php if(isset($title)) echo $title; ?>">
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">First Name</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="first_name" value="<?php if(isset($first_name)) echo $first_name; ?>" class="w3-input w3-border w3-round w3-small" data-toggle="tooltip" title="Frist Part of Your Name" type="text" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">Last Name</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="last_name" class="w3-input w3-border w3-round w3-small" data-toggle="tooltip" title="Last Part of Your Name" type="text" value="<?php if(isset($last_name)) echo $last_name; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">Gender</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align margtp">
        <input name="gender" type="radio" value="Male" data-bv-field="gender" <?php if(isset($gender) and $gender=='Male') echo "checked"; ?>>
        <span class="level_color">Male</span>
        <input name="gender" type="radio" value="Female" data-bv-field="gender" <?php if(isset($gender) and $gender=='Female') echo "checked"; ?>>
        <span class="level_color">Female </span> </div>
    </div>
    <div class="w3-row padbutom" style="border-bottom: 1px solid #105E46; margin-top:10px; margin-bottom: 10px;">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color">Date of Birth</label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input type="date" name="dob" class="w3-input level_color w3-border w3-round" value="<?php if(isset($dob)) echo $dob; ?>" data-toggle="tooltip" title="Your Date of Birth" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> House No./Name </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="holdingNo" class="w3-input w3-border w3-round w3-small" type="text" data-toggle="tooltip" title="House Holding No" value="<?php if(isset($holdingNo)) echo $holdingNo; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Street Addres </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="stAddress" class="w3-input w3-border w3-round w3-small" type="text" data-toggle="tooltip" title="Road or Area Name" value="<?php if(isset($stAddress)) echo $stAddress; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> City </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="city" class="w3-input w3-border w3-round w3-small" type="text" data-toggle="tooltip" title="Name of City" value="<?php if(isset($city)) echo $city; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom" style="border-bottom: 1px solid #105E46; margin-top:10px; margin-bottom: 10px;">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Postcode </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="postcode" class="w3-input w3-border w3-round w3-small" type="text" data-toggle="tooltip" title="Postal Code" value="<?php if(isset($postcode)) echo $postcode; ?>">
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Email Address </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="email" class="w3-input w3-border w3-round w3-small" type="email" data-toggle="tooltip" title="Must be a Valid email Address" value="<?php if(isset($email)) echo $email; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Confirm Email </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="con_email" class="w3-input w3-border w3-round w3-small" type="email" data-toggle="tooltip" title="Re-enter email Address" value="<?php if(isset($con_email)) echo $con_email; ?>" required>
      </div>
    </div>
    <div class="w3-row padbutom" style="border-bottom: 1px solid #105E46; margin-top:10px; margin-bottom: 10px;">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Contact Number </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
      	<input name="contact1" value="+88" style="width:19%; float:left;" class="w3-input w3-border w3-round w3-small" type="text" readonly>
        <input name="contactno" maxlength="11" class="w3-input w3-border w3-round w3-small" type="text" data-toggle="tooltip" title="Your Mobile Number" value="<?php if(isset($contactno)) echo $contactno; ?>" required style="width:80%; float:right;">
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> User Name </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="username" id="username" class="w3-input w3-border w3-round w3-small" type="text" value="<?php if(isset($username)) echo $username; ?>" data-toggle="tooltip" title="Type any username" required onBlur="username(this.value);" onChange="userName(this.value);">
        <span id="usrErr" class="w3-hide">This Name Not Available!</span>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Password </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="psd" id="psd" class="w3-input w3-border w3-round w3-small" type="password" data-toggle="tooltip" title="Type Password" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Confirm Password </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="con_password" id="con_password" class="w3-input w3-border w3-round w3-small" type="password" data-toggle="tooltip" title="Confirm Password" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Set Security Question </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <select class="w3-input w3-border w3-round w3-small" name="securityQuestion">
              <?php if(isset($securityQuestion)) { ?>
                <option value="<?=$securityQuestion?>" selected>
                <?=$securityQuestion?>
                </option>
                <?php } ?>
                <?php foreach($questions->result() as $question) { ?>
                <option value="<?=$question->question?>">
                <?=$question->question?>
                </option>
                <?php } ?>
              </select>
      </div>
    </div>
    <div class="w3-row padbutom" style="border-bottom: 1px solid #105E46; margin-top:10px; margin-bottom: 10px;">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Set your answer </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="securityAns" class="w3-input w3-border w3-round w3-small" type="text" value="<?php if(isset($securityAns)) echo $securityAns; ?>" data-toggle="tooltip" title="Set Your Answer" required>
      </div>
    </div>
    <div class="w3-row padbutom">
      <div class="w3-col s5 m5 w3-small w3-right-align padright margtp">
        <label class="level_color"> Refference </label>
        <i class="fa fa-star text1" aria-hidden="true"></i> </div>
      <div class="w3-col s7 m7 w3-left-align">
        <input name="password" class="w3-input w3-border w3-round w3-small" type="text" value="<?php if(isset($ref_code)) echo $ref_code; ?>">
      </div>
    </div>
    
    <div class="w3-container w3-tiny text1 marg padbutom" style="margin-top:5px;">
        <label class="w3-col s10"> I would like to receive information about offers and promotions on betboxGo's products. </label>
        <div class="w3-btn">
          <input type="checkbox" data-group-cls="btn-group-sm" name="check1" value="1" required>
        </div>
    </div>
    
    <div class="w3-container w3-tiny text1 marg padbutom" style="margin-top:5px;">
        <label class="w3-col s10">  I am at least 18 years of old and I have read, accept and agree to the Terms and Conditions, Rules, Privacy Policy, Cookie Policy and policy relating age verification and KYC (Know Your Customer).</label>
        <div class="w3-btn">
          <input type="checkbox" data-group-cls="btn-group-sm" name="check2" value="1" required>
        </div>
    </div>
    <div class="w3-table w3-tiny marg padbutom w3-center" style="margin-top:15px;">
    	<button type="submit" class="w3-btn w3-round w3-grey w3-medium" style="width:50%;">JOIN NOW</button>
    </div>
   </form>   
  </div>
  
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<div id="login" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom offerPanel">
    <div class="w3-center"> <span onclick="document.getElementById('login').style.display='none'" class="w3-button w3-hover-red w3-display-topright text10" title="Close">×</span> </div>
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
      <button onclick="window.location.replace('<?=base_url()?>user/registation');" type="button" class="w3-button w3-grey">JOIN NOW</button>
      <span class="w3-right w3-small text10"> <a href="#">Forgot password?</a></span> </div>
  </div>
</div>

<script>
var base_url = '<?php echo base_url();?>';
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip(); 
});

function userName(v)
{
	$.get("<?=base_url()?>user/username_exists/"+v, function( data ) 
	{
		if(data == "false")
		{
			document.getElementById("username").style.borderColor = "#F00";
			$("#usrErr").addClass("text1").removeClass("w3-hide");
		}
		if(data == "true")
		{
			document.getElementById("username").style.borderColor = "#1C513F";
			$("#usrErr").removeClass("text1").addClass("w3-hide");
		}
	});
}

</script>
</body>
</html>