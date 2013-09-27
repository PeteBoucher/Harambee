<?php 

$this->load->helper('url');

$this->load->helper('language');
$this->lang->load('general','english');

?>
<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>

     <!-- Begin Left Column --> 
     <div id="leftcolumn"> 
     
       <div class="heading"><h2><?php echo $orgName.' - '.$orgCountry ?></h2></div>
       <div class="box">
          <div class="box">
              <img src="<?php echo $orgAvatarURI ?>" width="653" height="409" />Org pic
          </div>
          <div class="box">
             <p><?php echo $description ?></p> 
             <a href="">Download presentation</a>
          </div>
          <div class="heading"><h3>Projects</h3></div>
          <div class="box"><p>Please reviev the projects that this organisation is pursuing</p>
          	<?php foreach ($project as $row) { ?>
              <div class="heading"><h4><?php echo anchor('project/index/'.$row['ProjectID'], $row['Name']) ?></h4></div>
              <div class="box">
              	<?php echo $row['City'].', '.$row['Country'] ?>
              </div>
            <?php }?>
          </div>
        </div>        
     </div> 
     <!-- End Left Column --> 
     
     <!-- Begin Right Column --> 
     <div id="rightcolumn"> 
           
        <div class="box">
          <a href="/user/donate/<?php echo $orgID ?>/org">View Projects</a>
        </div>
        <div class="box">
        	Totaliser
            <img src="/visual/totalizer/org/<?php echo $orgID ?>/v" alt="Vertical thermometer totaliser for project total" width="185" height="300" />
        </div>
        <div class="region_box">
        	<h2><?php echo $orgCountry ?></h2>
            <div class="world-map">
              <div id="overlay">
                <img src="/images/maps/world-spacer.gif" width="195" height="86" />
              </div>
            </div>
        </div>     
        
     </div> 
     <!-- End Right Column --> 
     
<?php include('includes/footer.php'); ?>