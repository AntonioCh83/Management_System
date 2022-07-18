
  <!-- Fixed navbar -->
  <div  class="navbar navbar-expand-md navbar-dark  bg-dark justify-content-center" >
      
        <form class="d-flex align-items-center" method="GET" action="<?=$paginaCorrente?>" id="form1">
        <label  for="dirQuery">Ordine</label>
          <select name="dirQuery" id="dirQuery"
                  onchange="document.forms.form1.submit()">
           
            <option <?=$dirQuery=='asc'?'selected':''?> value='desc'>desc</option>
            <option <?=$dirQuery=='desc'?'selected':''?> value='asc'>asc</option>
             
          </select>
      
        <label  for="orderBy">Colonne</label>
          <select name="orderBy" id="orderBy"
                  onchange="document.forms.form1.submit()">
            <?php
            foreach($columns as $val){?>
            <option <?=$order==$val?'selected':''?> value=<?=$val?>><?= $val?></option>
             <?php } ?>
          </select>
      
          <label  for="selectLimit">Record per pagina</label>
          <select name="selectLimit" id="selectLimit"
                  onchange="document.forms.form1.submit()">
            <?php
            foreach($limitOption as $val){?>
              <option <?=$selectLimit==$val?'selected':''?> value=<?=$val?>><?= $val?></option>
             <?php } ?>
          </select>
          &nbsp;
          <input class="form-control me-2" type="search" name="search" value="<?=$search?>"
           id="search" placeholder="Ricerca" aria-label="Search">
          
           <button class="btn btn-outline-success" type="submit">Cerca</button>
          &nbsp;
          <button class="btn btn-warning" type="button" onclick="document.location.href='<?=$paginaCorrente?>'">Reset</button> 
        </form>
  </div>
