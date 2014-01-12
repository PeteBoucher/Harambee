<?php
class Organisation_model extends CI_Model {

  var $orgID ='';
  var $profileID = '';
  var $orgType = '';
  var $status = '';

  public function __construct()
  {
    $this->load->database();
  }

  public function all($limit = 30)
  {
    $this->db->select('OrgID, Name, Surname, City, Country, Avatar');
    $this->db->from('Organisation');
    $this->db->join('Profile', 'Organisation.ProfileID = Profile.ProfileID');
    $this->db->where('Status', 'active');
    $this->db->limit(0, $limit); //TODO add paging function
    return $this->db->get();
  }

  public function get($orgID)
  {
    $this->db->select('Organisation.OrgID, Name, Surname, Email, Address, City, Country, Description, Avatar');
    $this->db->from('Organisation');
    $this->db->join('Profile', 'Organisation.ProfileId = Profile.ProfileID');
    $this->db->where(array('Status' => 'active', 'Organisation.OrgID' => $orgID));
    return $this->db->get();
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
