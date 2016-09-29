    <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion professeurs</h1>
          <h2 class="">Listes des professeurs</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <?php
              echo $listeprofesseur;
          ?>
        </div>
      </div>
      <!-- Page Content END -->
    </div>

    <?php
      $professeurmodel->deleteProfesseurModal();
    ?>