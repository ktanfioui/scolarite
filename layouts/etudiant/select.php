<?php

/*include_once '../../models/etudiant/notification.model.php';

$notificationmodel = new notificationModel($BDD);

$count = $notificationmodel->countAnnonce();
echo $count;*/

      $servername = "localhost";
       $username = "root";
       $password = "khaoula";
       $dbname = "ensakfor_examen";
 
       // Create connection
 
       $conn = new mysqli($servername, $username, $password, $dbname);
 
       // Check connection
 
       if ($conn->connect_error) {
 
           die("Connection failed: " . $conn->connect_error);
 
       }
       
       $sql = "SELECT * from annonce where status = 'unread'";
       $result = $conn->query($sql);
       $row = $result->fetch_assoc();
       $count = $result->num_rows;
       echo $count;
       $conn->close();


?>