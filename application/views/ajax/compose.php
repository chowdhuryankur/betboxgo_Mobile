<div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
        <div class="w3-bar s12 regularpaging">
			<div class="w3-col s2 m2 padd9">
				<span class="text1"><?=date('d M')?></span>
			</div>
			<div class="w3-col s10 m10 padd9">
			    <div id="rw" class="level_color5">
				<div style="margin-top:20px; text-align:center;" id="cnMsg" class="w3-hide level_color5"> </div>
                <textarea style="width: 276px; height: 146px;" class="w3-input margtp w3-border w3-round" id="rpBx"></textarea>
				<button id="snd" class="w3-btn w3-yellow w3-round w3-tiny" onclick="compose();" style="width:20%; float:right; margin-top:10px; margin-bottom:5px; margin-right:25px;"> SEND </button>
                </div>
			</div>
		</div>
      </div>
<script>
function compose()
{
	var txt = $("#rpBx").val();
	var v = "";
	$.ajax({
		'url' : '<?=base_url()?>support/nwmsg',
		'type' : 'POST', 
		'data' : {'msg' : txt, 'refe' : v},
		'success' : function(data)
		{ 
			var container = $("#cnMsg"); 
			if(data)
			{
				$("#snd").addClass("w3-hide");
				$("#rpBx").addClass("w3-hide");
				$("#cnMsg").removeClass("w3-hide");
				container.html(data);
			}
		}
	});
}
</script>