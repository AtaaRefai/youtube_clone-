 <?php
 //Comments table model
class Comments_Model extends CI_Model{

	
	public function __construct(){
		$this->load->database();
	}

    //add new comment
	public function add_comments($data = array()){
		if ($this->db->insert('comments', $data)) return true;
		else return false;
	}
 
    //get comments of a particular video
	public function get_comments($data){
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('vid', $data);
		return $this->db->get()->result_array();
	}

    //delete comment owned by author
	public function delete_comment($cid, $uid){
		$this->db->where('cid', $cid, 'uid', $uid);
		$this->db->delete('comments');
	}
} //class