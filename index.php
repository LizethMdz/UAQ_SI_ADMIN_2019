<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('f_home.php', false);}
?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="Login">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" href="images/FUNVEGANO - ICON.ico">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body>

<?php echo display_msg($msg); ?>

<div class='brand'>
  <a href='https://www.jamiecoulter.co.uk' target='_blank'>
    <img src='images/FUNVEGANO - ICON.png'>
  </a>
</div>

<div class='login'>
  <div class='login_title'>
    <span>Iniciar Sesión</span>
    <img src='images/FUNVEGANO - ICON.png' class="img-logo" width="50" height="50">
  </div>
  <form action="p_auth.php" method="post">
      <div class='login_fields'>
      <div class='login_fields__user'>
        <div class='icon'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/user_icon_copy.png'>
        </div>
        <input name="username" placeholder='Username' type='text' >

        </input>
      </div>
      <div class='login_fields__password'>
        <div class='icon'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/lock_icon_copy.png'>
        </div>
        <input name="password" placeholder='Password' type='password'>

      </div>
      <div class='login_fields__submit'>
        <input type='submit' value='Log In'>
        
      </div>
    </div>

    <div class='disclaimer'>
      <p>VENTA DE VEGETALES</p>
    </div>
  </form>

</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>