	<div class="content">
	<?php if($this->session->flashdata('message')){ ?> 
            <div id='error'>
            <strong>Error!</strong> <?php echo $this->session->flashdata('message') ; ?>
            <img id="close" src='/public/images/cross.png'>
            </div>
            <?php }?>
			<div class="section group" id='group'>					
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Upload New Video :</h3>
                <form enctype="multipart/form-data" action="http://localhost/videotube/index.php/Video_Controller/upload_video" method="POST">
					        <div>
						    	<span><label>Title :</label></span>
						    	<span><input type="text" name='title' required></span>
                                <input type="text" name='action' value='upload' id='hidden'/>
						    </div>
					    	<div>
						    	<span><label>choose a video :</label></span>
						    	<span><input type="file" name='video' required></span>
						    </div>
						    <div>
						    	<span><label>upload a snapshot for the video :</label></span>
						    	<span><input type="file" name='image' required></span>
						    </div>
						    
						    
						   <div>
						   		<span><input type="submit" value="UPLOAD"></span>
						  </div>
					    </form>
				    </div>
  				</div>				
			  </div>
		</div>
		<script>
		$(document).ready(function(){
        $('#error').click(function(){
        $('#error').hide();
        });
    });
		</script>