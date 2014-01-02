<?php
class Goal_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  get($goalID) {
    $this->db->from('Profile');
    $this->db->join('Goal', 'Profile.ProfileID = Goal.ProfileID');
    $this->db->where('GoalID', $goalID))

    $query = $this->db->select('GoalID, Name');
  }

}