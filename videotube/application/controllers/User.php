<?php
//user table controller
class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Comments_Model');
        $this->load->model('Likes_Model');
        $this->load->model('Videos_Model');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    //redirect to Home or login pages
    public function index(){
        if ($this->input->post('action')){// if user is logging in:-
            $userdata = array(
                'email' => $this->input->post('email') ,
                'password' => $this->input->post('password') ,
            );
            $result = $this->User_Model->login($userdata);
            if ($result){
                $data = array(
                    'view_data' => $this->Videos_Model->get_videos(array(
                        'id' => $result['uid']
                    )) ,
                    'view_data2' => $this->Videos_Model->get_videos2($result['uid']) ,
                    'first' => $result['first'],
                    'last' => $result['first']
                );
                $this->session->set_userdata('loggedin', TRUE);
                $this->session->set_userdata('id', $result['uid']);
                $this->session->set_userdata('first', $result['first']);
                $this->session->set_userdata('last', $result['last']);
                $this->load->view('template/header', $result);
                $this->load->view('tube/index', $data);

            }
            else{
                $data['error_msg'] = 'Wrong email or password, please try again.';
                $this->load->view('tube/login', $data);
            }
         }
        elseif ($this->session->userdata('loggedin')){// if user is already logged in, redirect to Home page :-
            $data = $this->session->all_userdata();
            $id = $this->session->userdata('id');
            $result = array(
                'view_data' => $this->Videos_Model->get_videos($data) ,
                'view_data2' => $this->Videos_Model->get_videos2($id)
            );
            $this->load->view('template/header', $data);
            $this->load->view('tube/index', $result);

            // $this->load->view('template/footer');
        }

        // user not logged in , redirect to login page:-
        else $this->load->view('tube/login');
    }

    // register new user:-
    public function signup(){
        if ($this->input->post('action')){
            $this->form_validation->set_rules('first', 'First', 'required');
            $this->form_validation->set_rules('last', 'Last', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
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
                    $this->load->view('tube/login');
                }
                else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                    $this->load->view('tube/signup', $data);
                }
            }
            else{
                $data['error_msg'] = 'Cheack email , should be valid!';
                $this->load->view('tube/signup', $data);
            }
        }

        // just load the view(redirection), not posting
         else $this->load->view('tube/signup');
    } 

    //user logged out,destroy the session :-
    public function logout(){
        $this->session->sess_destroy();
        $this->load->view('tube/login');
    }

    //view particular video with its data(redirect to single page) :-
    public function display($vname, $vid){
        $uid = $this->session->userdata('id');
        $sdata = array(
            'comments' => $this->Comments_Model->get_comments($vid) ,
            'views' => $this->Videos_Model->get_views($vid) ,
            'likes' => $this->Likes_Model->get_likes($vid) ,
            'dislikes' => $this->Likes_Model->get_dislikes($vid) ,
            'status' => $this->Likes_Model->get_status($vid, $uid) ,
            'vname' => $vname,
            'vid' => $vid
        );
        $hdata = $this->session->all_userdata();
        $this->load->view('template/header', $hdata);
        $this->load->view('tube/single', $sdata);
        $this->load->view('template/footer', $sdata);
    }

} //class

?>