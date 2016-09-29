    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion Examen</h1>
          <h2 class="">Création d'un nouveau examen</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Créer Examen <small>Information Générale</small></h3>
              </div>
              <div class="porlets-content">
                <form action="creationExamen.controller.php" class="bucket-form form-horizontal row-border" method="POST">
                  <input type="hidden" name="phase" value="2">
                  <input type="hidden" name="optionFiliere" value="<?php echo $_POST['optionFiliere']; ?>">

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Titre</label>
                    <div class="col-sm-8">
                      <input type="text" name="title" class="form-control">
                    </div>
                  </div>

                  <?php
                    $modulemodel->optionModule($_SESSION['professeur']["id"],$_POST['optionFiliere']);
                  ?>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Date d'examen</label>
                    <div class="col-sm-8">
                      <input type="text" name="p_date" value="" size="16" class="form-control form-control-inline input-medium default-date-picker">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Heure du controle</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="heureControle">
                        <option value="null"> Heure </option>
                        <option value="08"> 08 h </option>
                        <option value="09"> 09 h </option>
                        <option value="10"> 10 h </option>
                        <option value="11"> 11 h </option>
                        <option value="14"> 14 h </option>
                        <option value="15"> 15 h </option>
                        <option value="16"> 16 h </option>
                        <option value="17"> 17 h </option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control" name="minuteControle">
                        <option value="null"> Minute </option>
                        <option value="00"> 00 min </option>
                        <option value="15"> 15 min </option>
                        <option value="20"> 20 min </option>
                        <option value="30"> 30 min </option>
                        <option value="40"> 40 min </option>
                        <option value="45"> 45 min </option>
                        <option value="50"> 50 min </option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Durée du controle</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="heureDuree">
                        <option value="null"> Heure </option>
                        <option value="01"> 01 h </option>
                        <option value="02"> 02 h </option>
                        <option value="03"> 03 h </option>
                        <option value="04"> 04 h </option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control" name="minuteDuree">
                        <option value="null"> Minute </option>
                        <option value="00"> 00 min </option>
                        <option value="15"> 15 min </option>
                        <option value="20"> 20 min </option>
                        <option value="30"> 30 min </option>
                        <option value="40"> 40 min </option>
                        <option value="45"> 45 min </option>
                        <option value="50"> 50 min </option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Déscription</label>
                    <div class="col-sm-8">
                      <textarea name="description" class="form-control"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label">Contenu de l'examen</label>
                    <div class="col-sm-8">
                      <div class="col-sm-12">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="isQCM">
                            QCM
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="isCoure">
                            Questions de Cours
                          </label>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="isExercice">
                            Exercices
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-12">
                      <button type="submit" name="submit" class="btn btn-valider pull-right">Valider</button>
                    </div>
                  </div>

                </form>
              </div>
            </div> 
          </div>
          <div class="col-lg-4">
            <?php 
              if(!empty($message))
              {
                  echo $message;
              }
            ?>
          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>