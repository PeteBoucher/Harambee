<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Donation_model extends CI_Model {

	var $donationID = '';
	var $donorID = '';
	var $paymentID = '';
	var $goalID = '';
	var $amount = '';
	var $currency = '';
	var $dateCreated = '';
	var $dateDisbursed = ''; // date of payment to project organise

	private $is_saved = FALSE;

	public function __construct()
	{
		$this->load->database();
	}

	public function create($donor, $goal, $amount, $currency)
	{
		$this->donorID = $donor;
		$this->goalID = $goal;
		$this->amount = $amount;
		$this->currency = $currency;

		return $this;
	}

	public function get($id = FALSE)
	{
		if ($id){
			//TODO make the result an instance of this model
			$query = $this->db->get_where('donation',
				array('DonationID' => $id));
		} else {
			//TODO make the result an array os instances of this model
			$query = $this->db->get('donation');
		}

		return $query->result();
	}

	function save()
	{
		if ($this->is_unsaved){
			if ($this->db->insert('Donation', $this)) {
				$this->is_saved = TRUE;
				$this->donationID = $this->db->insert_id();
			} else {
				//TODO sad path
			}
		} else {
			if ($this->db->update('Donation', $this, "id = $this->donationID")) {
				$this->is_saved = TRUE;
			} else {
				//TODO sad path
			}
		}
	}

	public function	get_by_goal(){}

	public function get_by_donor(){}

	/* End of file donation_model.php */
	/* Location: ./application/models/donation_model.php */

}
