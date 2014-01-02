<?php
class Project_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_by_org($orgID)
  {
    $this->db->select('ProjectID, Name, City, Country, Avatar');
    $this->db->from('Project');
    $this->db->join('Profile', 'Project.ProfileID = Profile.ProfileID');
    $this->db->join('Organisation', 'Project.OrgID = Organisation.OrgID');
    $this->db->where('Organisation.OrgID', $orgID);

    return $this->db->get();
  }

  public function get_featured() 
  {
    $this->db->select('ProjectId AS id, OrgId, Category, Name, City, Country, Avatar');
    $this->db->from('Project');
    $this->db->join('Profile', 
      'Project.ProfileId = Profile.ProfileId', 'inner');
    //$this->db->where('FeaturedProject'); 
    $this->db->where('ProfileType', 'proj');
    $this->db->limit(3);

    return $this->db->get();
  }

}