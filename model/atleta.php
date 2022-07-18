<?php

function delete(int $id){
    /**
     * @var conn mysqli
     */
    $conn=$GLOBALS['mysqli'];
    $query="DELETE FROM users WHERE id=$id";
    $res=$conn->query($query);
   
    /* se ci sono record cancellati affected_rows */
    return $res && $conn->affected_rows;

}

function getAtleta(int $id){
    /**
     * @var conn mysqli
     */
    $conn=$GLOBALS['mysqli'];
    $risultato=[];
    $query="SELECT * FROM users WHERE id=$id ";
    $res=$conn->query($query);
    if($res && $res->num_rows){
        $risultato=$res->fetch_assoc();
    }
    
    return $risultato;

}

function getAtletaByEmail(string $email){
    /**
     * @var conn mysqli
     */
    $conn=$GLOBALS['mysqli'];
    $risultato=[];
    $email=filter_var($email, FILTER_VALIDATE_EMAIL);
    if(!$email){
        return $risultato;
    }
    $email=mysqli_escape_string($GLOBALS['mysqli'],$email);
    
    $query="SELECT * FROM users WHERE email='$email' ";
    
    $res=$conn->query($query);
    if($res && $res->num_rows){
        $risultato=$res->fetch_assoc();
    }
    
    return $risultato;
    

}

function insertAtleta(array $atleta){
    /**
     * @var conn mysqli
     */
    $conn=$GLOBALS['mysqli'];
    $risultato=[
        'success'=>false,
        'messagge'=>'Errore!',
        'id'=>0
    ];
    $username=$conn->escape_string($atleta['username']);
    $email=$conn->escape_string($atleta['email']);
    $fiscalcode=$conn->escape_string($atleta['fiscalcode']);
    $age=(int)($atleta['age']);
    $atleta['password']=$atleta['password']?? 'testpassword';
    $password=password_hash($atleta['password'],PASSWORD_DEFAULT);
    $role=in_array($atleta['role'],getConfig('role'))?$atleta['role']:'user';
    
    $query="INSERT INTO users (username,email,fiscalcode,age,password,role) VALUE ('$username','$email','$fiscalcode',$age,'$password','$role')";
    
    $res=$conn->query($query);
    if($res&&$conn->affected_rows){
        $risultato['id']=$conn->insert_id;
        $risultato['success']=true;
    }else{
        $risultato['messagge']=$conn->error;
    }
    
    return $risultato;

}

function updateAtleta(array $atleta, int $id){
    /**
     * @var conn mysqli
     */
    $conn=$GLOBALS['mysqli'];
    $username=$conn->escape_string(htmlspecialchars( $atleta['username']));
    $email=$conn->escape_string($atleta['email']);
    $fiscalcode=$conn->escape_string($atleta['fiscalcode']);
    $age=$conn->escape_string($atleta['age']);
    $avatar=$conn->escape_string($atleta['avatar']);
    $risultato=0;
    $query="UPDATE users SET username='$username', email='$email', fiscalcode='$fiscalcode', age=$age, avatar='$avatar'";
    if($atleta['password']){
        $atleta['password']=$atleta['password']?? 'testpassword';
        $password=password_hash($atleta['password'],PASSWORD_DEFAULT);
        $query.=", password='$password'";
    }
    if($atleta['role']){
        $role=in_array($atleta['role'],getConfig('role'))?$atleta['role']:'user';
        $query.=", role='$role'";
    }
    $query.="WHERE id=$id";
    $res=$conn->query($query);
    if($res){
        $risultato=$conn->affected_rows;
    }else{
        $risultato=-1;
    }
    
    return $risultato;

}








 

