    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion filières</h1>
          <h2 class="">Listes des filières</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <?php
            echo $filiereInfo;
            $filieremodel->printFiliereModuleBySemstre(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"],$_SESSION['professeur']["id"]);
          ?>
        </div>


        <!-- liste des etudiant -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel default blue_title h2">
              <div class="panel-heading">Liste des etudiants de la filiére</div>
              <div class="panel-body">
              <?php
                $filieremodel->printFiliereEtudiant(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]);
              ?>
              </div>
            </section>
          </div>
        </div>

      </div>
      <!-- Page Content END -->
    </div>