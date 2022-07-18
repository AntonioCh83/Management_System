<?php
$config=require 'config.php';
// var_dump($config);

/* --- creo l'oggetto di connessione con l'istanza della classe mysqli */

$mysqli=new mysqli(
    $config['mysql_host'],
    $config['mysql_username'],
    $config['mysql_password'],
    $config['mysql_db']
);

/* ---possiamo cancellare la variabile globale--- */

unset($config);

/* ----verifichiamo la connessione ---*/

if($mysqli->connect_error){
    die($mysqli->connect_error);
// }else{
//     echo 'Connessione avvenuta!'.'<br>';
//     // var_dump($mysqli);
}
