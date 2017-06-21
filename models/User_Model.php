 <?php
 /** content:user table model
   @author: Ata Refai
   This class contains all related database queries of User table**/
class User_Model extends CI_Model {

 

  public function __construct(){  
    $this->load->database();
  }

    /** register new users 
    @param array() $data detect the data of user table record to be inserted
    @return bool **/
  public function add_user($data = array()){
    
    $insert = $this->db->insert('user', $data);
    if ($insert){ 
      return $this->db->insert_id();
    }
    else{
      return false;
    }
  }

  /** cheack if user exist for login; 
    @param array() $data detect the data of user table record to be cheacked
    @return array() **/
  public function login($data = array()){
    
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('email', $data['email']);
    $query = $this->db->get();
    $row = $query->row_array();
   if(password_verify($data['password'], $row['password'])) {
   return $row;
   }
   else{
      return false;
    }
  } 

} //class