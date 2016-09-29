<div class="container etd">

  <div class="col-lg-3">
    <div class="left-side">
      <div class="side-title"><h3>Examen</h3></div>
      <div class="side-menu">
        <a href="afficherExamen.controller.php?id_examen=<?php echo $_GET['id_examen']; ?>" class="btn btn-valider full-left"><i class="fa fa-folder"></i>Afficher l'énoncé</a>
        <a href="afficherCorrectionExamen.controller.php?id_examen=<?php echo $_GET['id_examen']; ?>" class="btn btn-valider full-left"><i class="fa fa-file-text"></i>Afficher la correction</a>
        <a href="afficherReponseExamen.controller.php?id_examen=<?php echo $_GET['id_examen']; ?>" class="btn btn-valider full-left"><i class="fa fa-thumb-tack"></i>Afficher ma réponse</a>
        <input type="hidden" id="id_filiere" value="<?php echo $_SESSION['etudiant']["id_filiere"]; ?>">
      </div>
    </div>
  </div>

  <div class="col-lg-9">
    <div class="right-side">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div class="header">
                <h2 class="content-header colored"><?php echo $examen->getTitle(); ?> <small> Correction</small></h2>
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
                      if (isset($filesList["qcm"])) {
                        echo showQCMExamenCorrection($_GET['id_examen'],$filesList["qcm"]);
                      } else {
                        echo warningMessage("Pas de correction pour cet élément");
                      }
                      echo "</div>";
                    }

                    if ($examen->getIsCoure() == 1) {
                      echo $examen->getIsQCM() == 1 ? "<div id=\"cours\" class=\"tab-pane fade\">" : "<div id=\"cours\" class=\"tab-pane fade in active\">";
                      if (isset($filesList["cours"])) {
                        echo showQCoursExamenCorrection($_GET['id_examen'],$filesList["cours"]);
                      } else {
                        echo warningMessage("Pas de correction pour cet élément");
                      }
                      
                      echo "</div>";
                    }

                    if ($examen->getIsExercice() == 1) {
                      echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<div id=\"exercices\" class=\"tab-pane fade\">" : "<div id=\"exercices\" class=\"tab-pane fade  in active\">";
                      if (isset($filesList["exercices"])) {
                        echo showExerciceExamenCorrection($_GET['id_examen'],$filesList["exercices"]);
                      } else {
                        echo warningMessage("Pas de correction pour cet élément");
                      }
                      
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
                     Aucune correction valable !!
                   </div>
                </div>
              </div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>