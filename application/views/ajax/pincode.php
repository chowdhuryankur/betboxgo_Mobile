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
                      <div class="w3-col s6 level_color">
                        <input type="password" id="nwPin" name="nwPin" class="txton text1" pattern=".{4,4}" style="width:80%;">
                      </div>
                    </div>
                    <div class="w3-row marg15">
                      <div class="w3-col s6 text1">Retype Pin</div>
                      <div class="w3-col s6 level_color">
                        <input type="password" id="rePin" style="width:80%;" pattern=".{4,4}" name="rePin" class="txton text1"> <span id="pnWR" class="level_color"> </span>
                      </div>
                    </div>
                    <div class="w3-row marg15">
                      <div class="w3-col s6 text1"><?=$user->securityQuestion?> </div>
                      <div class="w3-col s6 level_color"> 
                        <input type="text" id="qsAns" style="width:90%;" name="qsAns" class="txton text1">
                      </div>
                    </div>
                </div>
          </div>
        </div>
      </div>