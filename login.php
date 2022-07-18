<?php
session_start();
  require_once 'views/head.php';
  require_once 'functions.php';
  $bytes=random_bytes(32);
  $token=bin2hex($bytes);
  $_SESSION['csrf']=$token;
  if(isLogged()){
    header('Location:index.php');
  };

  $errorLogin=$_SESSION['message']??'';
  unset($_SESSION['message']);




?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img alt="logoAzienda" src="img/LOGOTAURUS.jpeg" width="70" height="70"> TaurusRace</a>
    </div>
</nav>
<section class="container">
<h1 id="login-h1">LOGIN</h1>
<form id="login" action="verificaLogin.php" method="POST">
  <?php 
  if($errorLogin){
    require_once 'views/messaggioErroreLogin.php';
  }
  ?>
  
  <input type="hidden" name="csrf" value="<?=$token?>">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input required type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Inserire una password di minimo 5 caratteri</div>
  </div>
  <div class="mb-3 form-check">
    <input id="remeberme" type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Ricordami</label>
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary ">Login</button>
  </div>
</form>
</section>
<?php
require_once 'views/footer.php'
?>
