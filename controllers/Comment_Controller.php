<?php
/**content: comment controller class
   @author: Ata Refai
   This class contains all related functions of comment table**/

class Comment_Controller extends CI_Controller{

    /**add comment to a video by user
    @param none
    @return void**/
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
			'vid' => $vid,
			
		);
        $this->session->set_flashdata('message', 'Comment was added successfully');
    	redirect("http://localhost/videotube/index.php/User_controller/display/".$sdata['vname']."/".$sdata['vid'],"refresh");
	}

    /**delete comment by author
    @param none
    @return bool**/
	public function delete_comment(){

        $vid= $this->input->post('vid');
        $vname= $this->input->post('vname');
        $cid=$this->input->post('cid');
		$user = $this->session->userdata('id');
		$this->Comment_Model->delete_comment($cid, $user);
		$this->session->set_flashdata('message', 'Comment was deleted successfully');
    	redirect("http://localhost/videotube/index.php/User_controller/display/".$vname."/".$vid,"refresh");
		
	}

} //class