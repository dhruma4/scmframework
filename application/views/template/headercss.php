<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>SCM</title>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Marvel' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Marvel|Delius+Unicase' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url()."/assets/css/style.css"; ?>" rel="stylesheet" type="text/css" media="screen" />
<style>
 .error {color:red;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
</head> 
<body>
<div id="wrapper">
	<div id="wrapper2">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Student <span>Component </span>Manager</a></h1>
			</div>
			<div id="menu">
				<?php if($logged_in==true) { ?>
				<?php if($logged_in_details['role']=="student"){ ?>
				
					<ul>
						<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
						<li><a href="#">Assignment</a></li>
						
						<li><a href="<?php echo site_url()."/assignment_submit/submit_assignment"?>">Assignment Submit</a></li>
						<li><a href="#">Quiz</a></li>
						<li><a href="#"></a></li>
						<li><a href="#">Classtest</a></li>
						<li><a href="#">Discussion forum</a></li>
						<li><a href="<?php echo site_url()."/authorization/logout"?>">Logout</a></li>
					</ul>
				</div>
					
				
					<?php /* <li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li> */ ?>
				
				<?php } ?>
				<?php if($logged_in_details['role']=="admin") { ?>
				<ul>
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="<?php echo site_url()."/manage/list_of_student";?>">Manage</a></li>
					<li><a href="<?php echo site_url()."/registration/insertfaculty";?>">Add Faculty</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
				
				<?php } ?>
				<?php if($logged_in_details['role']=="faculty") { ?>
				<ul>
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="#">Assignment</a></li>
					<li><a href="#">Classtest</a></li>
					<li><a href="#">Quiz</a></li>
					<li><a href="#">Discussion forum</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
					
				
				<?php } ?>
				<?php if($logged_in_details['role']=="branch moderator") { ?>
				<ul>
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="#">Assignment</a></li>
					<li><a href="#">Classtest</a></li>
					<li><a href="#">Quiz</a></li>
					<li><a href="#">Add Subject</a></li>
					<li><a href="#">Discussion forum</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
					
				
				<?php } ?>
				<?php } ?>
				<?php if($logged_in==false) { ?>
				<ul>
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="<?php echo site_url()."/authorization/login";?>">Login</a></li>
					<li><a href="<?php echo site_url()."/registration/insertstudent";?>">Signup</a></li>
					<li><a href="<?php echo site_url()."/welcome/about";?>">About</a></li>
					<li><a href="<?php echo site_url()."/welcome/contact";?>">Contact</a></li>

				</ul>
					
				
				<?php } ?>
			</div>
		</div>
		<!-- end #header -->