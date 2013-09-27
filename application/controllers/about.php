<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /about/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$data['title'] = 'About Harambee!';
		$data['keywords'] = 'social,europeaxess,giving,africa,kenya,charity';
		
		$data['nav'] = array();
		
		$this->load->view('about_view', $data);
		
	}