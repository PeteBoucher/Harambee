<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 *
	 * @var int $projID project identifier
	 * So any other public methods not prefixed with an underscore will
	 * map to /project/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($projID)
	{
		$data['projID'] = $projID;
		
		//Retrieve project details
		$this->db->select('OrgId, Name, DateFounded, City, Country, Description, Avatar');
		$this->db->from('Project');
		$this->db->join('Profile', 'Profile.id = Project.ProfileId');
		$this->db->where(array('Project.id' => $projID, 'ProfileType' => 'proj'));
		$this->db->limit(1);
		$project = $this->db->get();
		
		//Populate array for output to view
		$row = $project->row();
		$data['orgID'] = $row->OrgId;
		$data['projName'] = $row->Name;
		$data['dateFounded'] = $row->DateFounded;
		$data['city'] = $row->City;
		$data['country'] = $row->Country;
		$data['description'] = $row->Description; //also used for description meta tag
		$data['goalPicURL'] = $row->Avatar; //TODO format picture dimensions for output
		$data['title'] = $data['projName'].' in '.$data['city']; //set page title tag
		$keywords = $this->_extractKeyWords($data['description'], 3);
		$data['keywords'] = implode(',', array_keys($keywords)); //set page keywords meta tag
		
		//Retrieve list of goals for this project
		$this->db->select('id, Name, GoalAmount, GoalCurrency, Description');
		$this->db->from('Goal');
		//$this->db->join('Profile', 'Profile.ProfileID = Goal.ProfileID');
		$this->db->where(array('ProjectId' => $projID/* , 'ProfileType' => 'goal' */));
		$this->db->order_by('GoalAmount', 'desc');
		$goals = $this->db->get();
		
		//Populate data.goal array for view
		if ($goals->num_rows() > 0)
		{
			foreach ($goals->result() as $row)
			{
				$data['goal'][$row->id] = array(
									  //'id' => $row->GoalID,
									  'name' => $row->Name,
									  'amount' => number_format($row->GoalAmount, 2, '.', ','),
									  'currency' => $row->GoalCurrency,
									  'text' => $row->Description,
									  /* 'picURL' => $row->Avatar, */
									  'uri' => array('project','goal',$row->id),
									  );
			}
		}
		else
		{
			$data['goal'][] = array(
									'name' => 'No Goals defined',
									  'amount' => '',
									  'currency' => '',
									  'text' => 'Nothing here yet',
									  'picURL' => '',
									  'uri' => '',
									  );
		}

		
		//Retrieve parent Organsation details
		$organisation = $this->_orgResponsable($projID);
		//Merge organisation array with view array
		$data = array_merge($data, $organisation);
		
		$data['nav'] = array();
		
		/* $geoLocation = array ('geoplugin_latitude' => '-33.431441',
  							  'geoplugin_longitude' => '20.742188',);
		$map_x = round($geoLocation['geoplugin_longitude']*0.748, 0); //"-4";
		$map_y = round($geoLocation['geoplugin_latitude']*0.443, 0) * -1; //"-16";
		$data['style']['#rightcolumn .world-map #overlay'] =  "background-position:{$map_x}px {$map_y}px"; */
		

		$data['goalsHeader'] = 'Project Goals';
		$this->load->view('project_view', $data);
	}
	
	/**
	 * Page function outputs the goal info for a given goalID.
	 *
	 *
	 * @var int $goalID goal identifier
	 */
	public function goal($goalID, $lang = 'en')
	{
		
		if ($lang)
		{
			switch ($lang)
			{
				case 'en':
					//language is english
					$this->lang->load('general', 'english'); //language helper autoloaded in config
					$data['lang'] = array('file' => "general", 'language' => "english");
					break;
				case 'es':
					//language is spanish
					$this->lang->load('general', 'spanish'); //language helper autoloaded in config
					$data['lang'] = array('file' => "general", 'language' => "spanish");
					break;				
			}
		}
		//$this->output->enable_profiler(TRUE); //Debug
		
		//Retrieve details of requested goal
		$goal = $this->db->query(
									'SELECT * FROM Goal
									 	WHERE Goal.id = ?', 
									 array($goalID)
									 );
		$data['goalID'] = $goalID;
		foreach ($goal->result() as $row)
		{
			$data['goalName'] = $row->Name;
			$data['description'] = $row->Description;
			$data['goalPicURL'] = /* $row->Avatar */'';
			$data['projID'] = $row->ProjectId;
		}
		
		//Retrieve project details
		$this->db->select('OrgId, Name, DateFounded, City, Country, Description, Avatar');
		$this->db->from('Project');
		$this->db->join('Profile', 'Profile.id = Project.ProfileId');
		$this->db->where(array('Project.id' => $data['projID'], 'ProfileType' => 'proj'));
		$project = $this->db->get();
		
		$row = $project->row();
		$data['projName'] = $row->Name;
		$data['city'] = $row->City;
		$data['country'] = $row->Country;
		$data['projDescription'] = $row->Description;
		
		//Retrieve some other goals from the same project
		$moreGoals = $this->db->query(
									/* 'SELECT * FROM Goal INNER JOIN Profile 
										ON Goal.ProfileID = Profile.ProfileID
										WHERE ProjectID = ? AND GoalID != ?
										LIMIT 0, 30',  */
									 'SELECT * FROM Goal 
									 	WHERE ProjectId = ? AND NOT Goal.id = ?
										LIMIT 30',
									 array($data['projID'], $goalID)
									 );
		
		//Populate the 'goal' data array for the view
		foreach ($moreGoals->result() as $row)
		{
			$textAppend = '';
			if (strlen($row->Description) > 140)
			{
				$textAppend = '..';
			}
			$data['moreGoals'][$row->GoalID] = array(
								  //'id' => $row->GoalID,
								  'name' => $row->Name,
								  'amount' => number_format($row->GoalAmount, 2, '.', ','),
								  'currency' => $row->GoalCurrency,
								  'text' => substr($row->Description, 0, 140).$textAppend,
								  'picURL' => ''/* $row->Avatar */,
								  'uri' => array('project','goal',$row->GoalID),
								  );
		}
		
		//Retrieve parent Organsation details
		$organisation = $this->_orgResponsable($data['projID']);
		
		$data = array_merge($data, $organisation);
		
		//Retrieve officers responsable for this project
		$data['officer'] = $this->_offResponsable($data['projID']);

		//$data['pageMode'] = 'goal';
		$data['title'] = $data['goalName'].' in '.$data['city'];
		//$head['description'] = $data['description'];
		
		//generate keywords from description
		$keywords = $this->_extractKeyWords($data['description'], 3);
		$data['keywords'] = implode(',', array_keys($keywords));
		
		$data['nav'] = array();
		
		//$this->load->view('doctype-head', $head);
		//$this->load->view('header-navbar', $nav);
		$this->load->view('goal_view', $data);
	}
	
	/**
	 * Utility function retrieves parent Organisation info for a given project.
	 *
	 *
	 * @var int $projID projet identifier
	 * 
	 * @retuns array of basic organisation profile items
	 */
	function _orgResponsable($projID)
	{
		$organisation = $this->db->query(
									'SELECT * 
										FROM Project 
										  INNER JOIN (Organisation INNER JOIN Profile 
											ON Organisation.ProfileId=Profile.id)
										  ON Project.OrgId=Organisation.id
										WHERE Project.id = ?
										  AND ProfileType = ?
										  AND Organisation.Status = ?
										LIMIT 0 , 1', 
							//Change LIMIT if/when we decide to allow joint projects between multiple organisations
							//the data passed to the object row->id may be ambiguos in this query result!!
									 array($projID, 'org', 'active')
									 );
		if ($organisation->num_rows() > 0)
		{
			foreach ($organisation->result() as $row) 
			//Change the following to a 2 dimensional array of organisations if above joint projects are allowed
			{
				$data['orgID'] = $row->id;
				$data['orgName'] = $row->Name;
				$data['otgCity'] = $row->City;
				$data['orgCountry'] = $row->Country;
				$data['orgDescription'] = $row->Description;
				$data['orgPicURL'] = $row->Avatar;
			}
		}
		else
		{
			$data[] = FALSE;
		}
		
		return($data);
	}
	
	function _OffResponsable($projID, $limit='30')
	{
		$officer = $this->db->query(
									 'SELECT * FROM `ProjectUserMaps` 
										JOIN (User 
										  JOIN Profile
											ON User.ProfileId = Profile.id)
										  ON ProjectUserMaps.UserId = User.id 
										WHERE ProjectUserMaps.ProjectId = ?
									  LIMIT 0, 30',
									  array($projID)
									  );
		if ($officer->num_rows() > 0)
		{
			foreach ($officer->result() as $row)
			{
				$data['offUserID'] = $row->Name;
			}
		}
		else
		{
			$data[] = 'None listed';
		}
	
		return($data);
	}
		
	function _extractKeyWords($string, $quantity=10)
	{
		$stopWords = array('i','a','about','an','and','are','as','at','be','by','com','de','en','for','from','how','in','is','it','la','of','on','or','that','the','this','to','was','what','when','where','who','will','with','und','the','www');
	  
		$string = preg_replace('/ss+/i', '', $string);
		$string = trim($string); // trim the string
		$string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…
		$string = strtolower($string); // make it lowercase
	  
		preg_match_all('/\b.*?\b/i', $string, $matchWords);
		$matchWords = $matchWords[0];
		 
		foreach ( $matchWords as $key=>$item ) {
			if ( $item == '' || in_array(strtolower($item), $stopWords) || strlen($item) <= 3 ) {
				unset($matchWords[$key]);
			}
		}   
		$wordCountArr = array();
		if ( is_array($matchWords) ) {
			foreach ( $matchWords as $key => $val ) {
				$val = strtolower($val);
				if ( isset($wordCountArr[$val]) ) {
					$wordCountArr[$val]++;
				} else {
					$wordCountArr[$val] = 1;
				}
			}
		}
		arsort($wordCountArr);
		$wordCountArr = array_slice($wordCountArr, 0, $quantity);
		return $wordCountArr;
	}
	
}

/* End of file org.php */
/* Location: ./application/controllers/org.php */

?>
