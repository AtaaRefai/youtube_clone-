	<div class="content">
			<div class="section group" id='group'>				
						
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Upload New Video :</h3>
                        <form enctype="multipart/form-data" action="http://localhost/videotube/index.php/Videos/upload" method="POST">
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