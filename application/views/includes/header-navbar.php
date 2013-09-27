<body>
   <!-- Begin Wrapper --> 
   <!-- Begin Wrapper --> 
   <div id="wrapper"> 
  
     <!-- Begin Header --> 
     <div id="header"> 
     
           <h1>JustCauseWeCan</h1>
           
     </div> 
     <!-- End Header --> 
     
     <!-- Begin Navigation --> 
     <div id="navigation"> 
     
         <ul>
           <li><?php 
		    if (!($this->uri->segment(1) == 'home')) 
			//Display home navigation link on all pages except 'home'
		    {
				echo anchor('/home', lang('home'));
			}
			?></li>
           <li><?php echo anchor('#nothing', lang('donate')) ?></li>
           <li><?php echo anchor('/user/index/', lang('raise_funds')) ?></li>
           <li><?php echo anchor('#nothing', lang('success_stories')) ?></li>
           <li><?php echo anchor('#nothing', lang('how_it_works')) ?></li>
           <li><?php echo anchor('#nothing', lang('KYC')) ?></li>
           <li><?php echo anchor('/user/index/', lang('login')) ?></li>
         </ul>
     
     </div><!-- End Navigation -->
