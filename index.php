<?php
session_start();
/* disattiva gli errori in produzione */
// error_reporting(0);
require 'functions.php';
require 'header.php';
if(!isLogged()){
  header('Location:login.php');
};
?>

<!-- Begin page content -->
<main class="flex-shrink-1 text-center">
  <div class="container">
    <h1 class="h1 text-center">TaurusRace Athletes Management</h1>
  </div>

  <?php
      if(!empty($_SESSION['messaggio'])){
        $messaggio=$_SESSION['messaggio'];
        $tipoAlert=$_SESSION['esitoDelete']?'success':'danger';
        require 'views/messaggio.php';
        unset($_SESSION['messaggio'],$_SESSION['esitoDelete']);
      }
      require_once 'controller/showAtleta.php'
  ?>
</main>

<?php
require_once 'views/footer.php';
?>


