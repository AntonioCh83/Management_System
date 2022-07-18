
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img alt="logoAzienda" src="img/LOGOTAURUS.jpeg" width="70" height="70"> TaurusRace</a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item <?=strpos($_SERVER['PHP_SELF'],'index')&& !isset($_GET['action'])? 'active' : '' ?>">
            <a class="nav-link " aria-current="page" href="index.php">Atleti</a>
          </li>
          <li class="nav-item <?=strpos($_SERVER['PHP_SELF'],'formUpdate')&& isset($_GET['action'])? 'active' : '' ?>">
            <a class="nav-link" href="formUpdate.php?action=insert"><i class="fas fa-square-plus"></i>Aggiungi Atleta</a>
          </li>
        </ul>

        <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
        <?php
        if(isLogged()):
          ?>
                <li class=" nav-item "><button class="btn btn-outline-warning" disabled>Utente: <?=getNomeAtleta()?></button></li> &nbsp
                <li class=" nav-item "><button class="btn btn-outline-info" disabled>Ruolo: <?=getRuoloAtleta()?></button></li> &nbsp
                <li class="nav-item">
                <form class="form" method="POST" action="verificaLogin.php">
                <input type="hidden" name="action" value="logout"> 
                <button  id="dropdownMenu1"  class="btn btn-outline-secondary ">Logout <span class="caret"></span></button>
                    
                       
                           
                            
                             
                               
               </form>
                        
                   
                </li>
                <?php else :?>
                  <li class="nav-item">
                    <a href="login.php" class="btn btn-lg btn-success">Login</a>
                  </li>
                <?php endif ?>
            </ul>
        
      </div>
      

    </div>
    
  </nav>
  
