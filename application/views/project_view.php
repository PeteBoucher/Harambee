<!--BEGIN Google Graph geochart js -->
  <script type='text/javascript' src='https://www.google.com/jsapi'></script>
  <script type='text/javascript'>
   google.load('visualization', '1', {'packages': ['geochart']});
   google.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
      var data = new google.visualization.DataTable();
      data.addRows(6);
      data.addColumn('string', 'Country');
      data.addColumn('number', 'Popularity');
      data.setValue(0, 0, '<?php echo $country ?>');
      data.setValue(0, 1, 1);
      data.setValue(1, 0, 'Russia');
      data.setValue(1, 1, 100);

      var options = {
		    region: 'world',
		    width: 195,
		    height: 86,
			backgroundColor: '#E7DBD5',
			colors: ['red','white'],
	  };

      var container = document.getElementById('map_canvas');
      var geochart = new google.visualization.GeoChart(container);
      geochart.draw(data, options);
  };
  </script>
<!--END Google Graph geochart js -->
<?php 

$this->load->helper('url');

$this->load->helper('language');
$this->lang->load('general','english');

?>
<?php include('includes/doctype-head.php'); ?>
<?php include('includes/header-navbar.php'); ?>

     <!-- Begin Left Column --> 
     <div id="leftcolumn"> 
     
       <div class="heading"><h2>Project <?php echo $projName.' - '.$city ?></h2></div>
       <div class="box">
          <div class="box">
              <img src="<?php echo $goalPicURL ?>" width="653" height="409" />Project pic
          </div>
          <div class="box">
             <p><?php echo $description ?></p> 
             <a href="">Download presentation</a>
          </div>
          <div class="heading"><h3><?php echo $goalsHeader ?></h3></div>
          <?php //Debug: print_r($goal); ?>
          <?php foreach ($goal as $goalID => $row) { ?>
          <div class="box">
            <img src="/visual/totalizer/goal/<?php echo $goalID ?>" alt="Horizontal goal totaliser" width="300" height="30" class="totaliser_h" /> <a href="<?php echo site_url($row['uri']) ?>"><?php echo $row['name'] ?></a> <p><?php echo $row['text'] ?></p> 
            <p><?php echo $row['amount'].' '.$row['currency'] ?></p>
          </div>
        <?php } ?>
        </div>
        <div class="heading"><h3>Organiser</h3></div>
        <div class="box"  itemscope itemtype="http://schema.org/Organization">
          <span class="" itemprop="name"><?php echo anchor('organisation/overview/'.$orgID,$orgName) ?></span>
          <p><?php echo $orgDescription ?></p>
        </div>
        
     </div> 
     <!-- End Left Column --> 
     
     <!-- Begin Right Column --> 
     <div id="rightcolumn"> 
           
        <div class="button">
          <a href="/user/donate/<?php echo $projID ?>/proj">Donate Now</a>
        </div>
        <div class="box">
        	Totaliser
            <img src="/visual/totalizer/proj/<?php echo $projID ?>/v" alt="Vertical thermometer totaliser for project total" width="185" height="300" />
        </div>
        <div class="region_box">
        	<h2><?php echo $country ?></h2>
<!--            <div class="world-map">
              <div id="overlay">
                <img src="/images/maps/world-spacer.gif" width="195" height="86" />
              </div>
            </div> -->
            <!--BEGIN Google Graph geochart c -->
        	<div id='map_canvas'></div>
            <!--END Google Graph geochart canvas -->
        </div>     
        
     </div> 
     <!-- End Right Column --> 
     
<?php include('includes/footer.php'); ?>