 <?php
 //user table model
class User_Model extends CI_Model {

 

  public function __construct(){  
    $this->load->database();
  }

  // register new users
  public function add_user($data = array()){
    
    $insert = $this->db->insert('user', $data);
    if ($insert){ 
      return $this->db->insert_id();
    }
    else{
      return false;
    }
  }

  //cheack if user exist for login;
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