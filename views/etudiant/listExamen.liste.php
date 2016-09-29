<div class="container etd">

  <div class="col-lg-3">
    <div class="left-side">
      <div class="side-title"><h3>Listes des Examens</h3></div>
      <div class="side-menu">
        <a href="listeExamen.controller.php" class="btn btn-valider full-left"><i class="fa fa-calendar"></i>Calendrier Des Examens</a>
        <a href="listeExamen.controller.php?type=liste" class="btn btn-valider full-left"><i class="fa fa-list"></i>Liste Des Examens</a>
      </div>
    </div>
  </div>

  <div class="col-lg-9">
    <div class="right-side">
      <?php
        echo $listeExamen;
      ?>
    </div>
  </div>

</div>