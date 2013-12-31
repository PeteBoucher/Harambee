<?php
class Project_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_featured() {
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