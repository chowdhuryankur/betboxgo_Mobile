<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Setting</title>
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
   <div id="matchList">
    <div class="w3-row">
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('pincode');" id="pincode" class="level_color5 w3-border-bottom w3-border-green po"> PIN CODE </span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('banklist');" id="banklist" class="txt_white3 w3-border-bottom w3-border-green po"> BANK LIST</span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('mobile');" id="mobile" class="txt_white3 w3-border-bottom w3-border-green po"> MOBILE </span> </div>
    </div>
    
    <!-- setting start -->
    <div id="panl_body"> 
      <div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
        <div class="w3-bar s12 w3-small">
          <div class="w3-padding">
          
                <div class="w3-row marg15">
                  <div class="w3-col s6 text1">Current Pin</div>
                  	<div class="w3-col s6">
                    	<div class="w3-col s10">
                    	<input type="password" id="curPin" name="curPin" class="txtoff text1" value="*******" pattern=".{4,4}" style="width:95%;">
                        </div>
                        <div class="w3-col s2 w3-center">
                    	<i id="pinIco" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onclick="pinChange();"></i>
                        </div>
                    </div>
                </div>
                <div id="pnCh" class="w3-hide">
                    <div class="w3-row marg15">
                      <div class="w3-col s6 text1">New Pin</div>
                      <div class="w3-col s6">
                        <input type="password" id="nwPin" name="nwPin" class="txton text1" pattern=".{4,4}" style="width:80%;">
                      </div>
                    </div>
                    <div class="w3-row marg15">
                      <div class="w3-col s6 text1">Retype Pin</div>
                      <div class="w3-col s6 text1">
                        <input type="password" id="rePin" style="width:80%;" pattern=".{4,4}" name="rePin" class="txton text1"> <span id="pnWR" class="level_color"> </span>
                      </div>
                    </div>
                    <div class="w3-row marg15">
                      <div class="w3-col s6 text1"><?=$user->securityQuestion?> </div>
                      <div class="w3-col s6 level_color5"> 
                        <input type="text" id="qsAns" style="width:90%;" name="qsAns" class="txton text1">
                      </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- setting End --> 
    </div>
  </div>
  <!-- footer Start -->
  <?php require('include/footer.php'); ?>
  <!-- footer End --> 
</div>
<script>
var base_url = '<?php echo base_url(); ?>';

function i_ue(val)
{
	var inqu = val;
	if(inqu == 'pincode')
	{
		document.getElementById("pincode").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("banklist").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("mobile").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'banklist')
	{
		document.getElementById("pincode").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("banklist").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("mobile").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'mobile')
	{
		document.getElementById("pincode").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("banklist").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("mobile").className = 'level_color5 w3-border-bottom w3-border-green po';
	}
	
	var controller = "user";
	$.ajax({
		'url' : base_url + controller + '/panel',
		'type' : 'POST', //the way you want to send data to your URL
		'data' : {'inqu' : inqu},
		'success' : function(data){ //probably this request will return anything, it'll be put in 	var "data"
			var container = $('#panl_body'); //jquery selector (get element by id)
			if(data){
				container.html(data);
			}
		}
	});
}


function pinChange()
{
	if($("#pinIco").hasClass("fa-save"))
  	{
		var curPin = $("#curPin").val();
		var nwPin = $("#nwPin").val();
		var rePin = $("#rePin").val();
		var qsAnswer = $("#qsAns").val();
		
		if(nwPin == rePin)
		{
			if(nwPin.length == 4)
			{
				$.ajax({
					'url' : '<?=base_url()?>user/pinChange',
					'type' : 'POST', 
					'data' : {'curPin' : curPin, 'nwPin' : nwPin, 'qsAnswer' : qsAnswer},
					'success' : function(data)
					{ 
						if(data == "successfull")
						{
							$("#pinIco").removeClass("fa-save").addClass("fa-pencil-square-o");
							$("#curPin").addClass("txtoff").removeClass("txton");
							$("#nwPin").val('');
							$("#qsAns").val('');
							$("#rePin").val('');
							$("#pnCh").html("Pin was change successfully!");
						}
						if(data == "wronglength")
						{
							$("#pnWR").html("Pin should be 4 digit.");
						}
						if(data == "wrongpin")
						{
							$("#crpiWr").removeClass("w3-hide");
						}
					}
				});
			}
		}
		else
		{
			$("#nwPin").addClass("txtred").removeClass("txton");
			$("#rePin").addClass("txtred").removeClass("txton");
			$("#pnWR").html("Pin Missmatch");
		}
	}
	else
  	{
		$("#pinIco").removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#curPin").addClass("txton").removeClass("txtoff");
		$("#curPin").val('');
		$("#pnCh").removeClass("w3-hide");
		$("#pnWR").html(" ");
	}	
}

</script>

</body>
</html>