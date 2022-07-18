<?php
require './datiDB.php';
$mega=1024*1024;
$giga=$mega*1024;
$maxUpload=ini_get('upload_max_filesize');
$maxUpload=stristr($maxUpload,'G')? intval($maxUpload)*$giga: intval($maxUpload)*$mega;
return [
    'mysql_host'=>$datiDB['host'],
    'mysql_username'=> $datiDB['username'],
    'mysql_password'=>$datiDB['password'],
    'mysql_db'=>$datiDB['db'],
    'limite'=>10,
    'limiteOption'=>[5,10,20,100,200],
    'max_file_upload'=>$maxUpload,
    'dirAvatar'=>$_SERVER['DOCUMENT_ROOT'].'/project-php/avatar/',
    'dirAvatarForm'=>'/project-php/avatar/',
    'thumbnail'=>100,
    'preview'=>500,
    'column'=>[
        'id',
        'username',
        'email',
        'fiscalcode',
        'age',
        'role'
    ],
    'role'=>['admin','editor','user']

];
