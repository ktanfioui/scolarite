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
                <h2 class="content-header colored"><?php echo $examen->getTitle(); ?></h2>
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
                      echo showQCMExamen($_GET['id_examen'],$filesList["qcm"]);
                      echo "</div>";
                    }

                    if ($examen->getIsCoure() == 1) {
                      echo $examen->getIsQCM() == 1 ? "<div id=\"cours\" class=\"tab-pane fade\">" : "<div id=\"cours\" class=\"tab-pane fade in active\">";
                      echo showQCoursExamen($_GET['id_examen'],$filesList["cours"]);
                      echo "</div>";
                    }

                    if ($examen->getIsExercice() == 1) {
                      echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<div id=\"exercices\" class=\"tab-pane fade\">" : "<div id=\"exercices\" class=\"tab-pane fade  in active\">";
                      echo showExerciceExamen($_GET['id_examen'],$filesList["exercices"]);
                      echo "</div>";
                    }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>
      