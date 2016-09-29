  <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Examen</h1>
          <h2 class="">Liste des Examen</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <input type="hidden" id="id_filiere" value="<?php echo isset($_POST["optionFiliere"]) ? $_POST["optionFiliere"] : "null"; ?>">
          <form action="calendarExamen.controller.php" class="form-horizontal row-border" method="POST">
            <div class="col-lg-offset-7 col-lg-4">
              <?php
                $filieremodel->optionFiliere();
              ?>
            </div>
            <div class="col-lg-1">
              <button type="submit" name="submit" class="btn btn-valider">Valider</button>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div class="header">
                <h2 class="content-header colored"><?php echo $title; ?></h2>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="block-web">
              <div id='calendar'></div>
            </div>
          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>

