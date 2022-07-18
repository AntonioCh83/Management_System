<?php

/* ---  IMPORTIAMO LA CONNESSIONE  --- */

require_once 'connection.php';

/* --- INSERISCO UNA FUNZIONE CHE RECUPERA I PAR DI CONFIG */

function getConfig($parametro,$default=null){
    $conf=require 'config.php';
   return array_key_exists($parametro,$conf)?$conf[$parametro]:$default;
    
}

/* ---CREAO UNA FUNZIONE PER IL RECUPERO DI UN PARAMETRO NELLA REQUEST */

function getParam($param, $valDefault=null){

    return !empty($_REQUEST[$param])?$_REQUEST[$param]:$valDefault;

}

function getRandName() {
    $names=[
        'Antonio',
        'Mario',
        'Ippolito',
        'Marco',
    ];

    $lastnames=[
        'Miceli',
        'Rossi',
        'Verdi',
        'Gialli',
        'Neri'
    ];
    $randName=mt_rand(0,count($names)-1);
    $randLast=mt_rand(0,count($lastnames)-1);
    return $names[$randName].' '.$lastnames[$randLast];

}

// echo getRandName();

function getRandEmail($name){
    $domini=[
        'yahoo.it',
        'goolge.com',
        'libero.it',
        'hotmail.com'
    ];
    $chiocciola='@';
    $nametoLower=strtolower($name);
    $username=str_replace(' ','.',$nametoLower);
    $dominio=$domini[mt_rand(0,count($domini)-1)];
    return $username.mt_rand(10,99).$chiocciola.$dominio;
}
// echo getRandEmail(getRandName()).'<br>';

function getRandFiscalCode(){

    $cont=16;
    $fiscalCode='';
    while($cont>0){
        // genera un carattere chr()
        $char=chr(mt_rand(65,90));
        $fiscalCode.=$char;
        $cont--;
    }
    return $fiscalCode;
}

// echo getRandFiscalCode().'<br>';

function getAge(){
    return mt_rand(18,120);
}

// echo getAge();

function insertRandUser($totale, mysqli $connection){
    
    while($totale>0){
        $username=strtolower( getRandName());
        $email=getRandEmail($username);
        $fcode=getRandFiscalCode();
        $age=getAge();
        $query="INSERT INTO users (username,email,fiscalcode,age) VALUES ('$username','$email','$fcode',$age)";
        echo $totale.' '.$query.'<br>';
        $result=$connection->query($query);
        if(!$result){
            echo $connection->error.'<br>';
        }else{
            $totale--;
            echo 'Query riuscita!'.'<br>';
        }
    }

}



//  insertRandUser(50,$mysqli);

function getAtleti(mysqli $conn,array $parDiRicerca=[]){

/* ---verifico la presenza di parametri--- */

        $orderBy=array_key_exists('orderBy',$parDiRicerca) ? $parDiRicerca['orderBy']:'id';
        $dirQuery=array_key_exists('dirQuery',$parDiRicerca) ? $parDiRicerca['dirQuery']:'asc';
        $limit=(int)array_key_exists('selectLimit',$parDiRicerca) ? $parDiRicerca['selectLimit']:10;
        $search=array_key_exists('search',$parDiRicerca) ? $parDiRicerca['search']:'';
        $page=(int)array_key_exists('page',$parDiRicerca) ? $parDiRicerca['page']:1;
        $start=$limit*($page-1);
        /* ---PER EVITARE SQL INJECTION */
        $search=$conn->escape_string($search);
        if($dirQuery!=='asc'&& $dirQuery!=='desc'){$dirQuery='asc';}
        
        // $where=array_key_exists('where',$parDiRicerca)?$parDiRicerca['where']:null;
        $records=[];
        
        $query='SELECT * FROM users ';
        if($search){
            $query.=" WHERE username LIKE '%$search%' ";
            $query.=" OR fiscalcode LIKE '%$search%' ";
            if(strpos($search,'@')){
            $query.=" OR email LIKE '%$search%' ";
            }
            $query.=" OR age LIKE '$search' ";
            $query.=" OR id LIKE '$search' ";
        }
        $query.="ORDER BY $orderBy $dirQuery LIMIT $start, $limit";
        
        $atleti=$conn->query($query);
        if($atleti){
            $cont=1;
           while($result=$atleti->fetch_assoc()){
                $records[$cont]=$result;
                $cont++;
                // var_dump( $result);

           }
        } 
        
        return $records;

};
//  var_dump(getAtleti($mysqli));

function countAtleti(mysqli $conn,array $parDiRicerca=[]){

    /* ---verifico la presenza di parametri--- */
    
            $orderBy=array_key_exists('orderBy',$parDiRicerca) ? $parDiRicerca['orderBy']:'id';
            $dirQuery=array_key_exists('dirQuery',$parDiRicerca) ? $parDiRicerca['dirQuery']:'asc';
            $limit=(int)array_key_exists('selectLimit',$parDiRicerca) ? $parDiRicerca['selectLimit']:10;
            $search=array_key_exists('search',$parDiRicerca) ? $parDiRicerca['search']:'';
            /* ---PER EVITARE SQL INJECTION */
            $search=$conn->escape_string($search);
            if($dirQuery!=='asc'&& $dirQuery!=='desc'){$dirQuery='asc';}
            
            // $where=array_key_exists('where',$parDiRicerca)?$parDiRicerca['where']:null;
            $totali=0;
            
            $query='SELECT COUNT(*) as totali FROM users ';
            if($search){
                $query.=" WHERE username LIKE '%$search%' ";
                $query.=" OR fiscalcode LIKE '%$search%' ";
                if(strpos($search,'@')){
                $query.=" OR email LIKE '%$search%' ";
                }
                $query.=" OR age LIKE '$search' ";
                $query.=" OR id LIKE '$search' ";
            }
            
            
            $atleti=$conn->query($query);
            if($atleti){
                
               $result=$atleti->fetch_assoc();
                $totali=$result['totali'];
                    
                    // var_dump( $result);
    
              
            } 
            
            return $totali;
    
    };

    function saveAvatar($id){
        $result=[
            'success'=>false,
            'messagge'=>'Errore!',
            'filename'=>''
        ];
        if(empty($_FILES['avatar']['name'])){
            $data=getAtleta($id);
            if($data['avatar']===''){
                $result['messagge']='Avatar non caricato!';
            }else{
                $result['filename']=$data['avatar'];
                $result['messagge']='';
            }
            return $result;

        }
        // var_dump($_FILES);die;
        $file=$_FILES['avatar'];
        if(!is_uploaded_file($file['tmp_name'])){
            $result['success']=true;
            $result['messagge']='';
            return $result;
        }
        $info=finfo_open(FILEINFO_MIME);
        $infoFile=finfo_file($info,$file['tmp_name']);
        if(strstr($infoFile,'image/jpeg')===false){
          
            $result['messagge']='L\'estensione del file non è corretta!';
            return $result;

        }

        $maxSize=getConfig('max_file_upload');
        if($file['size']>$maxSize){
            $result['messagge']='Il file supera il massimo di upload di '.$maxSize;
            return $result;
        }
        $filename=$id.'_'.str_replace('.','',microtime(true)).'.jpeg';
        $dirAvatar=getConfig('dirAvatar');
       if( !move_uploaded_file($file['tmp_name'],$dirAvatar.$filename)){
        $result['messagge']='Il file non è stato salvato!';
        return $result;
       }
       $imgCopy= imagecreatefromjpeg($dirAvatar.$filename);
       $thumbNail= imagescale($imgCopy,getConfig('thumbnail',200));
       $preview= imagescale($imgCopy,getConfig('preview',500));
       if(!$imgCopy||!$thumbNail){
        $result['messagge']='La Thumbnail non è stata salvata!';
        return $result;
       }
       imagejpeg($thumbNail,$dirAvatar.'thumb_'.$filename);
       imagejpeg($preview,$dirAvatar.'preview_'.$filename);

       $result['filename']=$filename;
       $result['messagge']='';
       $result['success']=true;
       return$result;

    }

    function removeAvatar(int $id,array $formAtleta=[]){
        $formAtleta=$formAtleta?$formAtleta:getAtleta($id);
        if(!$formAtleta||!$formAtleta['avatar']){
            return;
        }
       if(strpos($formAtleta['avatar'],'placeholder')!==false){
            $avatarFileSystem=getConfig('dirAvatar').$formAtleta['avatar'];
            $thumbnailFileSystem=getConfig('dirAvatar').'thumb_'.$formAtleta['avatar'];
    // var_dump($avatarFileSystem,$thumbnailFileSystem);die;
            if($avatarFileSystem){
                unlink($avatarFileSystem);
            }
            if($avatarFileSystem){
                unlink($thumbnailFileSystem);
            }
        }

    }

    function updateAvatar(int $id,$avatar=null){
        if(!$avatar){
            return false;
        }
        /**
         * @var conn mysqli
         */
        $conn=$GLOBALS['mysqli'];
        $query="UPDATE users SET avatar='$avatar' WHERE id=$id";
        $res=$conn->query($query);
        return $res&&$res->affected_rows;
    }

    function verificaLogin($email,$password,$token){
        require_once 'model/atleta.php';
        $result=[
            'message'=>'Login effettuato con successo!',
            'success'=>true
        ];

        if(!($_SESSION['csrf']===$token)){
            $result['message']='Errore nel login!';
            $result['success']=false;
            return $result;
        }

        $email=filter_var($email,FILTER_VALIDATE_EMAIL);
        if(!$email){
            $result['message']='Errore email!';
            $result['success']=false;
            return $result;
        }
        if(strlen($password)<5){
            $result['message']='Errore nella password!';
            $result['success']=false;
            return $result;
        }
        $emailExist=getAtletaByEmail($email);
        
        if(!$emailExist){
            $result['message']='Atleta non presente!';
            $result['success']=false;
            return $result;
        }
        if(!password_verify($password,$emailExist['password'])){
            $result['message']='Password non valida!';
            $result['success']=false;
            return $result;

        }
        $result['atleta']=$emailExist;
        return $result;

    }
    function isLogged(){
        return $_SESSION['login'] ?? false;
    }
    function getNomeAtleta(){
        return $_SESSION['datiAtleta']['username']?? false;
    }
    function getEmailAtleta(){
        return $_SESSION['datiAtleta']['email']?? false;
    }
    function getRuoloAtleta(){
        return $_SESSION['datiAtleta']['role']?? false;
    }

    function isAdmin(){
        return getRuoloAtleta()==='admin';
    }

    function isEditor(){
        return getRuoloAtleta()==='editor';
    }
    
