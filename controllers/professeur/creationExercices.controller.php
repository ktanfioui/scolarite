<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';


include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "examen";
$menu_tab_sub = "creationExamen";
include_once '../../layouts/professeur/menu.professeur.php';

include_once '../../views/professeur/creationExercices.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>