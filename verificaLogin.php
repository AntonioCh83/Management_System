<?php
session_start();
require_once 'functions.php';
if(!empty($_POST)){
    if(!empty($_POST['action'] && $_POST['action']==='logout')){
        $_SESSION=[];
        header('Location:login.php');
        exit;
    }
    $token=$_POST['csrf']??'';
    $email=$_POST['email']??'';
    $password=$_POST['password']??'';

    $ress=verificaLogin($email,$password,$token);
    unset($_SESSION['csrf']);
    if($ress['success']){
        // echo 'BENVENUTO '.strtoupper( $ress['atleta']['username']).' '.$ress['message'];
        session_regenerate_id();
        unset($ress['atleta']['password']);
        $_SESSION['login']=true;
        $_SESSION['datiAtleta']=$ress['atleta'];
        header('Location:index.php');
        exit;
    }else{
        $_SESSION['message']= $ress['message'];
        header('Location: login.php');
    }

}else{
    header('Location: login.php');
}
?>