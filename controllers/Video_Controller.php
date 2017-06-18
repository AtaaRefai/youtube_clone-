<?php
/* content: video controller class
   @author: Ata Refai
   This class contains all related functions of Video table*/

class Video_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Video_Model');
		$this->load->helper('url_helper');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

    /* upload video with snapshot :-
    @param none
    @return void*/
    public function upload(){
		if ($this->input->post('action')){//if user submitted upload button
            // image upload
			$target_dir = realpath(dirname(getcwd()));
			$target_file = $target_dir . '\public\images' . "\ " . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
			}
			else{
				echo "Sorry, there was an error uploading your image.";
			}
            $image = basename($_FILES["image"]["name"], "." . $imageFileType); // used to store the filename in a variable
			// video upload
			$target_dir = realpath(dirname(getcwd()));
			$target_file = $target_dir . '\public\images' . "\ " . basename($_FILES["video"]["name"]);
			$uploadOk = 1;
			$videoFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)){
				$video = basename($_FILES["video"]["name"], "." . $videoFileType); // used to store the filename in a variable
				// save in database
				$uid = $this->session->userdata('id');
				$upload_data = array(
					'uid' => $uid,
					'title' => $this->input->post('title') ,
					'video' => $video,
					'img' => $image
				);
				if ($this->Video_Model->upload($upload_data)){
					$data1 = array(
						'view_data' => $this->Video_Model->get_videos(array(
							'id' => $this->session->userdata('id')
						)) ,
						'view_data2' => $this->Video_Model->get_videos2($this->session->userdata('id'))
					);
					$data = $this->session->all_userdata();
					$this->load->view('template/header', $data);
					$this->load->view('User/index', $data1);
				}
			}
			else{
				echo "Sorry, there was an error uploading your video.";
			}
	    }
		// redirect to upload page only.
        elseif ($this->session->userdata('loggedin')){
			$data = $this->session->all_userdata();
			$this->load->view('template/header', $data);
			$this->load->view('Video/upload');
			$this->load->view('template/footer');
		}
    } //upload
 
    /* update views of particular video:-
       @param int $vid detects the id of the video to update its views
       @return int */
	public function add_views($vid){
		$this->Video_Model->add_views($vid);
		$views = $this->Video_Model->get_views($vid);
		echo $views;
	}
 
    /*delete video by publisher
       @param int $vid detects the id of the video to be deleted
       @param int $uid detects the id of the user that is allowed to delete the video(the publisher)
       @return void */ 
	public function delete_video($vid, $uid){
		$user = $this->session->userdata('id');
		if ($user == $uid){
			$this->Video_Model->delete_video($vid, $uid);
		}
	}

} //class