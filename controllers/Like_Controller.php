<?php
/** content: Like controller class 
   @author: Ata Refai
   This class contains all related functions of Like table**/
class Like_Controller extends CI_Controller{
	
    /** add like to a video by user
    @param int $value detects weather the user liked or disliked the video(1:liked, -1:disliked)
    @param int $vid detects which video eas liked
    @return void**/
	public function add_likes($value, $vid){
		$uid = $this->session->userdata('id');
		$this->Like_Model->add_likes($value, $vid, $uid);
	}

} //class