      <!-- bkash -->
      <div class="w3-panel w3-round marg6 ofpanel nopad">
        <div id="bKash" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('bKash');"> <img src="<?=base_url()?>images/bkash.jpg" height="22">
          <div id="depArowbKash" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($bkash != 'wait') { ?>
            <div class="w3-row margrbot" id="bkpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="bktyp" type="radio" id="bkpersonal" onClick="shoNo('bk','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="bktyp" type="radio" id="bkagent" onClick="shoNo('bk','agnt');" value="agent">
                  AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span> 
              	<span id="bkpers" class="text10"><?=$bkno_personal->sim_number?></span>
                <span id="bkagnt" class="text10 dsply_n"><?=$bkno_agent->sim_number?></span> 
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="bkmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" max="15000" min="500" placeholder="500" name="bkbdt" id="bkbdt" onChange="call_dollar('bk');" onKeyPress="call_dollar('bk');" onKeyUp="call_dollar('bk');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="bkdlr" type="text" class="w3-input margtp w3-border w3-round" id="bkdlr" maxlength="3" readonly="readonly" placeholder="6.25">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="text" id="bktrx">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" maxlength="4" id="bksno">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="bk_reset();" id="bkreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center">
                <button id="bksend" onclick="depRequest('bk');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- roket -->
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
        <div id="roket" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('roket');"> <img src="<?=base_url()?>images/roket.jpg" height="22">
          <div id="depArowroket" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($roket != 'wait') { ?>
            <div class="w3-row margrbot" id="rkpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="rktyp" type="radio" id="rkpersonal" onClick="shoNo('rk','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="rktyp" id="rkagent" type="radio" onClick="shoNo('rk','agnt');" value="agent">
                  AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span>
              <span id="rkpers" class="text10"><?=$Rkno_personal->sim_number?></span> 
              <span id="rkagnt" class="text10 dsply_n"><?=$Rkno_agent->sim_number?></span> 
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="rkmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" min="500" max="15000" placeholder="500" maxlength="5" name="rkbdt" id="rkbdt" onChange="call_dollar('rk');" onKeyPress="call_dollar('rk');" onKeyUp="call_dollar('rk');" required>
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="rkdlr" type="text" class="w3-input margtp w3-border w3-round" id="rkdlr" value="" readonly="readonly" placeholder="6.25" required>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" id="rktrx" type="text" onKeyPress="sendButton('rk');" onKeyDown="sendButton('rk');" onKeyUp="sendButton('rk');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" id="rksno" maxlength="4" type="number" onKeyPress="sendButton('rk');" onKeyDown="sendButton('rk');" onKeyUp="sendButton('rk');" required >
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="rk_reset();" id="rkreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center">
                <button id="rksend" onclick="depRequest('rk');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <!-- nogod -->
      <div class="w3-panel w3-round marg6 ofpanel nopad w3-small">
        <div id="nogod" class="w3-bar w3-green s12 w3-padding po w3-medium" onClick="depositPanel('nogod');"> <img src="<?=base_url()?>images/nagad.jpg" height="22">
          <div id="depArownogod" class="arrow_color fa fa-chevron-left fa-lg margtp w3-right"></div>
        </div>
        <div class="w3-bar s12 displayNo w3-small">
          <div class="w3-padding">
          <?php if($nogod != 'wait') { ?>
            <div class="w3-row margrbot" id="ngpanel">
              <div class="w3-col s8 m8 text10">
                <div class="w3-col s6 m6">
                  <input name="ngtyp" type="radio" id="ngpersonal" onClick="shoNo('ng','pers');" value="personal" checked>
                  PERSONAL </div>
                <div class="w3-col s6 m6">
                  <input name="ngtyp" type="radio" id="ngagent" onClick="shoNo('ng','agnt');" value="agent">
                  AGENT </div>
              </div>
              <div class="w3-col s4 m4"> <span class="level_color5">To</span> 
              <span id="ngpers" class="text10"><?=$nogod_personal->sim_number?></span> 
              <span id="ngagnt" class="text10 dsply_n"><?=$nogod_agent->sim_number?></span>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="ngmnytp" class="text10">Send money</span> <span class="level_color5"> ৳ </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" min="500" max="15000" placeholder="500" maxlength="3" name="ngbdt" id="ngbdt" onChange="call_dollar('ng');" onKeyPress="call_dollar('ng');" onKeyUp="call_dollar('ng');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Balance in </span> <span class="level_color5"> $ </span> </label>
                <input name="ngdlr" type="text" class="w3-input margtp w3-border w3-round" id="ngdlr" readonly="readonly" placeholder="6.25">
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144">
                <label> <span id="cpitxta" class="text10">TRX ID </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="text" name="ngtrx" id="ngtrx" required onKeyPress="sendButton('ng');" onKeyDown="sendButton('ng');" onKeyUp="sendButton('ng');">
              </div>
              <div class="w3-col s6 m6 padd144">
                <label> <span class="text10">Sender Mobile </span> </label>
                <input class="w3-input margtp w3-border w3-round" type="number" maxlength="4" id="ngsno" name="ngsno" onKeyPress="sendButton('ng');" onKeyDown="sendButton('ng');" onKeyUp="sendButton('ng');" required>
              </div>
            </div>
            <div class="w3-row">
              <div class="w3-col s6 m6 padd144 w3-center">
                <button onclick="ng_reset();" id="ngreset" class="w3-btn w3-yellow"> RESET </button>
              </div>
              <div class="w3-col s6 m6 padd144 w3-center">
                <button id="ngsend" onclick="depRequest('ng');" class="w3-btn w3-yellow w3-disabled"> SEND </button>
              </div>
            </div>
            <?php } else { ?>
            	<div class="w3-row">
                    <div class="w3-col s4 w3-center">
                        <span class="level_color">
                        <i class="fa fa-check fa-5x" aria-hidden="true"></i></span>
                    </div>
                    <div class="w3-col s4 w3-left-align w3-large">
                        <span class="level_color">PLEASE WAIT .....</span>
                    </div>
                    <div class="w3-col s4">
                    	<span class="text6">Processing in pending queue</span>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>