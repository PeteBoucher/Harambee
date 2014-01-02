<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organisation extends CI_Controller {
	
	public function index()
	{
		
		$this->losd->model('organisation_model', 'org');
		//List organisations, page by 30
		
			//Moveed all this to Organisation_model
		// $this->db->select('id, Name, Surname, City, Country, Avatar');
		// $this->db->from('Organisation');
		// $this->db->join('Profile', 'Organisation.ProfileID = Profile.id');
		// $this->db->where('Status', 'active');
		// $this->db->limit('0, 30'); //TODO add paging function
		
		$orgList = $this->org->all();
		
		//Page skeleton
		echo '<h1>List of member organisations</h1>';
		echo '<h2>Skeleton Page (alpha)</h2>';
		$this->load->helper('html');
		$this->load->helper('url');
		if ($orgList->num_rows() > 0)
		{
			
			foreach ($orgList->result_array() as $row)
			{
				//$row['Name'] = anchor('organisation/overview/'.$row['OrgID'], $row['Name']);
				//echo ul($row);
				
			}
			
		}
		
		
		
	}
	
	public function overview($orgID)
	{
		$this->load->model('organisation_model', 'org');
		//Organisation details and projects, page by 30
		
		// $this->db->select('Organisation.id, Name, Surname, Email, Address, City, Country, Description, Avatar');
		// $this->db->from('Organisation');
		// $this->db->join('Profile', 'Organisation.ProfileId = Profile.id');
		// $this->db->where(array('Status' => 'active', 'Organisation.id' => $orgID));
		$org = $this->org->get($orgID);

/* 		echo '<h1>Organisation overview and profile</h1>';
		echo '<h2>Skeleton Page (alpha)</h2>';
		$this->load->helper('html'); */
		if ($org->num_rows() > 0)
		{
			$row = $org->row();
			$data['orgID'] = $row->OrgID;
			$data['orgName'] = $row->Name;
			$data['orgLongName'] = $row->Surname;
			$data['orgAddress'] = $row->Address;
			$data['orgCity'] = $row->City;
			$data['orgCountry'] = $row->Country;
			$data['orgAvatarURI'] = $row->Avatar;
			
			$data['description'] = $row->Description; //also used for description meta tag
			$data['title'] = $data['orgName'].' in '.$data['orgCountry']; //set page title tag
			//$keywords = $this->_extractKeyWords($data['description'], 3);
			$data['keywords'] = '';//implode(',', array_keys($keywords)); //set page keywords meta tag
			
			$data['project'] = $this->_projects($orgID);

/* 			foreach ($org->result_array() as $row)
			{
				$row['Avatar'] = img(array('src' => $row['Avatar']));
				echo ul($row);
			}
			echo $this->_projects($orgID);
 */		
 			$this->load->view('organisation_view', $data);
		}
	}
	
	function _projects($orgID)
	{
		$this->load->model('project_model', 'project');
		//List of projects proposed by organisation X, page by 30
		// Moved to Project_model		
		// $this->db->select('id, Name, City, Country, Avatar');
		// $this->db->from('Project');
		// $this->db->join('Profile', 'Project.ProfileID = Profile.id');
		// $this->db->where(array('Organisation.id' => $orgID));
		// $projectList = $this->db->get();
		$projectList = $this->project->get_by_org($orgID);

		//$this->load->view('includes/doctype-head', $data);
		//$this->load->view('includes/header-navbar', $data);
		//echo '<h2>Projects submitted for fund-raising by this organisation</h2>';
		if ($projectList->num_rows() > 0)
		{
			/* $this->load->helper('html');
			$this->load->helper('url');
			foreach ($projectList->result_array() as $row)
			{
				$row['Name'] = anchor('project/index/'.$row['ProjectID'], $row['Name']);
				$row['Avatar'] = img(array('src' => $row['Avatar']));
				echo ul($row);
			} */
			return $projectList->result_array();
		}
		else
		{
			return false;
		}

		
	}
	
} ?>