    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion filières</h1>
          <h2 class="">Listes des filières</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <?php
            echo $filiereInfo;
          ?>

          <div class="col-md-4">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Ajoute des étudiants</h3>
              </div>
              <div class="porlets-content">
                <p>Importation fichier Excel</p>
                <?php 
                  if(!empty($message))
                  {
                      echo "<div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                            ".$message."</div></div>";
                  }
                ?>
                <form action="afficherFiliere.controller.php?id_filiere=<?php echo empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]; ?>" class="form-horizontal row-border" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="col-lg-12">
                      <input type="hidden" name="id_filiere" value="<?php echo empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]; ?>">
                      <input type="file" id="fileHolder" name="excelFile" style="display:none">
                      <input id="excelFile" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="bottom">
                    <botton class="btn btn-valider" onclick="$('input[id=fileHolder]').click();">Upload</botton>
                    <input id="button" type="submit" name="submit" value="Valider" class="btn btn-valider"></input>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <?php
            $filieremodel->printFiliereModuleBySemstre(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"],1);
            $filieremodel->printFiliereModuleBySemstre(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"],2);
          ?>
        </div>

        <!-- liste des etudiant -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel default blue_title h2">
              <div class="panel-heading">Liste des etudiants de la filiére</div>
              <div class="panel-body">
              <?php
                $filieremodel->printFiliereEtudiant(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]);
              ?>
              </div>
            </section>
          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>