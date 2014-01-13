<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Project_model extends CI_Model {

  var $projectID = '';
  var $orgID = '';
  var $profileID = '';
  var $category = '';
  var $projectLastUpdate = '';
  var $status = '';

  public function __construct()
  {
    $this->load->database();
  }

  public function get_by_org($orgID)
  {
    $this->db->select('Project.ProjectID, City, Country, Avatar');
    $this->db->from('Project');
    $this->db->join('Profile', 'Project.ProfileID = Profile.ProfileID');
    $this->db->join('Organisation', 'Project.OrgID = Organisation.OrgID');
    $this->db->where('Organisation.OrgID', $orgID);

    return $this->db->get();
  }

  public function get_featured()
  {
    $this->db->select('Project.ProjectID AS id, OrgId, Category, Profile.Name, City, Country, Avatar');
    $this->db->from('Project');
    $this->db->join('Profile',
      'Project.ProfileID = Profile.ProfileID', 'inner');
    $this->db->join('Goal',
      'Project.ProjectID = Goal.ProjectID', 'inner');
    // $this->db->where('Featured');
    $this->db->where('ProfileType', 'proj');
    $this->db->limit(3);

    return $this->db->get();
  }

}
