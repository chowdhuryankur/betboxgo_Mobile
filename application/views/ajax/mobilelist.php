      <div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
        <div class="w3-bar s12 w3-small">
          <div class="w3-padding">
          
          	<div class="w3-row marg15">
          		<div class="w3-col s7 m6 w3-left-align padd144">
            		<button class="w3-btn w3-yellow w3-round" onclick="addMob();" style="width:85%; margin-top:1px;"> Add Mobile Wallet </button>
          		</div>
                <div id="succMs" class="w3-col s5 m6 w3-center padd144 w3-hide">
                	Success!
                </div>
            </div>    
          	<div id="pnDt" class="w3-hide">
            	<div class="w3-row marg15">
               		<div class="w3-col s4">
                  		<select id="mobName" class="w3-input w3-border w3-round">
                  		<option selected>SELECT WALLET</option>
                  		<?php foreach($wallet->result() as $mob) { ?>
                      	<option value="<?=$mob->opa_nam?>"><?=$mob->opa_nam?></option>
                  		<?php } ?> 
                  		</select> 
                    </div>  
                   <div class="w3-col s8">
                   	<div class="w3-col s10 w3-center">
                    	<input type="text" class="txton text1" id="nwMob1" value="<?=substr($usr_mob_no,3,14)?>" size="13" readonly="readonly">
                    	<input type="text" class="txton text1" id="nwMob2" value="" size="1">
                    </div>
                    <div class="w3-col s2 w3-center">
                       <i class="fa fa-save fa-2x level_color5 po" aria-hidden="true" onclick="saveMob();"></i>
                     </div>  
                   </div>
               </div>
            </div>
            
  <div class="w3-row w3-center" style="margin-top:13px; margin-bottom:13px;">
            Mobile Wallets for Withdraw Dollar.</div> 
            <div id="walList">   
     <?php $mb=0; if($mobile->num_rows() > 0) { $mbs=$mobile->first_row(); $mb = $mbs->id; } 
		  foreach($mobile->result() as $row) { ?>
               <div class="w3-row marg15" id="row<?=$row->id?>">
                  	<div class="w3-col s5 text1">
                    	<div class="w3-col s3">
				  			<i class="fa fa-times-circle-o fa-2x level_color5 po" aria-hidden="true" onclick="mobDelet('<?=$row->id?>');"></i>
                        </div>    
                        <div class="w3-col s9">
				  			<?=$row->withdra?>
                        </div>    
               		</div>
                	<div class="w3-col s7">
                      <div class="w3-col s10">
                    	<input type="text" size="12" class="txtoff level_color5" id="1curMob<?=$row->id?>" value="<?=substr($row->ac_no,0,11)?>" readonly="readonly">
                        <input type="text" class="txtoff level_color5 mb2" id="2nwMob<?=$row->id?>" value="<?=substr($row->ac_no,11,12)?>" size="1">
                      </div>  
                      <div class="w3-col s2">  
                    	<i id="mobIco<?=$row->id?>" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onclick="mobChange('<?=$row->id?>');"></i>
                      </div>
                 	</div>
                </div>
           <?php } if($mb == 0) { 
		   echo "<div id='emt' class='w3-row w3-center level_color5'>Add Mobile Wallet for Withdraw Dollar.</div>"; } ?>     
              </div>
                
          </div>
        </div>
      </div>
      
<script>
function mobChange(v)
{
	if($("#mobIco"+v).hasClass("fa-save"))
  	{
		var curMob = $("#2nwMob"+v).val();
		
			$.ajax({
				'url' : '<?=base_url()?>user/mobChange',
				'type' : 'POST', 
				'data' : {'curMob' : curMob, 'mbId' : v},
				'success' : function(data)
				{ 
					if(data == "successfull")
					{
							$("#mobIco"+v).removeClass("fa-save").addClass("fa-pencil-square-o");
							$("#2nwMob"+v).addClass("txtoff").removeClass("txton");
							$("#1curMob"+v).addClass("txtoff").removeClass("txton");
					}
				}
			});
	}
	else
  	{
		$("#mobIco"+v).removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#1curMob"+v).addClass("txton").removeClass("txtoff");
		$("#2nwMob"+v).addClass("txton").removeClass("txtoff");
	}	
}

function mobDelet(v)
{
	$.get("<?=base_url()?>user/mobdelet/"+v, function( data ) 
	{
		if(data == "successfull")
		{
			$("#row"+v).remove(); 
		}
	});
}
function addMob()
{
	$("#pnDt").removeClass("w3-hide");
	
	if(!$("#succMs").hasClass("w3-hide"))
	{
		$("#succMs").addClass("w3-hide");
	}
	$("#nwMob2").val('');
}
var fasRow = <?=$mb?>;
function saveMob()
{
	var mobAc1 = '<?=substr($usr_mob_no,3,14)?>';
	var mobAc = $("#nwMob2").val();
	var mobName = $("#mobName").val();
	if(mobName != "SELECT WALLET")
	{
		$.ajax({
				'url' : '<?=base_url()?>user/nwMob',
				'type' : 'POST', 
				'data' : {'mobAc' : mobAc, 'mobName' : mobName},
				'success' : function(data)
				{ 
					if(data != "unsuccess")
					{
						var nwRow = '<div class="w3-row marg15" id="row'+data+'">' +
						'<div class="w3-col s5 text1">' +
						'<div class="w3-col s3"><i class="fa fa-times-circle-o fa-2x level_color5 po" aria-hidden="true" onclick="mobDelet('+data+');"></i></div><div class="w3-col s9"> '+ mobName +'</div></div>' +
						'<div class="w3-col s7">' +
						'<div class="w3-col s10"><input size="12" type="text" id="1curMob'+data+'" class="txtoff level_color5" value="'+mobAc1+'" readonly="readonly"> '+
						'<input size="1" type="text" id="2nwMob'+data+'" class="txtoff level_color5 mb2" value="'+mobAc+'"></div> '+
						'<div class="w3-col s2"><i id="mobIco'+data+'" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onclick="mobChange('+data+');"></i></div></div></div>';
						
						$("#pnDt").addClass("w3-hide");
						$("#succMs").removeClass("w3-hide");
						if(fasRow > 0)
						{
							$("#walList").prepend(nwRow);
						}
						else
						{
							fasRow = data;
							$("#walList").html(nwRow);
						}
					}
				}
			});
	}
}

</script>