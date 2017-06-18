
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login </title>
  
  
  
<link href="/public/css/style2.css" rel="stylesheet" type="text/css"  media="all" />

  
</head>

<body>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="http://localhost/videotube/index.php/User/signup" method="post">
      <input name="action" value="register" hidden>
      <input type="text" name="first" placeholder="first name" required />
      <input type="text" name="last" placeholder="last name" required/>
      <input type="text" name="email" placeholder="email" required/>
      <input type="password" name='password' placeholder="password" required/>
      <button tybe='submit'>sign up</button><br><span style="color:red;"><?php echo isset($error_msg)?$error_msg:''; ?></span>
      <p class="message">Already registered? <a href='http://localhost/videotube/index.php/User/index'>Login</a></p>
    </form>
  </div>
</div>
</body>
</html>

   
      
       
       

     

      
     

