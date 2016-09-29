    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>mes Examens</h1>
          <h2 class="">Réponse</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
            <div class="col-lg-9">
              <div class="block-web">
                <div class="header">
                  <h2 class="content-header colored"><?php echo $etudiant->getNom()." ".$etudiant->getPrenom(); ?></h2>
                </div>
                <?php
                  if ($filesList != null) {
                ?>
                <div class="porlets-content">
                  <ul class="nav nav-tabs" id="myTab">
                    <?php
                      if ($examen->getIsQCM() == 1) {
                          echo "<li class=\"active\"><a data-toggle=\"tab\" href=\"#qcm\">Partie QCM</a></li>";
                      }

                      if ($examen->getIsCoure() == 1) {
                          echo $examen->getIsQCM() == 1 ? "<li>" : "<li class=\"active\">";
                          echo "<a data-toggle=\"tab\" href=\"#cours\">Partie Questions de cours</a></li>";
                      }

                      if ($examen->getIsExercice() == 1) {
                          echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<li>" : "<li class=\"active\">";
                          echo "<a data-toggle=\"tab\" href=\"#exercices\">Partie Exercices</a></li>";
                      }
                    ?>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                  <?php
                      if ($examen->getIsQCM() == 1) {
                        echo "<div id=\"qcm\" class=\"tab-pane fade in active\">";
                        echo showQCMExamenReponse($_GET['id_examen'],$_GET['id_etudiant'],$filesList["qcm"]);
                        echo "</div>";
                      }

                      if ($examen->getIsCoure() == 1) {
                        echo $examen->getIsQCM() == 1 ? "<div id=\"cours\" class=\"tab-pane fade\">" : "<div id=\"cours\" class=\"tab-pane fade in active\">";
                        echo showQCoursExamenReponse($_GET['id_examen'],$_GET['id_etudiant'],$filesList["cours"]);
                        echo "</div>";
                      }

                      if ($examen->getIsExercice() == 1) {
                        echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<div id=\"exercices\" class=\"tab-pane fade\">" : "<div id=\"exercices\" class=\"tab-pane fade  in active\">";
                        echo showExerciceExamenReponse($_GET['id_examen'],$_GET['id_etudiant'],$filesList["exercices"]);
                        echo "</div>";
                      }
                  ?>
                </div>
                <?php
                  } else {
                ?>
                <div class="porlets-content">
                  <div class="bs-example">
                    <div class="alert alert-warning fade in">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                       Aucune réponse valable !!
                     </div>
                  </div>
                </div>
                <?php
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <section class="panel default blue_title h2">
              <div class="panel-body">
                <div class="bs-example-type">
                  <p><strong>Examen  : </strong><?php echo $examen->getTitle(); ?></p>
                  <p><strong>Filière : </strong><?php echo $filiere->getIntitule(); ?></p>
                  <p><strong>Module  : </strong><?php echo $module->getIntitule(); ?></p>
                </div>
              </div>
            </section>
          </div>

        </div>
        
        
      </div>
      <!-- Page Content END -->
    </div>