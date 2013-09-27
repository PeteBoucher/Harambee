<?php //include('../includes/doctype-head.php'); ?>
<?php //include('../includes/header-navbar.php'); ?>
<?php $this->load->helper('url'); ?>
       
       <!-- Begin Left Column --> 
     </p>
     <div id="leftcolumn"> 
     	<h2>Let us help where we can..</h2>
        <div class="box">
			<p>JustCauseWeCan serves as a crowd-finding service to help voluteers and aid-workers on the ground raise top-up funding to realise small, acheveable goal.</p>
        </div>
        <div class="box">
          <h3><?php echo $profile->Name.' '.$profile->Surname ?></h3>
          <p><?php echo $profile->City.', '.$profile->Country ?></p>
        </div>
     </div> 
     <!-- End Left Column --> 
     
     <!-- Begin Right Column --> 
     <div id="rightcolumn">
     	<h2><?php echo $profile->Name ?> beleives passionatly in</h2>
        <div class="box">
          <ul>
          	<?php foreach ($goals as $goal) {?>
        	<li><?php echo anchor('project/goal/'.$goal['GoalID'], $goal['Name']) ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="box">
        	Totaliser
            <img src="../totalizer/v/ID/proj" width="185" height="300" />
        </div>
        <div class="region_box">
        	<h2><?php echo $profile->City ?></h2>
        	<img src="../images/maps/<?php echo $profile->Country ?>.png" width="195" height="228" alt="Map showing <?php echo $profile->Country ?>" />
        </div>     
     </div> 
     <!-- End Right Column --> 
     
<?php //include('../includes/footer.php'); ?>