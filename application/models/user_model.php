<?php
class User_model extends CI_Model {

	var $userID = '';
	var $orgID = '';
	var $profileID = '';
	var $status = '';
	var $lastLogin = '';

	private var $password = '';

  public function __construct()
  {
    $this->load->database();
  }

  function new(){}

  function get($userID){}

  function get_by_org($org){
  	$thid->db->get_where('User',
  		array('OrgID' => $org));
  }

  function update(){}

  }

  function delete(){
  	$this->status = 'deleted';

  	$this->db->update('User', $this);
  }

}
