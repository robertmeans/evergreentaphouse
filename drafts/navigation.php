<div id="draft_navigation">
<form name="form">
<div>
    <div class="draft_nav_option">
    	<label><input type="radio" name="loc"  onClick="go('log.php');"<?php if ($thisPage=="log") echo "checked"; else { echo ""; }?>><br>Log</label>
    </div>
        
<!-------------------------------------------------------------------------------------------------------------------------------- Begin navigation -->
    
    <div class="draft_nav_option">
    	<label><input type="radio" name="loc" onClick="go('index.php');" <?php if ($thisPage=="index01") echo "checked"; else { echo ""; }?>><br>01</label>
    </div>
<!--    
    <div class="draft_nav_option">
    	<label><input type="radio" name="loc" onClick="go('index02.php');" <?php if ($thisPage=="index02") echo "checked"; else { echo ""; }?>><br>02</label>
    </div>
-->    
<!--        
*** remember to un-comment .draft_nav_option:last-child in css when you're ready to post the beta site ***
<div class="draft_nav_option cf">
    <a class="beta-link" href="../beta" target="_blank"><img src="_images/beta-radio.jpg" border="0" width="12" height="13"><br>Beta</a>
</div>
-->
	
</div> 
</form>       
</div><!-- #draft_navigation -->








