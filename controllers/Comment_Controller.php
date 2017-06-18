<?php
/* content: comment controller class
   @author: Ata Refai
   This class contains all related functions of comment table*/

class Comment_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_Model');
		$this->load->model('Comment_Model');
		$this->load->model('Like_Model');
		$this->load->model('Video_Model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

    /* add comment to a video by user
    @param none
    @return void*/
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
		$this->Comment_Model->add_comments($data);
		// redirect
        $hdata = $this->session->all_userdata();
		$sdata = array(
			'comments' => $this->Comment_Model->get_comments($vid) ,
			'views' => $this->Video_Model->get_views($vid) ,
			'likes' => $this->Like_Model->get_likes($vid) ,
			'dislikes' => $this->Like_Model->get_dislikes($vid) ,
			'status' => $this->Like_Model->get_status($vid, $uid) ,
			'vname' => $vname,
			'vid' => $vid
		);
    	$this->load->view('template/header', $hdata);
		$this->load->view('User/single', $sdata);
		$this->load->view('template/footer', $sdata);
	}

    /*delete comment by author
    @param int $cid detects which comment to be deleted,
    @param int $uid detects comment deleted by which user
    @return void*/
	public function delete_comment($cid, $uid){
		$user = $this->session->userdata('id');
		if ($user == $uid)
			{
			$this->Comment_Model->delete_comment($cid, $uid);
			echo true;
			}
		  else echo false;
	}

} //class