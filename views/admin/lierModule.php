    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion modules</h1>
          <h2 class="">Lier Module</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Lier Module : <?php $modulemodel->showIntituleModule(empty($_GET["id_module"]) ? $_POST["id_module"] : $_GET["id_module"]); ?></h3>
              </div>
              <div class="porlets-content">
                <form action="lierModule.controller.php" class="form-horizontal row-border" method="POST">
                  <input type="hidden" name="id_module" value="<?php echo empty($_GET["id_module"]) ? $_POST["id_module"] : $_GET["id_module"]; ?>">
                  <?php
                    $professeurmodel->optionProfesseur();

                    $filieremodel->optionFiliere();
                  ?>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Semestre</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="source" name="optionSemestre">
                        <option value="null"> Choix </option>
                        <option value="S1"> Semestre 1 </option>
                        <option value="S2"> Semestre 2 </option>
                      </select>
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
                  echo "<div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                        <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        ".$message."</div></div>";
              }
            ?>
          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>