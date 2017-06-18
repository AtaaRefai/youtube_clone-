<?php
/* content:Like table model
   @author: Ata Refai
   This class contains all related database queries of Like table*/
class Like_Model extends CI_Model{

	
	public function __construct(){
		$this->load->database();
	}

    /* add like by user to a video
    @param int $value detect the type of reaction to be added (like or dislike)
    @param int $vid detects the id of the video to add reaction to
    @param int $uid detects the id of the user who reacted to the video
    @return void */
	public function add_likes($value, $vid, $uid){
		$data = array(
			'type' => $value,
			'vid' => $vid,
			'uid' => $uid
		);
		$this->db->select('*');
		$this->db->from('likes');
		$this->db->where('vid', $vid, 'uid', $uid);
		if ($this->db->get()->num_rows() > 0){ //cheack if already user exist
			if ($value != 0){ //if not 0 then update with new value (like or dislike)
				$this->db->where('vid', $vid, 'uid', $uid);
				$this->db->update('likes', $data);
			}
			elseif ($value == 0){ // user removed his entry(removed the like or dislike)
				$this->db->where('vid', $vid, 'uid', $uid);
				$this->db->delete('likes');
			}
		} //user exist
		else{ //user not exist , insert new record
			$this->db->insert('likes', $data);
		}
	}

    /* count likes of a video
    @param int $vid detects the id of the video to get it's likes number 
    @return int */
	public function get_likes($vid){
		$this->db->where('type', 1, 'vid', $vid);
		return $this->db->count_all_results('likes');
	}

    /*count dislikes of a video
    @param int $vid detects the id of the video to get it's dislikes number 
    @return int */
	public function get_dislikes($vid){
		$this->db->where('type', -1, 'vid', $vid);
		return $this->db->count_all_results('likes');
	}

    /*get the reaction(like/dislike) of a user to a video
    @param int $vid detects the id of the video 
    @param int $uid detects the id of the user who reacted
    @return int */
	public function get_status($vid, $uid){
		$this->db->select('type');
		$this->db->from('likes');
		$this->db->where('vid', $vid, 'uid', $uid);
		$status = $this->db->get()->row_array();
		return $status['type'];
	}
} //class