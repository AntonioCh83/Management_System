<?php 
session_start();
require_once '../functions.php';
require '../model/atleta.php';
$action=getParam('action','');

 /* recupero i parametri della query dalla pagina index */
 $parametri=$_GET;
 /* tolgo il parametro action */
 unset($parametri['action']);
 unset($parametri['id']);
 /* ricostruisco la query */
 $queryPerIndex=http_build_query($parametri);
    
    
    switch($action){
        case 'insert':
            // var_dump($_SESSION['datiAtleta']['role']);var_dump(isAdmin());var_dump(isEditor());var_dump(!isAdmin());var_dump(!isEditor());die;
            if(!isAdmin() && !isEditor()){
                break;
            } 
            $updateAtleta=$_POST;
            $res=insertAtleta($updateAtleta);
            
            if($res['id']>0){
                $result=saveAvatar($res['id']);
                if($result['success']){
                updateAvatar($res['id'],$result['filename']);
                }
                $messaggio='Inserimento Atleta: '.$res['id'].' avvenuta con successo!';
            }else{
                $messaggio='Errore nell\'inserimento:'.$res['messagge'];
            }

            $_SESSION['messaggio']=$messaggio;
            $_SESSION['esitoDelete']=$res;
            /* indirizza alla index */
            header('Location:../index.php?'.$queryPerIndex);
            break;
            
        case 'update':
            
            if(!isAdmin() && !isEditor()){
                break;
            } 
            $id=getParam('id',0);
            $updateAtleta=$_POST;
            $user=getAtleta($id);
            $resultAvatar=saveAvatar($id);
            if($resultAvatar['success']){
                removeAvatar($id);
                $updateAtleta['avatar']=$resultAvatar['filename'];
            }else{
                $updateAtleta['avatar']=$resultAvatar['filename'];
                
            }
            // var_dump($updateAtleta);die;
            $res=updateAtleta($updateAtleta,$id);
            $messaggio=$res?'Modifica id: '.$id.' avvenuta con successo!':'Errore nella modifica!';
            if(!$resultAvatar['success']){
                $messaggio.=$resultAvatar['messagge'];
            }
            $_SESSION['messaggio']=$messaggio;
            $_SESSION['esitoDelete']=$res;
            /* indirizza alla index */
            header('Location:../index.php?'.$queryPerIndex);
            break;

        case 'delete':
            if(!isAdmin()){
                break;
            } 
            $id=getParam('id',0);
            $user=getAtleta($id);
            $res=delete($id);
            if($res){
                removeAvatar($id,$user);
            }
            $messaggio=$res?'Cancellazione '.$id.' avvenuta con successo!':'Errore nella cancellazione!';
            $_SESSION['messaggio']=$messaggio;
            $_SESSION['esitoDelete']=$res;
            /* indirizza alla index */
            header('Location:../index.php?'.$queryPerIndex);
        break; 
    }
    
?>