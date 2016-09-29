<div class="passe-header">
  <input type="hidden" id="leftTime" value="<?php echo $examenmodel->getExamenTimeLeft($examen); ?>">
  <input type="hidden" id="leftTimeInSec" value="<?php echo $examenmodel->getExamenTimeLeftInSeconds($examen); ?>">
  <div class="container">

    <div class="col-lg-4">
      <h2><?php echo $examen->getTitle(); ?></h2>
      <p><strong>Module : </strong><?php echo $modulemodel->getModuleById($examen->getId_module())->getIntitule(); ?></p>
    </div>

    <div class="col-lg-5">
      <p><strong>Déscription : </strong><?php echo $examen->getDescription(); ?></p>
    </div>

    <div class="col-lg-3">
      <p><strong>Durée : </strong><?php echo $examen->getDuree(); ?></p>
      <h3><strong>Temps restant : </strong><span id="clock"></span></h3>
    </div>

  </div>
</div>

<div class="container etd">

  <!-- partie affichage -->
  <div class="col-lg-5">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div class="header">
                <h2 class="content-header colored">ÉNONCÉ</h2>
              </div>
              <div class="porlets-content">
                <ul class="nav nav-tabs" id="myTab">
                  <?php
                    if ($examen->getIsCoure() == 1) {
                        echo "<li class=\"active\"><a data-toggle=\"tab\" href=\"#cours\">Partie Questions de cours</a></li>";
                    }

                    if ($examen->getIsExercice() == 1) {
                        echo $examen->getIsCoure() == 1 ? "<li>" : "<li class=\"active\">";
                        echo "<a data-toggle=\"tab\" href=\"#exercices\">Partie Exercices</a></li>";
                    }
                  ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                <?php
                    if ($examen->getIsCoure() == 1) {
                      echo "<div id=\"cours\" class=\"tab-pane fade in active\">";
                      echo showQCoursExamen($_GET['id_examen'],$filesList["cours"]);
                      echo "</div>";
                    }

                    if ($examen->getIsExercice() == 1) {
                      echo $examen->getIsCoure() == 1 ? "<div id=\"exercices\" class=\"tab-pane fade\">" : "<div id=\"exercices\" class=\"tab-pane fade  in active\">";
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
  <!-- end partie affichage -->

  <!-- partie edit -->
  <div class="col-lg-7">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div class="porlets-content">
                <ul class="nav nav-tabs" id="myTabEdit">
                  <?php
                    if ($examen->getIsQCM() == 1) {
                        echo "<li class=\"active\"><a data-toggle=\"tab\" href=\"#qcmEdit\">Partie QCM</a></li>";
                    }

                    if ($examen->getIsCoure() == 1) {
                        echo $examen->getIsQCM() == 1 ? "<li>" : "<li class=\"active\">";
                        echo "<a data-toggle=\"tab\" href=\"#coursEdit\">Partie Questions de cours</a></li>";
                    }

                    if ($examen->getIsExercice() == 1) {
                        echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<li>" : "<li class=\"active\">";
                        echo "<a data-toggle=\"tab\" href=\"#exercicesEdit\">Partie Exercices</a></li>";
                    }
                  ?>
                </ul>
                <form action="saveRepense.controller.php" class="form-horizontal row-border" method="POST" id="formRepense">
                <input type="hidden" name="id_examen" value="<?php echo $_GET['id_examen']; ?>">
                <div class="tab-content" id="myTabContentEdit">
                  
                    <?php
                        if ($examen->getIsQCM() == 1) {
                          echo "<div id=\"qcmEdit\" class=\"tab-pane fade in active\">";
                          echo showQCMExamenForCorrection($_GET['id_examen'],$filesList["qcm"]);
                          echo "</div>";
                          echo "<input type=\"hidden\" name=\"nbrQuestion_qcm\" id=\"nbrQuestion_qcm\" value=\"".getNbrQuestionQCM($_GET['id_examen'],$filesList["qcm"])."\">";
                        }

                        if ($examen->getIsCoure() == 1) {
                          echo $examen->getIsQCM() == 1 ? "<div id=\"coursEdit\" class=\"tab-pane fade\">" : "<div id=\"coursEdit\" class=\"tab-pane fade in active\">";
                    ?>
                    <div class="form-horizontal row-border">
                      <div class="form-group">
                        <div class="col-sm-10">
                          <textarea class="form-control ckeditor" id="editorContent_cours" name="editorContent_cours" rows="6"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-8">
                          <select name="q_option_cours" id="q_option_cours">
                            <option value="null">Selectioner l'exercice</option>
                            <?php
                              for ($i=1; $i <= getNbrQuestionCours($_GET["id_examen"],$filesList["cours"]) ; $i++) { 
                                echo "<option value=\"".$i."\" id=\"".$i."\">Question ".$i."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <input class="btn btn-valider pull-right" type="button" value="Ajouter" onClick="addCorrectionQuestionCours()"/>
                        </div>
                      </div>
                    </div>
                    <?php
                          echo "</div>";
                          $examenmodel->createHiddenInputs(getNbrQuestionCours($_GET['id_examen'],$filesList["cours"]),"cours");
                        }

                        if ($examen->getIsExercice() == 1) {
                          echo ($examen->getIsQCM() == 1 || $examen->getIsCoure() == 1) ? "<div id=\"exercicesEdit\" class=\"tab-pane fade\">" : "<div id=\"exercicesEdit\" class=\"tab-pane fade  in active\">";
                    ?>
                    <div class="form-horizontal row-border">
                      <div class="form-group">
                        <div class="col-sm-10">
                          <textarea class="form-control ckeditor" id="editorContent" name="editorContent" rows="6"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-8">
                          <select name="q_option" id="q_option">
                            <option value="null">Selectioner l'exercice</option>
                            <?php
                              for ($i=1; $i <= getNbrExercices($_GET['id_examen'],$filesList["exercices"]) ; $i++) { 
                                echo "<option value=\"".$i."\" id=\"".$i."\">Exercice ".$i."</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <input class="btn btn-valider pull-right" type="button" value="Ajouter" onClick="addExercice()"/>
                        </div>
                      </div>
                    </div>
                    <?php
                          echo "</div>";
                          $examenmodel->createHiddenInputs(getNbrExercices($_GET['id_examen'],$filesList["exercices"]),"exercice");
                        }
                    ?>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container bot">
      <div id="questionsContainer"></div>
      <div id="exercicesContainer"></div>
      <botton class="btn btn-valider pull-right" onclick="Horloge()">Envoyer la réponse</botton>
    </div>

  </div>
  <!-- end partie edit -->

</div>
      