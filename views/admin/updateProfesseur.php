<div class="contentpanel">
      <!-- Page header --> 
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>gestion professeurs</h1>
          <h2 class="">Modification d'un compte professeur</h2>
        </div>
      </div>
      <!-- Page Content -->
      <div class="container">

        <div class="row">
          <div class="col-md-8">
            <div class="block-web">
              <div class="header">
                <h3 class="content-header">Modification Compte Professeur</h3>
              </div>
              <div class="porlets-content">
                <form action="updateProfesseur.controller.php" class="form-horizontal row-border" method="POST">
                <input type="hidden" name="id_professeur" value="<?php echo empty($_GET["id_professeur"]) ? $_POST["id_professeur"] : $_GET["id_professeur"]; ?>">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-9">
                      <input type="text" name="nom" class="form-control" value="<?php echo $professeur->getNom(); ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Prénom</label>
                    <div class="col-sm-9">
                      <input type="text" name="prenom" class="form-control" value="<?php echo $professeur->getPrenom(); ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" class="form-control" value="<?php echo $professeur->getEmail(); ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Déscription</label>
                    <div class="col-sm-9">
                      <textarea name="description" class="form-control"><?php echo htmlentities($professeur->getDescription()); ?></textarea>
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