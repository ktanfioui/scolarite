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
          <form action="listeExamen.controller.php" class="form-horizontal row-border" method="POST">
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
          <?php
              echo $listeexamen;
          ?>
        </div>

      </div>
      <!-- Page Content END -->
    </div>

