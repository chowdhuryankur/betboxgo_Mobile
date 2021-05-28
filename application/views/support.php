<!DOCTYPE html>
<html>
<head>
<title>betboxgo: Support</title>
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
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('inbox');" id="inbox" class="level_color5 w3-border-bottom w3-border-green po"> INBOX </span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('send');" id="send" class="txt_white3 w3-border-bottom w3-border-green po"> SEND </span> </div>
      <div class="w3-col s4 m4 w3-padding w3-center"> <span onClick="i_ue('compose');" id="compose" class="txt_white3 w3-border-bottom w3-border-green po"> COMPOSE </span> </div>
    </div>
    
    <!-- message start -->
    <div id="panl_body"> 
      <div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
     <?php foreach($message->result() as $raw) { 
	 if($raw->status=="pending") { $txt="level_color5"; } else { $txt="w3-opacity"; } ?>   
        <div class="w3-bar s12 regularpaging">
			<div class="w3-col s2 m2 padd9">
				<span class="text1"><?=date('d M', strtotime($raw->date_time))?></span>
			</div>
			<div class="w3-col s9 m9 padd9">
			    <div id="rw<?=$raw->id?>" class="oneRow bcolorb <?=$txt?>">
						<?php echo $raw->body; ?>
                </div>
                
                <span id="dlt<?=$raw->id?>" onClick="dlt('<?=$raw->id?>');" class="level_color5 po w3-hide w3-small" style="float:left; margin-bottom:5px;">Delete</span>
                <span id="rp<?=$raw->id?>" onClick="showReplay('<?=$raw->id?>');" class="level_color5 po w3-hide w3-small" style="float:right; padding-right:13px; margin-bottom:5px;">Replay</span>
                <div style="margin-top:20px; text-align:center;" id="cnMsg<?=$raw->id?>" class="w3-hide level_color5"> </div>
                <textarea class="w3-input margtp w3-border w3-round rpb w3-hide" id="rpBx<?=$raw->id?>"></textarea>
				<button id="snd<?=$raw->id?>" class="w3-btn w3-yellow w3-round w3-tiny w3-hide" onclick="send('<?=$raw->id?>');" style="width:20%; float:right; margin-top:10px; margin-bottom:5px; margin-right:13px;"> SEND </button>
                		
			</div>
            <div class="w3-col s1 m1 padd9">   
                <span id="mr<?=$raw->id?>" onClick="showFull('<?=$raw->id?>','<?=$raw->status?>');" class="txt_white4 po w3-small" style="float:right;">Open</span>
            </div>
		</div>
     <?php } ?>   
      </div>
    </div>
    <!-- message End --> 
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
	if(inqu == 'inbox')
	{
		document.getElementById("inbox").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("send").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("compose").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'send')
	{
		document.getElementById("inbox").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("send").className = 'level_color5 w3-border-bottom w3-border-green po';
		document.getElementById("compose").className = 'txt_white3 w3-border-bottom w3-border-green po';
	}
	if(inqu == 'compose')
	{
		document.getElementById("inbox").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("send").className = 'txt_white3 w3-border-bottom w3-border-green po';
		document.getElementById("compose").className = 'level_color5 w3-border-bottom w3-border-green po';
	}
	
	var controller = "support";
	$.ajax({
		'url' : base_url+controller+'/panel',
		'type' : 'POST', 
		'data' : {'inqu' : inqu},
		'success' : function(data)
		{ 
			var container = $('#panl_body');
			if(data)
			{
				container.html(data);
			}
		}
	});
}

function showFull(v,s)
{
	$(document).ready(function(){
		if($("#mr"+v).html() == "Open")
		{
			$("#mr"+v).html("Close");
			var txt = $("#rw"+v).html();
			var hig = (txt.length/35)*21;
			$("#rw"+v).animate({height: hig}, 1000 );
			
			setTimeout(function() {$("#dlt"+v).removeClass("w3-hide");$("#rp"+v).removeClass("w3-hide");}, 900);
    			
			if(s == "pending") 
			{
				$.get("<?=base_url()?>support/msgShow/"+v, function(data) 
				{
					if(data == "successfull")
					{
						//$("#ms"+v).addClass("w3-opacity").removeClass("level_color5");
					}
				});
			}
		}
		else
		{
			$("#mr"+v).html("Open");
			$("#rw"+v).animate({height: 24,}, 1000 );
			$("#rp"+v).addClass("w3-hide");
			$("#dlt"+v).addClass("w3-hide");
			$("#cnMsg"+v).addClass("w3-hide");
			
			if(!$("#rpBx"+v).hasClass("w3-hide"))
			{
				$("#snd"+v).addClass("w3-hide");
				$("#cnMsg"+v).addClass("w3-hide");
				$("#rpBx"+v).animate({height: 0}, 800 );
				setTimeout(function() {$("#rpBx"+v).addClass("w3-hide");}, 800);
			}
		}
	});
}

function showReplay(v)
{
	if($("#rpBx"+v).hasClass("w3-hide"))
	{
		$("#rpBx"+v).removeClass("w3-hide");
		$("#rpBx"+v).animate({height: 89}, 800 );
		$("#snd"+v).removeClass("w3-hide");
	}
}

function send(v)
{
	var txt = $("#rpBx"+v).val();
	
	$.ajax({
		'url' : '<?=base_url()?>support/nwmsg',
		'type' : 'POST', 
		'data' : {'msg' : txt, 'refe' : v},
		'success' : function(data)
		{ 
			var container = $("#cnMsg"+v); 
			if(data)
			{
				$("#snd"+v).addClass("w3-hide");
				$("#rpBx"+v).addClass("w3-hide");
				$("#cnMsg"+v).removeClass("w3-hide");
				container.html(data);
			}
		}
	});
}
</script>

</body>
</html>