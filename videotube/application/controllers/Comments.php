<?php
class Comments extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->model('Comments_Model');
		$this->load->model('Likes_Model');
		$this->load->model('Videos_Model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

    //add comment to a video by user
	public function add_comment(){
		$vname = $this->input->post('vname');
		$vid = $this->input->post('vid');
		$comment = $this->input->post('comment');
		$uid = $this->session->userdata('id');
		$first = $this->session->userdata('first');
		$last = $this->session->userdata('last');
		$data = array(
			'vid' => $vid,
			'uid' => $uid,
			'first' => $first,
			'last' => $last,
			'comment' => $comment
		);
		$this->Comments_Model->add_comments($data);
		// redirect
        $hdata = $this->session->all_userdata();
		$sdata = array(
			'comments' => $this->Comments_Model->get_comments($vid) ,
			'views' => $this->Videos_Model->get_views($vid) ,
			'likes' => $this->Likes_Model->get_likes($vid) ,
			'dislikes' => $this->Likes_Model->get_dislikes($vid) ,
			'status' => $this->Likes_Model->get_status($vid, $uid) ,
			'vname' => $vname,
			'vid' => $vid
		);
    	$this->load->view('template/header', $hdata);
		$this->load->view('tube/single', $sdata);
		$this->load->view('template/footer', $sdata);
	}

    //delete comment by author
	public function delete_comment($cid, $uid){
		$user = $this->session->userdata('id');
		if ($user == $uid)
			{
			$this->Comments_Model->delete_comment($cid, $uid);
			echo true;
			}
		  else echo false;
	}

} //class