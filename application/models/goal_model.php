<?php
class Goal_model extends CI_Model {

  var $goalID = '';
  var $projectID = '';
  var $name = '';
  var $description = '';
  var $goalAmmount = '';
  var $goalCurrency = '';
  var $dateCreated = '';
  var $dateDeadline = '';
  var $featured = '';
  var $status = '';

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

  new($project, $name, $description, $goalAmmount, $goalCurrency, $dateDeadline) {
    unset $this->$goalID;

    if (is_int($project)) {
      $this->projectID = $project;
    } else {
      $this->projectID = $project->projectID;
    }
    $this->name = '';
    $this->description = $description;
    $this->goalAmmount = $goalAmmount;
    $this->goalCurrency = $goalCurrency;
    $this->dateCreated = date(now());
    $this->dateDeadline = $dateDeadline;
    $this->featured = 0;
    $this->status = 'collecting';

    $this->$goalID = $this->db->insert('Goal', $this);

    if ($this->$goalID) {
      return $this;
    } else {
      log_message('2', 'Unable to INSERT into Goal table');
    }

  }

}
