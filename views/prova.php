<nav aria-label="Page navigation example" >
  <ul class="pagination justify-content-center">

    <li class="page-item <?=$page==1?' disabled':''?>">
      <a class="page-link" href="<?=$paginaCorrente.'?page='.($page-1)?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <?php
    for($i=1;$i<=$numPagine;$i++):
      $active=$i==$page?' active':'';
      if($active):
    ?>
    <li class="page-item<?=$active?>"><a class="page-link" ><?=$page?></a></li>
   <?php
   else:?>
   <li class="page-item"><a class="page-link" href="<?=$paginaCorrente.'?page='.$i?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>"><?=$i?></a></li>
   <?php
   endif?>
    <?php endfor?>
    <li class="page-item <?=$page==$numPagine?' disabled':''?>">
      <a class="page-link " href="<?=$paginaCorrente.'?page='.($page+1)?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>