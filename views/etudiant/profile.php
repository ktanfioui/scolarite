<div class="container etd">

  <div class="col-lg-3">
    <div class="left-side">
      <div class="side-title"><h3>Mon Profile</h3></div>
    </div>
  </div>

  <div class="col-lg-9">
    <div class="right-side">

      <div class="col-lg-6">
        <section class="panel default blue_title h2">
          <div class="panel-heading">Mes Informations</div>
          <div class="panel-body">
            <p><strong class="colored">Nom : </strong><?php echo $etudiant->getNom(); ?></p>
            <p><strong class="colored">Prénom : </strong><?php echo $etudiant->getPrenom(); ?></p>
            <p><strong class="colored">Email : </strong><?php echo $etudiant->getEmail(); ?></p>
            <p><strong class="colored">CIN : </strong><?php echo $etudiant->getCIN(); ?></p>
          </div>
        </section>
      </div>

      <div class="col-lg-6">
        <section class="panel default blue_title h2">
          <div class="panel-heading">Modifier Mot de passe</div>
          <div class="panel-body">
            <?php 
              if(!empty($message))
              {
                  echo "<div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                        <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        ".$message."</div></div>";
              }
            ?>
            <form action="profile.controller.php" class="form-horizontal row-border" method="POST">

              <div class="form-group">
                <p class="col-sm-12">Mot de passe actuel</p>
                <div class="col-sm-12">
                  <input type="password" name="oldpassword" class="form-control">
                </div>
              </div>
              
              <div class="form-group">
                <p class="col-sm-12">Nouveau Mot de passe</p>
                <div class="col-sm-12">
                  <input type="password" name="newpassword" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <p class="col-sm-12">Retaper Mot de passe</p>
                <div class="col-sm-12">
                  <input type="password" name="rnewpassword" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-12">
                  <button type="submit" name="submit" class="btn btn-valider pull-right">Valider</button>
                </div>
              </div>

            </form>
          </div>
        </section>
      </div>

    </div>
  </div>

</div>