    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion Examen</h1>
          <h2 class="">Contenu de l'examen</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div class="header">
                <h2 class="content-header colored"><?php echo $examen->getTitle(); ?> <small> Correction</small></h2>
              </div>
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
                      echo showQCMExamenCorrection($_GET['id_examen'],$filesList["qcm"]);
                      echo "</div>";
                    }

                    if ($examen->getIsCoure() == 1) {
                      echo $examen->getIsQCM() == 1 ? "<div id=\"cours\" class=\"tab-pane fade\">" : "<div id=\"cours\" class=\"tab-pane fade in active\">";
                      echo showQCoursExamenCorrection($_GET['id_examen'],$filesList["cours"]);
                      echo "</div>";
                    }

                    if ($examen->getIsExercice() == 1) {
                      echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<div id=\"exercices\" class=\"tab-pane fade\">" : "<div id=\"exercices\" class=\"tab-pane fade  in active\">";
                      echo showExerciceExamenCorrection($_GET['id_examen'],$filesList["exercices"]);
                      echo "</div>";
                    }
                ?>
              </div>
            </div>
          </div>
        </div>


        <!-- liste des etudiant -->
        <div class="row">

        </div>

      </div>
      <!-- Page Content END -->
    </div>