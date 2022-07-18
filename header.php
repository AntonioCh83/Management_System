
<?php

$selected=isset($_GET['selectLimit'])?$_GET['selectLimit']:10;
require_once 'views/head.php';

$_SESSION['selezionato']=$selected;
require 'connection.php';

$paginaCorrente=$_SERVER['PHP_SELF'];
$deleteAtleta='controller/updateAtleta.php';
$formUpdate='formUpdate.php';
$dirQuery=getParam('dirQuery','asc');
$order=getParam('orderBy','id');
$columns=getConfig('column',['id',
'username',
'email',
'fiscalcode',
'age']);
$selectLimit=getParam('selectLimit',getConfig('limite'));
$limitOption=getConfig('limiteOption',[5,10,20,100,200]);
$search=getParam('search','');
$page=getParam('page',1);

?>
<header>
    <?php
require_once 'views/navbar1.php';
    ?>
</header>