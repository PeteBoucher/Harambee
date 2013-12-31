<?php
class Organisation_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_by_project($projectID)
  {
    $whereClause = array(
      'ProjectId' => $projectID, 
      'ProfileType' => 'org', 
      'Organisation.Status' => 'active'
    );
    $this->db->from('Organisation');
    $this->db->join('Profile', 'Organisation.ProfileId=Profile.ProfileId', 'INNER');
    $this->db->join('Project', 'Organisation.OrgId=Project.OrgId', 'INNER');
    $this->db->limit(0, 1);
    //Change LIMIT if/when we decide to allow joint projects between multiple organisations
    $this->db->where($whereClause);
    
    return $this->db->get();
  }

}