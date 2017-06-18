<div class="copy-right">
			<p>&#169 2017 All rights Reserved </p>
		</div>
	</div>
	<!----End-wrap---->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/public/js/like-dislike.js"></script>
    <script type="text/javascript">
   var status= <?php echo json_encode($status) ; ?>; 
   $('#rating').likeDislike({
        initialValue: 0,
        click: function (value, l, d, event) {
            var likes = $(this.element).find('.likes');
            var dislikes = $(this.element).find('.dislikes');
        if(status==1){
            l=0;
            d=0;
            likes.text(parseInt(likes.text()) + l);
            dislikes.text(parseInt(dislikes.text()) + d);
            status=0;
           
        }
        else if(status==-1){
            l=0;
            d=0;
            likes.text(parseInt(likes.text()) + l);
            dislikes.text(parseInt(dislikes.text()) + d);
            status=0;
               
        }
        else{
            likes.text(parseInt(likes.text()) + l);
            dislikes.text(parseInt(dislikes.text()) + d); 
            console.log('l:'+l+' d:'+d+' status'+status);}
            
             $.ajax({
                url:"http://localhost/videotube/index.php/Likes/add_likes/"+value+"/<?php echo $vid ?>" ,
                type: 'post',
                success:function(data){
                	  // console.log(data);
                }
                
            });
        }
    });


    $('#<?php echo $vid ; ?>').bind('ended', function() {
    	 $.ajax({
                url:"http://localhost/videotube/index.php/Videos/add_views/<?php echo $vid ?>" ,
                type: 'post',
                success:function(data){
                	var views=jQuery.parseJSON(JSON.stringify(data)) ;
                	 $('#views').empty();
                	 $('#views').html(views +' views');
                }
                
            });
         });

    $('.cross').click(function(){

        var cid = $(this).attr('id');
        var uid = $(this).attr('name');

    	$.ajax({
                url:'http://localhost/videotube/index.php/Comments/delete_comment/'+cid+'/'+uid ,
                type: 'post',
                success:function(data){
                	
                	jQuery.parseJSON(JSON.stringify(data));
                	console.log(data);
                	if(data==true)
                	$( "#"+cid ).remove();
                   else {
                   	$("#msg").fadeIn();
                   $("#msg").delay( 1000 ).fadeOut('slow');}

                }});

    });

    $('.crossv').click(function(){

        var vid = $(this).attr('id');
        var uid = $(this).attr('name');

    	$.ajax({
                url:'http://localhost/videotube/index.php/Videos/delete_video/'+vid+'/'+uid ,
                type: 'post',
                success:function(data){
                	 $( "#"+vid ).remove();
                }});

    });



</script>
	</body>
	
</html>

