<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>
       
       <!-- Begin Left Column --> 
     </p>
     <div id="leftcolumn"> 
     	<h2>Let us help where we can..</h2>
        <div class="box">
			<p>JustCauseWeCan serves as a crowd-finding service to help voluteers and aid-workers on the ground raise top-up funding to realise small, acheveable goal.</p>
        </div>
        <h2>Please coose a password</h2>
        <div class="box">
          <form action="/user/signup/2" method="post" enctype="text/plain">
            <div class="formField">
              <label for="password">Password</label>
              <input id="password" name="password" size="20" accept="text/plain" type="password" />
            </div>
            <div class="formField">
              <label for="password2">Password (again)</label>
              <input id="password2" name="password2" size="20" accept="text/plain" type="password" />
            </div>
            <div class="formField">
              <input type="submit" title="Next" />    
            </div>        
          </form>
        </div>
     </div> 
     <!-- End Left Column --> 
     
     <!-- Begin Right Column --> 
     <div id="rightcolumn"> 
        <h2>Categories</h2>
        <div class="box">
        <ul><?php 
		foreach ($catMenu as $category => $bgCol) 
		{
         	echo '<li style="background-color:#'.$bgCol.'"><a href="#nogo">'.$category.'</a></li>';
		}
		?></ul>
        </div>
        <div class="box">
        	Totaliser
            <img src="totalizer/v/ID/proj" width="185" height="300" />
        </div>
        <div class="region_box">
        	<h2>Kenya</h2>
        	<img src="images/maps/africa/kenya.png" width="195" height="228" />
        </div>     
     </div> 
     <!-- End Right Column --> 
     
<?php include('includes/footer.php'); ?>