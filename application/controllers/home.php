<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
require('project.php');

class Home extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//Debug: $this->output->enable_profiler(TRUE);
		
		//Retrieve featured projects

		// All this moved to the Project_model
		/* $project = $this->db->query(
									'SELECT * FROM Project JOIN Profile
									 	WHERE Featured = ? AND ProfileType = ?', 
									 array(1, 'proj')
									 ); */
		// $this->db->select('Project.id, OrgId, Category, Name, City, Country, Avatar');
		// $this->db->from('Project');
		// $this->db->join('Profile', 'Project.ProfileId=Profile.id', 'inner');
		// //$this->db->where('FeaturedProject', 1); 
		// $this->db->where('ProfileType', 'proj');
		// $this->db->limit(3);
		// $projectList = $this->db->get();

		$this->load->model('Project_model', 'project');
		$projectList = $this->project->get_featured();

		foreach ($projectList->result() as $row)
		{
			$data['project'][$row->id] = array(
				'projName' => $row->Name,
				'city' => $row->City,
				'country' => $row->Country,
				//$data['description'] = $row->Description;
				'projPicURL' => $row->Avatar,
				'bgCol' => $this->_categoryColour($row->Category),
				'orgID' => $row->OrgId,
				'orgName' => $row->OrgId
			);
			
			//Retrieve parent Organsation details
			/* $project = new Project; */
			$organisation = $this->_orgResponsable($row->id);
			//Merge organisation array with view array
			$data['project'][$row->id] = array_merge($data['project'][$row->id], $organisation);

		}
		
		/* $goals = $this->db->query(
									'SELECT * FROM Goal INNER JOIN Profile 
										ON Goal.ProfileID = Profile.ProfileID
										WHERE ProjectID = ?
										LIMIT 0, 30', 
									 array($projID)
									 );
		$organisation = $this->db->query(
									'SELECT * FROM Organisation JOIN Profile
									 	WHERE OrgID = ? AND ProfileType = ?', 
									 array($orgID, 'org')
									 );
		foreach ($organisation->result() as $row)
		{
			$data['orgName'] = $row->Name;
			$data['otgCity'] = $row->City;
			$data['orgCountry'] = $row->Country;
			$data['orgDescription'] = $row->Description;
			$data['orgPicURL'] = $row->Avatar;
		}
		
		foreach ($goals->result() as $row)
		{
			$data['goal'][$row->GoalID] = array(
								  'name' => $row->Name,
								  'amount' => $row->GoalAmount,
								  'currency' => $row->GoalCurrency,
								  'text' => $row->Description,
								  'picURL' => $row->Avatar
								  );
		} */
		
		$data['bgCol'] = array('111','222','333');
		
		$data['title'] = 'Home';
		$data['description'] = 'A crowd-funding site for charitable projects worldwide';
		$data['keywords'] = 'giving,charity,donation,africa,asia,project';
		
		$data['catMenu'] = $this->_categoryColour();
		
		$this->load->view('home_view', $data);
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
		$this->load->model('Organisation_model', 'org');
		// All this moved to the Organisation_model
		// $organisation = $this->db->query(
		// 							'SELECT * 
		// 								FROM Project 
		// 								  INNER JOIN (Organisation INNER JOIN Profile 
		// 									ON Organisation.ProfileId=Profile.id)
		// 								  ON Project.OrgId=Organisation.id
		// 								WHERE Project.id = ?
		// 								  AND ProfileType = ?
		// 								  AND Organisation.Status = ?
		// 								LIMIT 0 , 1', 
		// 					//Change LIMIT if/when we decide to allow joint projects between multiple organisations
		// 							 array($projID, 'org', 'active')
		// 							 );
		$organisation = $this->org->get_by_project($projID);

		if ($organisation->num_rows() > 0)
		{
			foreach ($organisation->result() as $row) 
			//Change the following to a 2 dimensional array of organisations if above joint projects are allowed
			{
				$data['orgID'] = $row->OrgId;
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
	
	function _categoryColour($id=FALSE, $index='projID')
	{
		$categoryColour = array(
								'Health' => 'faa',
								'Wildlife' => '4a4',
								'Development' => '99a',
								'Peace' => 'd4a',
								);
		if ($id == FALSE) //return the entire array of categories
		{
			return($categoryColour);
		}
		else //Return a single hex colour code
		{
		
			/* if ($index == 'projID')
			{
				$this->db->select('Category');
				$this->db->where('ProjectID', $id); 
				$query = $this->db->get('Project');
				$row = $query->row();
				$id = $row->Category;
			} */
			return($categoryColour[$id]);
		}
	}

	function tests() {
		$this->load->library('unit_test');

		$catColour = $this->_categoryColour('Health');
		echo $this->unit->run($catColour, 'faa', 'Colour for Health category should be pink');

	}

}

/* End of file org.php */
/* Location: ./application/controllers/org.php */

?>
