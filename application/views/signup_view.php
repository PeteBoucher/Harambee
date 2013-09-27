<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>
       
       <!-- Begin Left Column --> 
     </p>
     <div id="leftcolumn"> 
     	<h2>Let us help where we can..</h2>
        <div class="box">
			<p>JustCauseWeCan serves as a crowd-finding service to help voluteers and aid-workers on the ground raise top-up funding to realise small, acheveable goal.</p>
        </div>
        <div class="box">
          <form action="/user/signup/1" method="post" enctype="text/plain">
            <div class="formField">
              <label for="userType">How can you help?</label>
              <select id="userType" name="userType">
                <option value="Donor" label="As a donor: I want to help fund a goal or project" selected="selected">As a donor: I want to help fund a goal or project</option>
                <option value="Officer" label="As an officer: I work for an aid organisation or charity">As an officer: I work for an aid organisation or charity</option>
              </select>
            </div>
            <div class="formField">
              <label for="name">Your name?</label>
              <input id="name" name="name" size="40" accept="text/plain" />
            </div>
            <div class="formField">
              <label for="surname">Surname?</label>
              <input id="surname" name="surname" size="40" accept="text/plain" />
            </div>
            <div class="formField">
              <label for="email">Your email address?</label>
              <input id="email" name="email" size="40" accept="text/plain" />
            </div>
            <div class="formField">
              <label for="address">Street address?</label>
              <input id="address" name="address" size="40" accept="text/plain" />
            </div>
            <div class="formField">
              <label for="city">City?</label>
              <input id="city" name="city" size="40" accept="text/plain" />
            </div>
            <div class="formField">
              <label for="country">Country?</label>
              <input id="country" name="country" size="40" accept="text/plain" />
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