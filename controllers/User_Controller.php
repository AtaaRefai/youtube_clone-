+<?php
/** content: User controller class 
   @author: Ata Refai
   This class contains all related functions of User table **/
class User_Controller extends CI_Controller {
      
    /** redirect to Home or login pages
       @param none
       @return void **/
    public function login_form(){
        if ($this->input->post('action')){// if user is logging in:-
            $userdata = array(
                'email' => $this->input->post('email') ,
                'password' => $this->input->post('password') ,
            );
            $result = $this->User_Model->login($userdata);
            if ($result){
                $data = array(
                    'view_data' => $this->Video_Model->get_videos(array(
                        'id' => $result['uid']
                    )) ,
                    'view_data2' => $this->Video_Model->get_videos2($result['uid']) ,
                    'first' => $result['first'],
                    'last' => $result['first']
                );
                $this->session->set_userdata('loggedin', TRUE);
                $this->session->set_userdata('id', $result['uid']);
                $this->session->set_userdata('first', $result['first']);
                $this->session->set_userdata('last', $result['last']);
                redirect("http://localhost/videotube/index.php/User_Controller/home","refresh");           
            }
            else{
                
                $this->session->set_flashdata('message', 'Wrong email or password, please try again.');
               redirect("http://localhost/videotube/index.php/User_Controller/login","refresh");            
            }
         }
    }

     public function login(){
      // user not logging in , redirect to login page:-
      $this->load->view('User/login');
    }

    /** register new user:-
       @param none
       @return void **/
    public function signup_form(){
        if ($this->input->post('action')){
            $this->form_validation->set_rules('first', 'First', 'required');
            $this->form_validation->set_rules('last', 'Last', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', 'password', 'required');
            $password= password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $userData = array(
                'first' => strip_tags($this->input->post('first')) ,
                'last' => strip_tags($this->input->post('last')) ,
                'email' => strip_tags($this->input->post('email')) ,
                'password' => $password 
            );
            if ($this->form_validation->run() == true){
                $insert = $this->User_Model->add_user($userData);
                if ($insert){
                redirect("http://localhost/videotube/index.php/User_Controller/login","refresh");                }
                else{
                     $this->session->set_flashdata('message','Some problems occured, please try again.');
                     redirect("http://localhost/videotube/index.php/User_Controller/signup","refresh");
                }
            }
            else{
               
                $this->session->set_flashdata('message', 'Cheack email , should be valid!');
                redirect("http://localhost/videotube/index.php/User_Controller/signup","refresh");          
                
            }
        }
    }

    public function signup(){
        // just load the view(redirection), not posting
        $this->load->view('User/signup');
    } 

    /*user logged out,destroy the session :-
       @param none
       @return void */
    public function logout(){
        $this->session->sess_destroy();
       redirect("http://localhost/videotube/index.php/User_Controller/login","refresh");    }



    public  function home(){
        if ($this->session->userdata('loggedin')){
            $data = $this->session->all_userdata();
            $id = $this->session->userdata('id');
            $result = array(
                'view_data' => $this->Video_Model->get_videos($data) ,
                'view_data2' => $this->Video_Model->get_videos2($id)
            );
            $this->load->view('template/header', $data);
            $this->load->view('User/index', $result);

        }

        // user not logged in , redirect to login page:-
     else   redirect("http://localhost/videotube/index.php/User_Controller/login","refresh");    
    }

  
    /*view particular video with its data(redirect to single page) :-
       @param string $vname detects the name of the video to be viewed
       @param int $vid detects the id of the video to be viewed
       @return void */
    public function display($vname, $vid){
        $uid = $this->session->userdata('id');
        $sdata = array(
            'comments' => $this->Comment_Model->get_comments($vid) ,
            'views' => $this->Video_Model->get_views($vid) ,
            'likes' => $this->Like_Model->get_likes($vid) ,
            'dislikes' => $this->Like_Model->get_dislikes($vid) ,
            'status' => $this->Like_Model->get_status($vid, $uid) ,
            'vname' => $vname,
            'vid' => $vid
        );
        $hdata = $this->session->all_userdata();
        $this->load->view('template/header', $hdata);
        $this->load->view('User/single', $sdata);
        $this->load->view('template/footer', $sdata);
    }

} //class

?>