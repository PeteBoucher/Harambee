<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function index($name = NULL)
	{
		if ($name == NULL) {
			//Login page
			echo '<h1>Login here</h1>';
			echo '<p><a href="index/1">Pete&apos;s Profile</a></p>';
			echo '<h3><a href="signup">Join us! Create an account</a></h3>';
		}
		else
		{
			//User profile page
			$data['profile'] = $this->_userPupblicProfile($name);
			$data['goals'] = $this->_userGoalsSupported($name);
			
			$data['title'] = $data['profile']->Name.'\'s profile';
			$data['description'] = $data['profile']->Name.' helps volunteers fund small achiveable goals';
			$data['keywords'] = 'signup,user,member';

			$this->load->view('includes/doctype-head', $data);
			$this->load->view('includes/header-navbar', $data);
			
			$this->load->view('profile/user_view', $data);
			
			$this->load->view('includes/footer', $data);
		}
		
	}
	
   /**
    * Collect user details and crate a profile in the database
	*
	* @param int $stage the stage in the signup process
	*
	*/
	public function signup($stage=0)
	{
		
		$data['title'] = 'sign up as a user';
		$data['description'] = 'sign up as a user to help volunteers fund small achiveable goals';
		$data['keywords'] = 'signup,user,member';
		if ($stage < 1)
		{
			//display initial signup page
			
			$this->load->view('signup_view', $data);
		}
		elseif ($stage==1)
		{
			//
			$this->output->enable_profiler(TRUE); //Debug
			
			$newEmail = $this->input->post('email');
			$query = $this->db->get_where('Profile', array('ProfileType' => 'user','Email' => $newEmail));
			if ($query->num_rows() > 0)
			{
				//User exists in db
				echo 'User exists in db';
			}
			elseif ($this->input->post())
			{
				//insert new record in the  Profile table
				
				$newName = $this->input->post('name');
				$newSurmane = $this->input->post('surname');
				$newAddress = $this->input->post('address');
				$newCity = $this->input->post('city');
				$newCountry = $this->input->post('country');
				
				$newUser = array(
								 'ProfileType' => 'user' ,
								 'Name' => $newName ,
								 'Surname' => $newSurmane ,
								 'Email' => $newEmail ,
								 'Address' => $newAddress ,
								 'City' => $newCity ,
								 'Country' => $newCountry
								 );
				
				$this->db->insert('Profile', $newUser); 
				
				$newProfileId = $this->db->insert_id();
				//pass this id to the next stage where the user creates a password
				$this->set_flashdata('profileID', $newProfileId);
				
				//now choose a password
				$this->load->view('signup_view_pt2', $data);
				
			}
			
		}
		elseif ($stage==2)
		{
			//Insert a new record in the User table
			
			$newPasswordHash = do_hash($this->input->post('pass'));
			$newProfileId = $this->flashdata('profileID');
			
			$this->db->insert('User', array(
											'ProfileID' => $newProfileId, 
											'Password' => $newPasswordHash
											)
							  );
			
		}
		elseif ($stage==3)
		{
			
		}
		else
		{
			echo 'Well that didn\'t work!';
		}
	}
		
	
	public function donate ($id, $scope='goal')
	{
		
		//test for existing user
		//test for login
		//display donation form
		echo '<h1>Donation page place holder</h1>';
		
	}
	
   /**
    * Retrieve a users public profile from the database
	*
	* @param string $id the UserID or email address of the user to fetch
	*
	* @returns Query result Object
	*
	*/
	function organisation($userId)
	{
		//Allow user to edit his employer organisation
		echo '<h1>User-Organisation page place holder</h1>';
	}
	
   /**
    * Retrieve a users public profile from the database
	*
	* @param string $id the UserID or email address of the user to fetch
	*
	* @returns Query result Object
	*
	*/
	function _userPupblicProfile($id)
	{
		$this->db->select('Name, Surname, City, Country, Avatar');
		$this->db->from('User');
		$this->db->join('Profile', 'Profile.ProfileID = User.ProfileID');
		if (is_int($id))
		{
			$this->db->where('UserID', $id); 
		}
		else {
			//where email = $id
		}
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		return($query->row());
	}
	
   /**
    * Retrieve all the Goals a user has donated to from the database
	*
	* @param int $id the UserID 
	* @param int $page the page number (optional) 
	*
	* @returns Query result array
	*
	*/
	function _userGoalsSupported($id, $page=0)
	{
		/* SELECT DISTINCT Profile.Name, Goal.ProjectID FROM Donation JOIN 
			(Goal JOIN Profile ON Goal.ProfileID = Profile.ProfileID) 
			ON Donation.GoalID=Goal.GoalID 
			WHERE Donation.DonorID = $id */
		
		$this->db->select('DISTINCT Profile.Name, Goal.GoalID', FALSE);
		$this->db->from('Donation');
		$this->db->join('Goal', 'Donation.GoalID = Goal.GoalID');
		$this->db->join('Profile', 'Goal.ProfileID = Profile.ProfileID');
		$this->db->where('DonorID', $id); 
		$this->db->order_by('Goal.DateCreated');
		
		//$this->db->limit($page*30, 30);
		
		$query = $this->db->get();
		
		return($query->result_array());
	}
			
}
?>