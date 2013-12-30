<?php
class Project_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_featured() {
    $this->db->select('Project.id, OrgId, Category, Name, City, Country, Avatar');
    $this->db->from('Project');
    $this->db->join('Profile', 
      'Project.ProfileId = Profile.id', 'inner');
    //$this->db->where('FeaturedProject', 1); 
    $this->db->where('ProfileType', 'proj');
    $this->db->limit(3);

    return $this->db->get();
  }
}