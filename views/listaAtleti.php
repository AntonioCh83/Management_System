<?php
    $dirPrevQuery=$dirQuery;
    $dirQuery=$dirQuery==='asc'?'desc':'asc';
?>
<table class=" table table-striped table-bordered">
    
    <thead>
        <tr>
            <th colspan="8" class="text-center" >
                <?php
                     require_once 'navbar2.php';
                ?>
            </th>
            
        </tr>
        <tr>
            <th id=totAtleti colspan="8" class="text-center">TOTALI ATLETI <?=$atletiTotali?>- Pagina <?=$page?> di <?=$numPagine?></th>
        </tr>
        <tr>
            <th class="<?=$order==='id'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=id&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">ID</a></th>
            <th class="<?=$order==='username'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=username&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">NOME ATLETA</a></th>
            <th class="text-center">AVATAR</th>
            <th class="<?=$order==='role'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=role&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">RUOLO</a></th>
            <th class="<?=$order==='email'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=email&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">EMAIL</a></th>
            <th class="<?=$order==='fiscalcode'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=fiscalcode&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">CODICE FISCALE</a></th>
            <th class="<?=$order==='age'?$dirPrevQuery:''?>"><a href="<?=$paginaCorrente?>?orderBy=age&dirQuery=<?=$dirQuery?>&selectLimit=<?=$selected?>&search=<?=$search?>&page=<?=$page?>">ETA'</a></th>
            <?php if(isAdmin()||isEditor()): ?>
            <th class="text-center">AZIONI</th>
            <?php endif ?>
        </tr>
    </thead>
        <tbody>
            <?php
            if($lista){
                
            
                foreach($lista as $atleta){
                    $imageProfile=getConfig('dirAvatarForm').'thumb_'.$atleta['avatar'];
                    $thumbnail=$atleta['avatar'] && file_exists(getConfig('dirAvatar').'thumb_'.$atleta['avatar'])?$imageProfile:getConfig('dirAvatarForm').'placeholder.jpeg';
                    $preview=$atleta['avatar'] && file_exists(getConfig('dirAvatar').'preview_'.$atleta['avatar'])?getConfig('dirAvatarForm').'preview_'.$atleta['avatar']:'';
                    $img=$atleta['avatar'] && file_exists(getConfig('dirAvatar').$atleta['avatar'])?getConfig('dirAvatarForm').$atleta['avatar']:'';
           
            ?>
            <tr>
                <td><?= $atleta['id']?></td>
                <td><?= $atleta['username']?></td>
                <td>
                    <?php 
                    if($img):?>
                    <a class="thumbnail" href="<?=$img?>" target="_blank" >
                        <img src="<?=$thumbnail?>" alt="">
                        <?php
                        if($preview):?>
                        <span ><img  src="<?=$preview?>" alt=""></span>
                        <?php endif?>
                    </a>
                    <?php else: ?>
                        <img class="thumbnail" src="<?=$thumbnail?>" alt="">
                    <?php endif?>

                </td>
                <td><?= $atleta['role']?></td>
                <td><a href="mailto:<?=$atleta['email']?>"><?= $atleta['email']?></a></td>
                <td><?= $atleta['fiscalcode']?></td>
                <td><?= $atleta['age']?></td>
                <?php if(isAdmin()||isEditor()): ?>
                <td>
                <div class="row ">
                    <?php if(isAdmin()):?>
                    <div class="col-md-6">
                        <a onclick="return confirm('Cancellare?')" class="btn btn-danger"
                         href="<?=$deleteAtleta?>?id=<?=$atleta['id']?>&action=delete&<?=$queryUpdate?>">
                        <i class="fa-solid fa-xmark"></i>cancella</a>
                    </div>
                    <?php endif ?>
                    <?php if(isAdmin()):?>
                    <div class="col-md-6">
                        <a class="btn btn-success" 
                        href="<?=$formUpdate?>?action=update&id=<?=$atleta['id']?>&<?=$queryUpdate?>">
                        <i class="fa-solid fa-pen"></i>modifica</a>
                    </div>
                    <?php endif?>
                    <?php
                    if(isEditor()):
                    ?>
                    <div class="col-md-12">
                        <a class="btn btn-success" 
                        href="<?=$formUpdate?>?action=update&id=<?=$atleta['id']?>&<?=$queryUpdate?>">
                        <i class="fa-solid fa-pen"></i>modifica</a>
                    </div>
                    <?php endif ?>
                </div>
            </td>
            </tr>
            <?php endif ?>
            <?php }
            ?>
        </tbody>
            <tfoot class="navigation">
                <tr>
                <td colspan="8">
            <?php
            require_once 'navigation.php';
            ?>
            </td></tr></tfoot>
            <?php
             }else{
                 echo '<tr><td colspan=8 style="text-align:center;"><h3>Non ci sono Atleti registrati</h3></td></tr>';
             }
            ?>
        
   
</table> 