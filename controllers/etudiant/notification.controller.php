<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/notification.model.php';

$notificationmodel = new notificationModel($BDD);
$listeannonce = $notificationmodel->showAllAnnonce();
$notificationmodel->updateNotif();

$menu_tab = "notification";

include_once '../../layouts/etudiant/head.etudiant.php';

include_once '../../views/professeur/listeAnnonce.php';

include_once '../../layouts/etudiant/footer.etudiant.php';
?>