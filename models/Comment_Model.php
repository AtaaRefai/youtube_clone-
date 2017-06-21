 <?php
 /** content:Comment table model
   @author: Ata Refai
   This class contains all related database queries of comment table**/
class Comment_Model extends CI_Model{

	
	public function __construct(){
		$this->load->database();
	}

    /** add new comment
    @param array() $data contains the data of the comment record to be inserted
    @return bool **/
	public function add_comments($data = array()){
		if ($this->db->insert('comments', $data)) return true;
		else return false;
	}
 
    /**get comments of a particular video
    @param int $data detects the id of the video to retrieve it's comments
    @return array() **/
	public function get_comments($data){
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('vid', $data);
		return $this->db->get()->result_array();
	}

    /**delete comment owned by author
    @param int $cid detects the id of the comment to be deleted
    @param int $uid detects the id of the user allowed to delete the comment
    @return void **/
	public function delete_comment($cid, $uid){
		$this->db->where('cid', $cid, 'uid', $uid);
		$this->db->delete('comments');
	}
} //class