      <div class="w3-panel w3-round w3-border ofpanel nopad w3-small">
        <div class="w3-bar s12 w3-small">
          <div class="w3-padding">
          
          	<div class="w3-row marg15">
          		<div class="w3-col s7 m6 w3-left-align padd144">
            		<button class="w3-btn w3-yellow w3-round" onclick="addBnk();" style="width:85%; margin-top:1px;"> Add Bank Account </button>
          		</div>
                <div id="succMs" class="w3-col s5 m6 w3-center padd144 w3-hide">
                	Success!
                </div>
            </div>    
          	<div id="pnDt" class="w3-hide">
            	<div class="w3-row marg15">
               		<div class="w3-col s5 padright">
                  		<select id="bnkName" class="w3-input w3-border w3-round">
                  		<option selected>SELECT BANK</option>
                  		<?php foreach($bank->result() as $bnk) { ?>
                      	<option value="<?=$bnk->bank_name?>"><?=$bnk->bank_name?></option>
                  		<?php } ?> 
                  		</select> 
                    </div>  
                   <div class="w3-col s7">
                     <div class="w3-col s10 w3-center">
                       <input type="text" id="nwBnk" size="18" class="txton text1">
                     </div>
                     <div class="w3-col s2 w3-center">
                       <i class="fa fa-save fa-2x level_color5 po" aria-hidden="true" onclick="saveBank();"></i>
                     </div>
                   </div>
               </div>
            </div>
            
     <div style="margin-top:13px;margin-bottom:13px;" class="w3-row w3-center">Bank Accounts for Withdraw Dollar.</div>
              
            <div id="bnkList">
 <?php $bk=0; if($banklist->num_rows() > 0) { $bks=$banklist->first_row(); $bk = $bks->id; } 
		  foreach($banklist->result() as $row) { ?>
                <div class="w3-row marg15" id="row<?=$row->id?>">
                  <div class="w3-col s6 text1">
                  	<div class="w3-col s2">
				  	<i class="fa fa-times-circle-o fa-2x level_color5 po" aria-hidden="true" onclick="bnkDelet('<?=$row->id?>');"></i>
                    </div>
                    <div class="w3-col s10">
				  		<?=substr($row->withdra,0,20)?>
                    </div>
                  </div>
                  	<div class="w3-col s6">
                    	<div class="w3-col s10">
                    	<input type="text" id="curBnk<?=$row->id?>" size="14" class="txtoff level_color5" value="<?=$row->ac_no?>">
                        </div>
                        <div class="w3-col s2">
                    	<i id="bnkIco<?=$row->id?>" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onclick="bnkChange('<?=$row->id?>');"></i>
                        </div>
                    </div>
                </div>
           <?php } if($bk == 0) { echo "<div id='emt' class='w3-row w3-center level_color5'>Add Bank Account for Withdraw Dollar.</div>"; } ?>   
           </div>  
                
          </div>
        </div>
      </div>
      
<script>
function bnkChange(v)
{
	if($("#bnkIco"+v).hasClass("fa-save"))
  	{
		var curBnk = $("#curBnk"+v).val();
		
		if(curBnk.length > 4)
		{
			$.ajax({
				'url' : '<?=base_url()?>user/bnkChange',
				'type' : 'POST', 
				'data' : {'curBnk' : curBnk, 'bkId' : v},
				'success' : function(data)
				{ 
					if(data == "successfull")
					{
							$("#bnkIco"+v).removeClass("fa-save").addClass("fa-pencil-square-o");
							$("#curBnk"+v).addClass("txtoff").removeClass("txton");
					}
				}
			});
		}
	}
	else
  	{
		$("#bnkIco"+v).removeClass("fa-pencil-square-o").addClass("fa-save");
		$("#curBnk"+v).addClass("txton").removeClass("txtoff");
	}	
}

function bnkDelet(v)
{
	$.get("<?=base_url()?>user/bnkdelet/"+v, function( data ) 
	{
		if(data == "successfull")
		{
			$("#row"+v).remove(); 
		}
	});
}
function addBnk()
{
	$("#pnDt").removeClass("w3-hide");
	if(!$("#succMs").hasClass("w3-hide"))
	{
		$("#succMs").addClass("w3-hide");
	}
	$("#nwBnk").val('');
}
var fasRow = <?=$bk?>;
function saveBank()
{
	var bnkAc = $("#nwBnk").val();
	var bnkName = $("#bnkName").val();
	if(bnkAc.length > 4 && bnkName != "SELECT BANK")
	{
		$.ajax({
				'url' : '<?=base_url()?>user/nwBank',
				'type' : 'POST', 
				'data' : {'bnkAc' : bnkAc, 'bnkName' : bnkName},
				'success' : function(data)
				{ 
					if(data != "unsuccess")
					{
						var nwRow = '<div class="w3-row marg15" id="row'+data+'">' +
						'<div class="w3-col s6 text1"><div class="w3-col s2">' +
						'<i class="fa fa-times-circle-o fa-2x level_color5 po" aria-hidden="true" onclick="bnkDelet('+data+');"></i></div><div class="w3-col s10"> '+ bnkName +
						'</div></div>' +
						'<div class="w3-col s6">' +
						'<div class="w3-col s10"><input size="14" type="text" id="curBnk'+data+'" class="txtoff level_color5" value="'+bnkAc+'"></div> '+
						'<div class="w3-col s2"><i id="bnkIco'+data+'" class="fa fa-pencil-square-o fa-2x level_color5 po" aria-hidden="true" onclick="bnkChange('+data+');"></i>' +
						'</div></div></div>';
						
						$("#pnDt").addClass("w3-hide");
						$("#succMs").removeClass("w3-hide");
						if(fasRow > 0)
						{
							$("#bnkList").prepend(nwRow);
						}
						else
						{
							fasRow = data;
							$("#bnkList").html(nwRow);
						}
					}
				}
			});
	}
}

</script>