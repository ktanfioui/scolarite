    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion Examen</h1>
          <h2 class="">Création de la correction de la partie Exercices</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">

          <div class="col-md-8">

            <div id="questionsForm">
              <div class="block-web">
                <div class="header">
                  <h3 class="content-header">Ajouter la correction d'un exercice</h3>
                </div>
                <div class="porlets-content">
                  <form class="form-horizontal row-border">

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
                            for ($i=1; $i <= getNbrExercices($_GET["id_examen"],$file) ; $i++) { 
                              echo "<option value=\"".$i."\" id=\"".$i."\">Exercice ".$i."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <input class="btn btn-valider pull-right" type="button" value="Ajouter" onClick="addExercice()"/>
                      </div>
                    </div>

                  </form>
                </div>
              </div>

            </div>

            <div id="questionsContainer"></div>

          </div>

          <div class="col-lg-4">

            <div id="erreurMessage"></div>

            <div>
              <form action="saveExercicesCorrection.controller.php" class="form-horizontal row-border" id="saveForm"  method="POST">
                <input type="hidden" name="id_examen" value="<?php echo $_GET["id_examen"]; ?>">
                <input type="hidden" id="nbrQuestionCorriger" value="0">
                <input type="hidden" name="nbrQuestion" id="nbrQuestion" value="<?php echo getNbrExercices($_GET["id_examen"],$file); ?>">

                <div class="form-group">
                    <div class="col-sm-12">
                      <button type="submit" name="submit" id="btn-final" class="hide">Enregistrer la correction des Exercices</button>
                    </div>
                </div>

              </form>
            </div>

          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>