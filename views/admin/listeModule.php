  <div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion modules</h1>
          <h2 class="">Liste des Modules</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <?php
              echo $listemodule;
          ?>
        </div>

      </div>
      <!-- Page Content END -->
    </div>
    <?php
      $modulemodel->deleteModuleModal();
    ?>
