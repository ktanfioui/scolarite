    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>mes Examens</h1>
          <h2 class="">Listes des Réponses</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">

          <div class="col-lg-8">
            <section class="panel default blue_title h2">
              <div class="panel-heading">
                <?php
                  echo $examen->getTitle()." <small> ".$filiere->getIntitule()." (".$module->getIntitule().")</small>";
                ?>
              </div>
              <div class="panel-body">
                <div class="bs-example-type">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      echo $etudiantmodel->printEtudiantsInListe($examen->getId(),$filiere->getId());
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
          
          <div class="col-lg-4">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Notes QCM</h3>
              </div>
              <div class="porlets-content">
                <?php
                  if (file_exists('../../public/examens/'.$_GET["id_examen"]."-corr/correction-qcmfile.xlsx")) {
                ?>
                    <a href="download.php?id_examen=<?php echo $_GET["id_examen"] ?>" class="btn btn-valider">Télécharger</a>
                <?php
                  } else {
                ?>
                    <p>Générer le fichier excel des notes du QCM</p>
                    <a href="correctionQCM.php?id_examen=<?php echo $_GET["id_examen"] ?>&id_filiere=<?php echo $_GET["id_filiere"] ?>" class="btn btn-valider">Générer</a>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>

        </div>
        
        
      </div>
      <!-- Page Content END -->
    </div>