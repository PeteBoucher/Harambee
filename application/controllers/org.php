<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Org extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	
	public function project($projName)
	{
		echo "$projName project page for organisation";
	}
	
	public function goal($goalID)
	{
		
		$this->db->from('Profile');
		$this->db->join('Goal', 'Profile.ProfileID = Goal.ProfileID');
		$this->db->where('GoalID', $goalID))
		$query = $this->db->select('GoalID, Name');
		
		foreach ($query->result() as $row)
		{
			echo $row->GoalID;
			echo $row->Name;
		}
	}
	
	public function user()
	{
		$query = $this->db->get('User, Profile');
		foreach ($query->result() as $row)
		{
			echo $row->UserID;
			echo $row->Name;
		}
	}
}

/* End of file org.php */
/* Location: ./application/controllers/org.php */

?>
