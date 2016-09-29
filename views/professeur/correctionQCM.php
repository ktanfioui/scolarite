    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion Examen</h1>
          <h2 class="">Création de la correction de la partie QCM</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">

          <div class="col-md-8">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Création de la correction <small> Partie QCM</small></h3>
              </div>
              <div class="porlets-content">
                <form action="saveQCMCorrection.controller.php" class="form-horizontal row-border" id="saveFormQCM"  method="POST">
                  <input type="hidden" name="id_examen" value="<?php echo $_GET["id_examen"]; ?>">
                  <input type="hidden" name="nbrQuestion" id="nbrQuestion" value="<?php echo getNbrQuestionQCM($_GET["id_examen"],$file); ?>">
                  
                  <?php echo showQCMExamenForCorrection($_GET["id_examen"],$file); ?>

                  <div class="form-group"></div>
                  <div class="form-group">
                      <div class="col-sm-12">
                        <button type="submit" name="submit" id="btn-final" class="btn btn-valider full">Enregistrer La correction</button>
                      </div>
                  </div>

              </form>
              </div>
            </div> 
          </div>

          <div class="col-lg-4">
            <div id="erreurMessage"></div>
          </div>

        </div>

      </div>
      <!-- Page Content END -->
    </div>