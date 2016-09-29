<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Ensak Exam</title>
  <link href="../../public/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../../public/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="../../public/css/admin.css" rel="stylesheet" type="text/css" />
  <link href="../../public/css/main-style.css" rel="stylesheet" type="text/css" />
  <link href="../../public/plugins/calendar/fullcalendar.css" rel="stylesheet" type="text/css" />
  <link href="../../public/plugins/calendar/fullcalendar.print.css" rel="stylesheet" type="text/css" />
</head>

<body class="dark_theme fixed_header left_nav_fixed">

<div class="wrapper">

	<!-- header admin -->
	<div class="header_bar">
	    <div class="brand">
	      <div class="logo" style="display:block"><span class="theme_color">ENSAK</span> Examen</div>
	    </div>

	    <div class="header_top_bar">
	      <a href="javascript:void(0);" class="menutoggle"> <i class="fa fa-bars"></i> </a>
	      <div class="top_right_bar">
	        <!-- profile -->
	        <div class="user_admin dropdown"> 
	          <a href="javascript:void(0);" data-toggle="dropdown"><img src="../../public/images/user.jpg" />
	          	<span class="user_adminname"><?php echo $_SESSION['admin']["nom"]." ".$_SESSION['admin']["prenom"]; ?></span> <b class="caret"></b> </a>
	          <ul class="dropdown-menu">
	            <div class="top_pointer"></div>
	            <li> <a href="../connection/logout.controller.php"><i class="fa fa-power-off"></i> Logout</a> </li>
	          </ul>
	        </div>
	        
	      </div>
	    </div>
	  </div>

	  <div class="inner">