<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

		<div class="clear"> </div>
		<div class="content" id='con'>
			<div class="left-content">
				<div class="searchbar">
					<div class="search-left">
						<p>Your uploads on  VideosTube</p>
					</div>
					
					<div class="clear"> </div>
				</div>
				 
				<div class="box">
				    <div class="grids">
				        <?php foreach($view_data as $data) {?> 
                        <div class="grid" id="<?php echo $data['vid']; ?>" >
						<h3><?php echo $data['title']; ?></h3>
						<a href="display"><img src='/public/images/<?php echo " ".$data['img'].".jpg";?>' title="video-name" /></a>
						<div class="time">
							<span>00:10</span>
						</div>
						<div class="grid-info">
							<div class="video-share">
								<ul>
									<li><a class='crossv' id="<?php echo $data['vid']; ?>" name='<?php echo $data['uid']; ?>'><img src="/public/images/cross.png" title="Delete this video" /></a></li>
									
								</ul>
							</div>
							<div class="video-watch">
								<a href="http://localhost/videotube/index.php/User/display/<?php echo " ".$data['video']; ?>/<?php echo $data['vid']; ?>">Watch Now</a>
							</div>
							<div class="clear"> </div>
							<div class="lables">
								<p class='by'>by: <?php echo " ".$first." ".$last; ?></p>
							</div>
						</div>
					</div>
					<?php }?> 

				</div>
				<div class="clear"> </div>
			</div>
				<div class="searchbar">
					<div class="search-left">
						<p>Recommended:</p>
					</div>
					
					<div class="clear"> </div>
				</div>
				 
				<div class="box">
				    <div class="grids">
				        <?php foreach($view_data2 as $data2) {?> 
                        <div class="grid" id="<?php echo $data2['vid']; ?>" >
						<h3><?php echo $data2['title']; ?></h3>
						<a href="display"><img src='/public/images/<?php echo " ".$data2['img'].".jpg";?>' title="video-name" /></a>
						<div class="time">
							<span>00:10</span>
						</div>
						<div class="grid-info">
							<div class="video-share">
								<ul>
									
									
								</ul>
							</div>
							<div class="video-watch">
								<a href="http://localhost/videotube/index.php/User/display/<?php echo " ".$data2['video']; ?>/<?php echo $data2['vid']; ?>">Watch Now</a>
							</div>
							<div class="clear"> </div>
							<div class="lables">
								
							</div>
						</div>
					</div>
					<?php }?> 

				</div>
				<div class="clear"> </div>
			</div>
			<div class="clear"> </div>
			
		</div>
	
		<div class="clear"> </div>
		</div>
		
		
		<div class="copy-right">
			<p>&#169 2017 All rights Reserved </p>
		</div>
	</div>
	<!----End-wrap---->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/public/js/like-dislike.js"></script>
    <script type="text/javascript">

    $('.crossv').click(function(){

        var vid = $(this).attr('id');
        var uid = $(this).attr('name');
        console.log(vid + uid);
    	$.ajax({
                url:'http://localhost/videotube/index.php/Videos/delete_video/'+vid+'/'+uid ,
                type: 'post',
                success:function(data){
                	$( "#"+vid ).remove();
                }});

    });



</script>	