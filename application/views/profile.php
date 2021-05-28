<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Profile</title>
<!-- header Start -->
<?php require('include/head.php'); ?>
<!-- header End -->
</head>
<body>
<!-- navegation Start -->
<?php require('include/nave.php'); ?>
<!-- navegation End --> 
<!-- myTop Start -->
<div class="w3-main w3-black" style="margin-left:250px;">
  <?php require('include/mytop.php'); ?>
  <!-- myTop End --> 
  <!-- navegation Start -->
  <?php require('include/secondnave.php'); ?>
  <!-- navegation End -->
  
  <div class="w3-container nopading miniHight"> 
    <!-- Start Top Tiny manu -->
    <?php require('include/tny_manue.php'); ?> 
    <!-- End Top Tiny manu -->
	<?php function changeData($val,$verification) {
		if($verification == "no") { 
          echo "<i class='fa fa-pencil-square-o fa-lg level_color5' aria-hidden='true' onClick='change($val);'></i>"; } 
	} ?>
    
    <div id="matchList">
    <div class="w3-row">
      <div class="w3-col s12 m12 w3-padding w3-center"> <span level_color5 class="level_color5 w3-border-bottom w3-border-green"> PROFILE DETAILS</span> </div>
    </div>
    <div id="panl_body"> 
      <!-- Profile -->
      <div class="w3-panel w3-round marg6 ofpanel nopad">
        <div id="per" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="dprofilPanel('per');"> Personal Information
          <div id="proArowper" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
            <div class="w3-row margin0 padd border_radi">
              <div class="w3-col s12">
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color5">Betboxgo ID</span> </div>
                  <div class="w3-col s8"> <span class="text1"><?=$user->super_id?></span> </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color5">User Name</span> </div>
                  <div class="w3-col s8"> <span class="text1"><?=$user->user_name?></span> </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color5">Name</span> </div>
                  <div class="w3-col s8">
                    <input type="text" id="name" name="name" class="txtoff text1" value="<?php if(is_null(!$user->title)) echo $user->title; echo $user->fs_name.' '.$user->ls_name; ?>">
                    <?php changeData('name',$user->verification); ?>
                    </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color5">Date of Birth</span> </div>
                  <div class="w3-col s8">
                    <input type="text" name="dob" id="dob" class="txtoff text1" value="<?=date('d M Y', strtotime($user->dob))?>">
                    <?php changeData('name',$user->verification); ?> </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color">Status</span> </div>
                  <div class="w3-col s8"> <?php if($user->verification == 'no') { ?><span class="text1">NOT VERIFIED</span> <div class="col-md-7" data-toggle="modal" data-target="#myModal1"> <span class="level_color smfont boxBorder">Verify Now</span> </div><?php } else { ?>  <span class="text1">VERIFIED</span><?php } ?></div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color">Account</span> </div>
                  <div class="w3-col s8"> <span class="text1 upcase"><?=$user->type?></span> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
        <div id="add" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="dprofilPanel('add');">Address & Contact Information
          <div id="proArowadd" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
            <div class="w3-row margin0 padd border_radi">
              <div class="w3-col s12">
                <div class="w3-row marg15">
                  <div class="w3-col s4"> <span class="level_color5">Address</span> </div>
                  <div class="w3-col s8">
                    <input type="text" id="address" name="address" class="txtoff text1" value="<?=$user->house.' '.$user->stAddress?>">
                    <?php changeData('address',$user->verification); ?></div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4 level_color5">City</div>
                  <div class="w3-col s8 text1">
                    <input type="text" id="city" name="city" class="txtoff text1" value="<?=$user->city.' '.$user->zip?>">
                    <?php changeData('city',$user->verification); ?></div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4 level_color">Email</div>
                  <div class="w3-col s8 text1">
                  	<div class="w3-col s10">
                    <input type="email" id="email" style="width:100%;" name="email" class="txtoff text1" value="<?=$user->email?>">
                    </div>
                    <div class="w3-col s2 w3-right-align">
                    <i class="fa fa-pencil-square-o fa-2x level_color5 po" id="emailIco" onClick="emailChange();"></i> 
                    </div>
                    </div>
                </div>
                <div class="w3-row marg15 w3-hide" id="epin">
                  <div class="w3-col s4 level_color">Enter Pin</div>
                  <div class="w3-col s8 text1">
                    <input type="password" id="empin" size="15" pattern=".{4,4}" name="epin" class="txton text1"> <span id="emWR" class="level_color"> </span>
                  </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4 level_color">Phone</div>
                  <div class="w3-col s8">
                  	<div class="w3-col s10">
                    <input type="text" id="cekk" name="cell" class="txtoff text1" value="<?=$user->mobile?>">
                    </div>
                    <div class="w3-col s2 w3-right-align">
                    <i class="fa fa-pencil-square-o fa-2x level_color5" id="moblIco" aria-hidden="true" onClick="celChange();"></i>
                    </div>
                    </div>
                </div>
                <div class="w3-row marg15 w3-hide" id="mpin">
                  <div class="w3-col s4 level_color">Enter Pin</div>
                  <div class="w3-col s8 text1">
                    <input type="password" id="mopin" size="15" pattern=".{4,4}" name="mopin" class="txton text1"> <span id="moWR" class="level_color"> </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
        <div id="sec" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="dprofilPanel('sec');">Security Information
          <div id="proArowsec" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
            <div class="w3-row margin0 padd border_radi">
              <div class="w3-col s12">
                <div class="w3-row marg15">
                  <div class="w3-col s4 level_color5">Password</div>
                  <div class="w3-col s8">
                  	<div class="w3-col s10">
                    <input type="password" id="pass" name="pass" class="txtoff text1" value="*******" pattern=".{5,10}" style="width:95%;">
                    </div>
                    <div class="w3-col s2 w3-right-align">
                    <i id="pasIco" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onClick="passChange();"></i>
                    </div>
                    </div>
                </div>
                <div id="repasswo" class="w3-row marg15 w3-hide">
                  <div class="w3-col s4 level_color5">Retype Password</div>
                  <div class="w3-col s8">
                    <input type="password" id="repass" name="repass" class="txton text1" pattern=".{5,10}" style="width:80%;">
                  </div>
                </div>
                <div class="w3-row marg15 w3-hide" id="ppin">
                  <div class="w3-col s4 level_color">Enter Pin</div>
                  <div class="w3-col s8 text1">
                    <input type="password" id="papin" size="15" pattern=".{4,4}" name="papin" class="txton text1"> <span id="paWR" class="level_color"> </span>
                  </div>
                </div>
                <div class="w3-row marg15">
                  <div class="w3-col s4 level_color5">Security Question </div>
                  <div class="w3-col s8 text1"> <?php $ques = explode(" ",$user->securityQuestion); $ii = count($ques); echo $ques[0].' **** **** '.$ques[$ii-1]?> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Profile End --> 
    </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<script>
// profile info open
function dprofilPanel(detail)
{
  $(document).ready(function(){
    $("#"+detail).next(".w3-bar").slideToggle(1000);
  	if(document.getElementById("proArow"+detail).className == 'arrow_color fa fa-chevron-left fa-lg margtp w3-right')
      	{
        	document.getElementById("proArow"+detail).className = 'arrow_color fa fa-chevron-down fa-lg margtp w3-right';
      	}
    	else
      	{
        	document.getElementById("proArow"+detail).className = 'arrow_color fa fa-chevron-left fa-lg margtp w3-right';
      	}
  });
}

function emailChange()
{
	if($("#emailIco").hasClass("fa-save"))
  	{
		var pin = $("#empin").val();
		var email = $("#email").val();
		if(pin.length == 4)
		{
			$.get("<?=base_url()?>user/update/email/"+email+"/"+pin, function( data ) {
  				if(data == "successfull")
				{
					$("#emailIco").removeClass("fa-save").addClass("fa-pencil-square-o");
					$("#epin").addClass("w3-hide");
					$("#email").addClass("txtoff").removeClass("txton");
					$("#empin").val("");
				}
				if(data == "wrongpin")
				{
					$("#emWR").html("Wrong Pin");
				}
				if(data == "wrongemail")
				{
					$("#emWR").html("Wrong Email");
				}
			});
		}
	}
	else
  	{
		$("#emailIco").removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#epin").removeClass("w3-hide");
		$("#email").removeClass("txtoff").addClass("txton");
		$("#emWR").html(" ");
	}	
}
function celChange()
{
	if($("#moblIco").hasClass("fa-save"))
  	{
		var pin = $("#mopin").val();
		var mobile = $("#cekk").val();
		if(pin.length == 4)
		{
			$.get("<?=base_url()?>user/update/mobile/"+mobile+"/"+pin, function( data ) {
  				if(data == "successfull")
				{
					$("#moblIco").removeClass("fa-save").addClass("fa-pencil-square-o");
					$("#mpin").addClass("w3-hide");
					$("#cekk").addClass("txtoff").removeClass("txton");
					$("#mopin").val("");
				}
				if(data == "wrongpin")
				{
					$("#moWR").html("Wrong Pin");
				}
				if(data == "wrongnum")
				{
					$("#moWR").html("Wrong Number");
				}
			});
		}
	}
	else
  	{
		$("#moblIco").removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#mpin").removeClass("w3-hide");
		$("#cekk").removeClass("txtoff").addClass("txton");
		$("#moWR").html(" ");
	}	
}

function passChange()
{
	if($("#pasIco").hasClass("fa-save"))
  	{
		var pin = $("#papin").val();
		var pas = $("#pass").val();
		var repas = $("#repass").val();
		if(pas == repas)
		{
			if(pin.length == 4)
			{
				$.get("<?=base_url()?>user/update/password/"+pas+"/"+pin, function( data ) {
					if(data == "successfull")
					{
						$("#pasIco").removeClass("fa-save").addClass("fa-pencil-square-o");
						$("#ppin").addClass("w3-hide");
						$("#repasswo").addClass("w3-hide");
						$("#pass").addClass("txtoff").removeClass("txton");
						$("#papin").val("");
						$("#repass").val("");
					}
					if(data == "wrongpin")
					{
						$("#paWR").html("Wrong Pin");
					}
				});
			}
			$("#pass").addClass("txtoff").removeClass("txtred");
			$("#repass").addClass("txtoff").removeClass("txtred");
		}
		else
		{
			$("#pass").addClass("txtred").removeClass("txton");
			$("#repass").addClass("txtred").removeClass("txton");
			$("#paWR").html("Missmatch");
		}
	}
	else
  	{
		$("#pass").val("");
		$("#pasIco").removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#repasswo").removeClass("w3-hide");
		$("#ppin").removeClass("w3-hide");
		$("#pass").removeClass("txtoff").addClass("txton");
		$("#moWR").html(" ");
	}
}
</script>
</body>
</html>