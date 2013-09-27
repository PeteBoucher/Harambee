<?php 
$this->load->helper('url');

$this->load->helper('language');
$this->lang->load('general','english');

?>
<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>
       
       <!-- Begin Left Column --> 
     </p>
     <div id="leftcolumn"> 
     	<div class="heading"><h2>Make a Real Diference</h2></div>
        <div class="box">
		 <?php 
         $i=0;
         foreach ($project as $projID => $row) 
         { ?>
            <div class="feature" <?php echo 'id="featured'.$i.'"' ?>>
                <h2 style="background-color:#<?php echo $row['bgCol'] ?>"><?php echo anchor('project/index/'.$projID, $row['projName']) ?></h2>
                <h3 style="background-color:#<?php echo $row['bgCol'] ?>">by <?php echo anchor('organisation/overview/'.$row['orgID'], $row['orgName']) ?></h3>
                <div class="projectPic">
                    <a href="<?php echo '/project/index/'.$projID ?>" title="<?php echo $row['projName'] ?>">
                    	<img src="<?php echo $row['projPicURL'] ?>" alt="<?php echo $row['projName'] ?>" width="219" height="293" />
                    </a>
                </div>
            </div>
		 <?php 
         $i++;
         } ?>
        </div>
        <div class="heading"><h3>Hot Projects this Week</h3></div>
        <div class="box">
        	
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
        <h2>JustCauseWeCan</h2>
        <div class="box">
          <p>The Internet is taking hold in developing nations at an astounding rate. 
            Every week, it seems, a new tech start-up emerges in Africa or Asia with a unique 
            perspective on how to serve local people who are coming online via both fixed-line
            and mobile devices.</p>
          <p>The goal of <strong>JustCauseWeCan</strong> is to aleviate poverty throgh the inteconnectedness of the
            web, by funding small acheavable goals and following the progress of those people
            bringing about the greatest change to the lives of people and in conservation 
            projects, on the ground.</p>
        </div>    
     </div> 
     <!-- End Right Column --> 
     
<?php include('includes/footer.php'); ?>