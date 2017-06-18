<?php
/* content:videos table model
   @author: Ata Refai
   This class contains all related database queries of Video table*/
class Video_Model extends CI_Model

	{
	public function __construct(){
		$this->load->database();
	}

    /*add new video record 
    @param array() $data detect the data of video table record to be inserted
    @return bool */
	public function upload($data = array()){
		$this->db->insert('videos', $data);
		if ($this->db->where('uid', $data['uid'])) return true;
		  else return false;
	}

    /*retrieve all videos for particular user 
    @param array() $data contains the id of userto get his video uploads 
    @return array()*/
	public function get_videos($data = array()){
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('uid', $data['id']);
		return $this->db->get()->result_array();
	}

    /*retrieve  videos for other users
    @param int $uid detects the id of user to not get his video uploads and retrieve others
    @return array()*/
	public function get_videos2($uid){
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('uid !=', $uid);
		return $this->db->get()->result_array();
	}

    /*update number of views
    @param int $vid detects the id of the video to update it's views
    @return void*/
	public function add_views($vid){
		$this->db->where('vid', $vid);
		$this->db->set('views', 'views+1', FALSE);
		$this->db->update('videos');
	}

    /*get number of views for a video
    @param int $vid detects the id of the video to get it's views number
    @return int */
	public function get_views($vid){
		$this->db->select('views');
		$this->db->from('videos');
		$this->db->where('vid', $vid);
		$row = $this->db->get()->row_array();
		return $row['views'];
	}
  
    /*delete a video owned by publisher
    @param int $vid detects the id of the video to be deleted
    @param int $uid detects the id of the User allowed to delete the video (the publisher)
    @return void */
	public function delete_video($vid, $uid){
		$this->db->where('vid', $vid, 'uid', $uid);
		$this->db->delete('videos');
	}

} //class