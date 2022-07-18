<?php
session_start();
    require 'functions.php';
    require_once 'header.php';
    require_once 'model/atleta.php';
    if(!isLogged()){
        header('Location:login.php');
        exit;
    }
    if(!isAdmin() && !isEditor()){
        header('Location:index.php');
        exit;
    }
    
    $parametri=$_GET;
    $parametriQuery=http_build_query($parametri);
    $id=getParam('id',0);
    $action=getParam('action','');
    if($id){
        $atletaUpdate=getAtleta($id);
    }else{
        $atletaUpdate=[
            'id'=>'',
            'username'=>'',
            'email'=>'',
            'fiscalcode'=>'',
            'age'=>'',
            'avatar'=>'',
            'password'=>'',
            'role'=>'user'
        ];
    }

?>
<main class="flex-shrink-1 text-center">
  <div class="container">
    <h1 class="h1 text-center">TaurusRace Athletes Management</h1>
  </div>
    <form id="form-update" enctype="multipart/form-data" class="p-4 m-3"  action="controller/updateAtleta.php?<?=$parametriQuery?>" method="POST">
        <input type="hidden" name="action" value="<?=$action?>">
        <div class="mb-3 ">
            <input class="form-control text-center "  type="hidden" name="id" id="id" value="<?=$id?>">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Nome Atleta</label>
            <input onchange="disable()" class="form-control text-center  " required type="text" name="username" id="username" value="<?=$atletaUpdate['username']?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input onchange="disable()" class="form-control text-center" required type="email" name="email" id="email" value="<?=$atletaUpdate['email']?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input onchange="disable()" class="form-control text-center" type="password" name="password" id="password" value="">
        </div>
        <div class="mb-3">
            <label for="fiscalcode" class="form-label">C.F.</label>
            <input onchange="disable()" class="form-control text-center" required type="text" name="fiscalcode" id="fiscalcode" value="<?=$atletaUpdate['fiscalcode']?>">
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Età</label>
            <input onchange="disable()" class="form-control text-center" required type="number" min="12" max="120" name="age" id="age" value="<?=$atletaUpdate['age']?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Scegli Ruolo</label>
            <select name="role" id="role" class="form-control text-center">
                <?php 
                
                foreach(getconfig('role',[]) as $value) {
                    $sel=$atletaUpdate['role']=== $value?'selected':'';
                    echo "<option $sel value=$value>$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3 row">
            <?php
            $imageProfile=getConfig('dirAvatarForm').'thumb_'.$atletaUpdate['avatar'];
            $thumbnail=file_exists(getConfig('dirAvatar').'thumb_'.$atletaUpdate['avatar'])?$imageProfile:getConfig('dirAvatarForm').'placeholder.jpeg';
            
            ?>
            <label for="imageProfile" class="form-label col-2">Immagine profilo</label>
            <img  src="<?=$thumbnail?>" alt="Immagine Profilo" id="imageProfile" class="col-2 text-center">
        </div>
        
        <div class="mb-3">
            <label for="avatar" class="form-label">scegli Avatar</label>
            <input type="hidden" name="MAX_FILE_SIZE" value=<?=getConfig('max_file_upload',4000000)?>>
            <input onchange="previewFile(),disable()" class="form-control text-center" type="file" accept="image/jpg" name="avatar" id="immagine" >
        </div>

        <div class="mb-3 row justify-content-center">
           <?php
            if($atletaUpdate['id'] && isAdmin()):
            ?>

            <a href="controller/updateAtleta.php?id=<?=$atletaUpdate['id']?>&action=delete" class="btn btn-danger col-3 m-1" onclick="return confirm('Sicuro di cancellare?')">
            <i class="fa-solid fa-xmark"></i>Elimina</a>
            <?php
            endif
            ?>
            <?php 
            if(isAdmin() || isEditor()):?>
            <button disabled=true id='salva' class=" grey btn  col-3 m-1 ">
            <i class="fa-solid fa-floppy-disk"></i><?=$atletaUpdate['id']?'Aggiorna':'Inserisci'?></button>
            <?php endif?>
        </div>
    </form>
</main>
    <?php
        require_once 'views/footer.php';
    ?>