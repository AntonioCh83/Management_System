<nav id="navigation" aria-label="Page navigation example" >
  <ul class="pagination justify-content-center">

    <li class="page-item <?=$page==1?' disabled':''?>">
      <a class="page-link" href="<?=$paginaCorrente.'?page='.($page-1)?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <?php
     
     $extra1=$page+4-$numPagine;
     $extra1=$extra1>0?$extra1:0;
     $start=$page-4-$extra1;

     $start=$start<1?1:$start;
     for($i=$start;$i<$page;$i++):
    ?>
     <li class="page-item">
       <a class="page-link" href="<?=$paginaCorrente.'?page='.$i?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>"><?=$i?>
       </a>
    </li>
    <?php endfor?>
    
    <li class="page-item active">
      <a class="page-link disabled" ><?=$page?>
      </a>
    </li>
    <?php
    $extra2=$page-4;
    $extra2=$extra2<0? abs($extra2):0;
     $start=$page+1;
     $start=$start<1?1:$start;
     $end=($page+4+$extra2);
     $end=min($end,$numPagine);
     for($i=$start;$i<$end;$i++):
    ?>
     <li class="page-item">
       <a class="page-link" href="<?=$paginaCorrente.'?page='.$i?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>"><?=$i?>
       </a>
    </li>
    <?php endfor?>
   
  
   
    
    <li class="page-item <?=$page==$numPagine?' disabled':''?>">
      <a class="page-link " href="<?=$paginaCorrente.'?page='.($page+1)?>&search=<?=$search?$search:''?>&selectLimit=<?=$selectLimit?>&dirQuery=<?=$dirQuery==='asc'?'desc':'asc'?>&orderBy=<?=$order?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>