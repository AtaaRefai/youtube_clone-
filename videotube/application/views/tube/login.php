<html>
<head>
<link href="/public/css/style2.css" rel="stylesheet" type="text/css"  media="all" />
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="login-form" action="http://localhost/videotube/index.php/User/index" method="post">
      <input type="text" name='action' value='login' hidden/>
      <input type="text" name='email' placeholder="email" required/>
      <input type="password" name='password' placeholder="password" required/>
      <button type='submit'>login</button><br><span style="color:red;"><?php echo isset($error_msg)?$error_msg:''; ?></span>
      <p class="message">Not registered? <a href='http://localhost/videotube/index.php/User/signup'>Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>