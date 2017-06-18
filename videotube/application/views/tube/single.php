<div id='msg'>
    <strong>Error!</strong> Can not delete other users comments!</div>
<div class="content">
	<div class="section group" >				
		<div class="col span_2_of_3">
		    <video  id='<?php echo $vid ;?>' class='video' controls>
                 <source src='/public/images/<?php echo $vname.".mp4";?>' type="video/ogg">
            </video>
        <div id="rating">
           <button class="like"><img src='/public/images/like.jpg' title="video-name" /> <span class="likes"><?php
            echo isset($likes)?$likes:0; ?></span></button>
          
           <button class="dislike"><img src='/public/images/dlike.jpg' title="video-name" /><span class="dislikes"><?php
            echo isset($dislikes)?$dislikes:0; ?></span></button>
            <a class='views'><img src='/public/images/views1.png' title="video-name" /><span id='views'> <?php echo $views; ?> views</span></a>
            <div class='clear-fix'></div>
           
        </div>
		</div>
	
	</div>
	<div class="container">
            <div class="row">
                <div class="col-md-8">
                  <div class="page-header">
                    <h1 style="font-size: 25px;"> Comments : </h1>
                  </div> 
                   <div class="comments-list">
                   <?php foreach($comments as $comment) {?> 

                       <div class="media" id='<?php echo $comment['cid'] ?>'>
                           
                            <div class="media-body">
                                
                    <h4 class="media-heading user_name" style="margin-top: 10px;"><?php echo $comment['first']." ".$comment['last'] ; ?>
    <a class='cross' id='<?php echo $comment['cid'] ?>' name='<?php echo $comment['uid'] ?>'><img src='/public/images/cross.png'/></a>
                    </h4>
                             <?php echo $comment['comment'] ;?>
                    <hr>
                              
                            </div>
                        </div>
                        <?php } ?>    
                   </div>
                   <form  action="http:\\localhost\videotube\index.php\Comments\add_comment" method="post">
                   <input type='text' name='comment' id='comment' placeholder="add a comment">
                   <input type='text' name='vid'  value='<?php echo $vid; ?>' hidden>
                   <input type='text' name='vname'  value='<?php echo $vname; ?>' hidden>
                   <input  type='submit' name='add' id='addc' value='add'>
                   </form>
                </div>
            </div>
</div>
</div>
