<?php
class Likes extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Likes_Model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	

	public function add_likes($value, $vid){
		$uid = $this->session->userdata('id');
		$this->Likes_Model->add_likes($value, $vid, $uid);
	}

} //class