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
              echo $listefiliere;
          ?>
        </div>
        
        
      </div>
      <!-- Page Content END -->
    </div>

    <?php
      $filieremodel->deleteFiliereModal();
    ?>
