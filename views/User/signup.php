
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>SIGNUP </title>
  <link href="/public/css/style.css" rel="stylesheet" type="text/css"  media="all" />
  <link href="/public/css/style2.css" rel="stylesheet" type="text/css"  media="all" />
  </head>
   <body>
<?php if($this->session->flashdata('message')){ ?> 
      <div id='flash'>
      <strong>Error!</strong> <?php echo $this->session->flashdata('message') ; ?>
      <img id="close" src='/public/images/cross.png'>
      </div>
      <?php }?>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="http://localhost/videotube/index.php/User_Controller/signup_form" method="post">
      <input name="action" value="register" hidden>
      <input type="text" name="first" placeholder="first name" required />
      <input type="text" name="last" placeholder="last name" required/>
      <input type="text" name="email" placeholder="email" required/>
      <input type="password" name='password' placeholder="password" required/>
      <button tybe='submit'>sign up</button><br>
      <p class="message">Already registered? <a href='http://localhost/videotube/index.php/User_Controller/login'>Login</a></p>
    </form>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#flash').click(function(){
     $('#flash').hide();
  });

});
</script>
</html>
</html>

   
      
       
       

     

      
     

