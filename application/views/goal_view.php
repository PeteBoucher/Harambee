<?php 

$this->load->helper('url');

$this->lang->load($lang['file'], $lang['language']); //language helper autoloaded in config

?>
<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>
       <!-- Begin Left Column --> 
     </p>
     <div id="leftcolumn"> 
     
   	   <div class="heading"><h2><?php echo lang('goal').': '.$goalName.' - '.$city ?></h2></div>
		<?php if (isset($goalPicURL) && ! ($goalPicURL == ""))
        {
            echo '<div class="box"><img src="'.$goalPicURL.'" width="663" height="409" /></div>'; 
        }?>
        
     	<div class="box">
           <p><?php echo $description ?></p> 
           <a href="fw-19-2-col.zip"><?php echo lang('dl_presentation') ?></a>
        </div>
        <?php include('includes/addthis_button.php'); ?>
        <div class="heading"><h2><?php echo lang('parent_project') ?></h2></div>
        <div class="box">
          <h3><?php echo lang('a_part_of_the') ?> <a href="<?php echo '/project/index/'.$projID ?>"><?php echo $projName ?></a> <?php echo lang('project') ?></h3>
          <p><?php echo $projDescription ?></p>
        </div>

        <div class="heading"><h2><?php echo lang('organiser') ?></h2></div>
        <div class="box" itemscope itemtype="http://schema.org/Organization">
          <h3><span itemprop="name"><?php echo anchor('/organisation/overview/'.$orgID, $orgName) ?></span></h3>
          <p><?php echo $orgDescription ?></p>
          <h4><?php echo lang('responsable_officers') ?></h4>
          <ul id="officers">
          	<?php foreach ($officer as $officerID => $officerName) 
			{
				//Debug: print_r($user);
				echo '<li><a href="/user/index/'.$officerID.'"><img src="/profile/pic/'.$officerID.'" height="64" width="64" />'.$officerName.'</a></li>';
				echo"\n";
			}?>
            <li><a href="/user/index/1"><img src="/profile/pic" height="64" width="64" border="0" />Steve</a></li>
            <li><a href="/user/index/1"><img src="/profile/pic" height="64" width="64" border="0" />Bill</a></li>
            <li><a href="/user/index/1"><img src="/profile/pic" height="64" width="64" border="0" />Kevin</a></li>
            <li><a href="/user/index/1"><img src="/profile/pic" height="64" width="64" border="0" />Micheal</a></li>
          </ul>
        </div>
        
     </div> 
     <!-- End Left Column --> 
     
     <!-- Begin Right Column --> 
     <div id="rightcolumn"> 
           
        <div class="button">
          <?php echo anchor('/user/donate/'.$goalID, lang('donate_now')) ?>
        </div>
        <div class="box">
            <img src="/visual/totalizer/goal/<?php echo $goalID ?>/v" alt="Vertical thermometer totaliser for project total" width="185" height="300" />
        </div>
        <div class="region_box">
        	<h2><?php echo $country ?></h2>
        	<img src="/images/maps/<?php echo $country ?>.gif" width="195" height="228" />
        </div>     
        
        <div class="heading"><h3><?php echo lang('more_goals') ?></h3></div>
        <?php //Debug: print_r($goal); ?>
		<?php foreach ($moreGoals as $moreGoalID => $row) { ?>
        <div class="box">
          <img src="/visual/totalizer/goal/<?php echo $moreGoalID ?>/h/185" alt="Horizontal goal totaliser" width="185" height="30" class="totaliser_h" /> <a href="<?php echo site_url($row['uri']) ?>"><?php echo $row['name'] ?></a> <p><?php echo $row['text'] ?></p> 
		  <p><?php echo $row['amount'].' '.$row['currency'].' '.anchor('/project/goal/'.$moreGoalID, lang('donate')) ?></p>
        </div>
        <?php } ?>

     </div> 
     <!-- End Right Column --> 
     
<?php include('includes/footer.php'); ?>