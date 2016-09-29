<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Ensak Exam</title>
  <link href="../../public/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../../public/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="../../public/css/admin.css" rel="stylesheet" type="text/css" />
  <link href="../../public/plugins/toggle-switch/toggles.css" rel="stylesheet" type="text/css" />
  <link href="../../public/plugins/calendar/fullcalendar.css" rel="stylesheet" type="text/css" />
  <link href="../../public/plugins/calendar/fullcalendar.print.css" rel="stylesheet" type="text/css" />
    <link href="../../public/css/main-style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../../public/plugins/bootstrap-datepicker/css/datepicker.css" />
</head>
<body class="front-body">

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ENSAK EXAMEN</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php echo ($menu_tab == "examen") ? ' class="active"' : ''; ?>><a href="listeExamen.controller.php">Examens</a></li>
        <li <?php echo ($menu_tab == "filiere") ? ' class="active"' : ''; ?>><a href="afficherFiliere.controller.php">Filière</a></li>
        <li <?php echo ($menu_tab == "profile") ? ' class="active"' : ''; ?>><a href="profile.controller.php">Mon Profile</a></li>
				<style>
#notification_count
{
padding: 0px 3px 3px 7px;
background: #cc0000;
color: #ffffff;
font-weight: bold;
margin-left: 77px;
border-radius: 9px;
-moz-border-radius: 9px;
-webkit-border-radius: 9px;
position: absolute;
margin-top: -1px;
font-size: 10px;
}
</style>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
 
function addmsg(type, msg){
 
$('#notification_count').html(msg);
 
}
 
function waitForMsg(){
 
$.ajax({
type: "GET",
url: "../../layouts/etudiant/select.php",
 
async: true,
cache: false,
timeout:50000,
 
success: function(data){
addmsg("new", data);
setTimeout(
waitForMsg,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){
addmsg("error", textStatus + " (" + errorThrown + ")");
setTimeout(
waitForMsg,
15000);
}
});
};
 
$(document).ready(function(){
 
waitForMsg();
 
});
 
</script>
<span id="notification_count"></span>
        <li <?php echo ($menu_tab == "notification") ? ' class="active"' : ''; ?>><a href="notification.controller.php">Notifications</a></li>
<div id="HTMLnoti" style="textalign:center"></div>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../connection/logout.controller.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>