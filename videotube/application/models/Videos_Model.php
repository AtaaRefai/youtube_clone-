<?php
//videos table model
class Videos_Model extends CI_Model

	{
	public function __construct(){
		$this->load->database();
	}

    //add new video record
	public function upload($data = array()){
		$this->db->insert('videos', $data);
		if ($this->db->where('uid', $data['uid'])) return true;
		  else return false;
	}

    //retrieve all videos for particular user
	public function get_videos($data = array()){
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('uid', $data['id']);
		return $this->db->get()->result_array();
	}

    //retrieve  videos for other users
	public function get_videos2($uid){
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('uid !=', $uid);
		return $this->db->get()->result_array();
	}

    //update number of views 
	public function add_views($vid){
		$this->db->where('vid', $vid);
		$this->db->set('views', 'views+1', FALSE);
		$this->db->update('videos');
	}

    //get number of views for a video
	public function get_views($vid){
		$this->db->select('views');
		$this->db->from('videos');
		$this->db->where('vid', $vid);
		$row = $this->db->get()->row_array();
		return $row['views'];
	}
  
    // delete a video owned by publisher
	public function delete_video($vid, $uid){
		$this->db->where('vid', $vid, 'uid', $uid);
		$this->db->delete('videos');
	}

} //class