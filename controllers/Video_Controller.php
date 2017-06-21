<?php
/**content: video controller class
   @author: Ata Refai
   This class contains all related functions of Video table**/

class Video_Controller extends CI_Controller{
	
    /** upload video with snapshot :-
    @param none
    @return void **/
    public function upload_video(){
		if ($this->input->post('action')){//if user submitted upload button
            // image upload
            $date = new DateTime();
            $d=$date->getTimestamp();
            $uid = $this->session->userdata('id');
            $AllowedExs = array("jpg", "jpeg", "gif", "png");
			$target_dir = realpath(dirname(getcwd()));
			$target_file =  str_replace(' ','',$target_dir.'\public\images\ '.$uid.$d.basename($_FILES["image"]["name"]));
			$uploadOk = 1;
			$extension = pathinfo($target_file, PATHINFO_EXTENSION);
			if  (($_FILES["image"]["type"] == "image/gif")
             || ($_FILES["image"]["type"] == "image/jpeg")
             || ($_FILES["image"]["type"] == "image/png")&& in_array($extension, $AllowedExs)){
			if (move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)){
			}
			else{
				echo "Sorry, there was an error uploading your image.";
			}
            $image = str_replace(' ','',$uid.$d.$_FILES["image"]["name"]);
			// video upload
			$date = new DateTime();
			$d=$date->getTimestamp();
            $AllowedExt = array("mov", "mp4", "3gp", "ogg");
			$target_dir = realpath(dirname(getcwd()));	
			$target_file =  str_replace(' ','',$target_dir.'\public\images\ '.$uid.$d.basename($_FILES["video"]["name"]));
			$uploadOk = 1;
			$extension = pathinfo($target_file, PATHINFO_EXTENSION);
			if (($_FILES["video"]["type"] == "video/mov")|| ($_FILES["video"]["type"] == "video/mp4")|| ($_FILES["video"]["type"] == "video/3gp")|| ($_FILES["video"]["type"] == "video/ogg")&& in_array($extension, $allowedExts)){
			if (move_uploaded_file($_FILES["video"]["tmp_name"],$target_file)){
				$video = str_replace(' ','',$uid.$d.$_FILES["video"]["name"]); // used to store the filename in a variable
				// save in database
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
					$this->session->set_flashdata('message', ' your video was uploaded successfully');
                    redirect("http://localhost/videotube/index.php/User_Controller/home","refresh");

				}
			}
		}
			else{
				$this->session->set_flashdata('message', '  Cant Upload video,check file type');
                redirect("http://localhost/videotube/index.php/Video_Controller/upload","refresh");
			}
	    }
	    else{
				$this->session->set_flashdata('message', '  Cant Upload Image,check file type');
                redirect("http://localhost/videotube/index.php/Video_Controller/upload","refresh");
			}
	}
}

	public function upload(){
		// redirect to upload page only.
        if ($this->session->userdata('loggedin')){
			$data = $this->session->all_userdata();
			$this->load->view('template/header', $data);
			$this->load->view('Video/upload');
			$this->load->view('template/footer');
		}
    }

 
    /** update views of particular video:-
       @param int $vid detects the id of the video to update its views
       @return int **/
	public function add_views($vid){
		$this->Video_Model->add_views($vid);
		$views = $this->Video_Model->get_views($vid);
		return $views;
	}
 
    /**delete video by publisher
       @param none
       @return void **/ 
	public function delete_video(){
		$user = $this->session->userdata('id');
		$vid=$this->input->post('vid');
		$this->Video_Model->delete_video($vid, $user);
		$this->session->set_flashdata('message', ' Your Video Was Deleted ');
        redirect("http://localhost/videotube/index.php/User_Controller/home","refresh");


	
	}

} //class