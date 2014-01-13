<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('Donation_model', 'donation');

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$data['donations'] = $this->donation->get();

		$this->load->view('includes/donation_item', $data);
	}

	// Add a new item
	public function add()
	{
		$donation = $this->donation->create($donor, $goal, $ammout, $currency);
		$donation->save();
	}

	//Update one item
	public function update( $id = NULL )
	{
		$donations = $this->donation->get($id);
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		//TODO can a Donation be deleted?
	}

	/* End of file donation.php */
	/* Location: ./application/controllers/donation.php */

}

