<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ensak Exam</title>
<link href="public/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="public/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="public/css/admin.css" rel="stylesheet" type="text/css" />
<link href="public/css/main-style.css" rel="stylesheet" type="text/css" />
</head>
<body class="dark_theme fixed_header left_nav_fixed">

  <div class="wrapper">
    <div class="login_page">
      <div class="login_content">
        <div class="panel-heading border login_heading">Espace Administrateur</div>	
          <form role="form" class="form-horizontal" action="controllers/connection/connection.controller.php" method="POST">
            <?php 
              if(isset($_GET['message']))
              {
                  echo "<div class=\"bs-example\"><div class=\"alert alert-danger fade in\">
                        <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        ".$_GET['message']."</div></div>";
              }
            ?>
            <div class="form-group">
              <div class="col-lg-12">
                <input type="email" name="email" placeholder="Email" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-12">
                <input type="password" name="password" placeholder="Password" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-12">
                <select class="form-control" name="role">
                  <option value="null"> Choix De l'espace</option>
                  <option value="admin">Espace Administrateur</option>
                  <option value="prof">Espace Professeur</option>
                  <option value="etudiant">Espace Etudiant</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class=" col-sm-10">
                <button name="submit" class="btn btn-valider pull-right" type="submit">Se connecter</button>
              </div>
            </div>
            
          </form>
      </div>
    </div>
  </div>
  
  <script src="../../public/js/jquery-2.1.0.js"></script>
  <script src="../../public/js/bootstrap.min.js"></script>

</body>
</html>
