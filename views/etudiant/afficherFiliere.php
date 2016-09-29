<div class="container etd">

  <div class="col-lg-3">
    <div class="left-side">
      <?php
        echo $filiereInfo;
      ?>
    </div>
  </div>

  <div class="col-lg-9">
    <div class="right-side">
      <div class="col-lg-6">
        <section class="panel default red_border vertical_border h1">
          <div class="task-header red_task">Semestre 1</div>
        </section>
        <?php
          $modulemodel->printFiliereModuleBySemstre($_SESSION['etudiant']['id_filiere'],1);
        ?>
      </div>
      <div class="col-lg-6">
        <section class="panel default red_border vertical_border h1">
          <div class="task-header red_task">Semestre 2</div>
        </section>
        <?php
          $modulemodel->printFiliereModuleBySemstre($_SESSION['etudiant']['id_filiere'],2);
        ?>
      </div>
    </div>
  </div>

</div>