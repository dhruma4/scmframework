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
<link href="<?php echo base_url()."/assets/css/menustyle.css"; ?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url()."/assets/js/jquery.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url()."/assets/js/menu.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url()."/assets/js/script.js"; ?>"></script>
<style>
 .error {color:red;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
<script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/jquery.effects.core.js" type="text/javascript"></script>

</script>
</head> 
<body>
<div id="wrapper">
	<div id="wrapper2">
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#">Student <span>Component </span>Manager</a></h1>
			</div>
			<div  >
				<?php if($logged_in==true) { ?>
				<?php if($logged_in_details['role']=="student"){ ?>
					
					<ul id="menu">
						<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
						<li ><a href="#">Assignment</a>
							<ul >
								<li><a href="<?php echo site_url()."/student_view/view_assignment_ques";?>">Assignment view</a></li>
								<li><a href="<?php echo site_url()."/assignment_submit/submit_assignment";?>">Assignment submit</a></li>
							</ul>
						</li>
						<li><a href="<?php echo site_url()."/testdisplay/select_test";?>">Classtest</a></li>
						<li><a href="<?php echo site_url()."/quizdisplay/select_quiz";?>">Quiz</a></li>
						<li><a href="#">Forum</a>
							<ul>
								<li><a href="<?php echo site_url()."/forum/forum_create";?>">Create topic</a></li>
								<li><a href="<?php echo site_url()."/forum/topic_list";?>">See all topics</a></li>
							</ul>
						</li>
						<li><a href="#">Result</a>
							<ul>
								<li><a href="<?php echo site_url().;?>">Classtest</a></li>
								<li><a href="<?php echo site_url().;?>">Quiz</a></li>
							</ul>
						</li>
						<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
					</ul>
			</div>
				<?php } ?>
				<?php if($logged_in_details['role']=="admin") { ?>
				<ul id="menu">
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="<?php echo site_url()."/manage/list_of_student";?>">Manage</a></li>
					<li><a href="<?php echo site_url()."/registration/insertfaculty";?>">Add Faculty</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
				
				<?php } ?>
				<?php if($logged_in_details['role']=="faculty") { ?>
				<ul id="menu">
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li><a href="#">Assignment</a>
						<ul>
							<li><a href="<?php echo site_url()."/assignment_upload/upload_assignment";?>">Assignment upload</a></li>
							<li><a href="<?php echo site_url()."/assignmentques/select_assignment";?>">Question upload</a></li>
						</ul> 
					</li>                                                              
					<li><a href="#">Classtest</a>
						<ul>
							<li><a href="<?php echo site_url()."/classtest/upload_test";?>">Test upload</a></li>
							<li><a href="<?php echo site_url()."/testques/select_test";?>">Question upload</a></li>
						</ul>
					</li>
					<li><a href="#">Quiz</a>
						<ul>
							<li><a href="<?php echo site_url()."/quiz/upload_quiz";?>">Quiz upload</a></li>
							<li><a href="<?php echo site_url()."/quizques/select_quiz";?>">Question upload</a></li>
						</ul>
					</li>
					<li><a href="#">Forum</a>
							<ul>
								<li><a href="<?php echo site_url()."/forum/forum_create";?>">Create topic</a></li>
								<li><a href="<?php echo site_url()."/forum/topic_list";?>">See all topics</a></li>
							</ul>
					</li>
					<li><a href="<?php echo site_url()."/faculty_manage/list_of_assignments";?>">Manage</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
				<?php } ?>
				<?php if($logged_in_details['role']=="branch moderator") { ?>
				<ul id="menu">
					<li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
					<li class="hasChildren"><a href="#">Assignment</a></li>
						<ul>
							<li><a href="<?php echo site_url()."/assignment_upload/upload_assignment";?>">Assignment upload</a></li>
							<li><a href="<?php echo site_url()."/assignment_upload/select_assignment";?>">Question upload</a></li>
						</ul>
					<li><a href="#">Classtest</a></li>
						<ul>
							<li><a href="<?php echo site_url()."/classtest/upload_test";?>">Test upload</a></li>
							<li><a href="<?php echo site_url()."/testques/select_test";?>">Question upload</a></li>
						</ul>
					<li><a href="#">Quiz</a></li>
						<ul>
							<li><a href="<?php echo site_url()."/quiz/upload_quiz";?>">Quiz upload</a></li>
							<li><a href="<?php echo site_url()."/quizques/select_quiz";?>">Question upload</a></li>
						</ul>
					<li><a href="#">Forum</a></li>
						<ul>
							<li><a href="<?php echo site_url()."/forum/forum_create";?>">Create topic</a></li>
							<li><a href="<?php echo site_url()."/forum/topic_list";?>">See all topics</a></li>
						</ul>
					<li><a href="<?php echo site_url()."/subject_add/insertsubject";?>">Add Subject</a></li>
					<li><a href="<?php echo site_url()."/faculty_manage/list_of_assignments";?>">Manage</a></li>
					<li><a href="<?php echo site_url()."/authorization/logout";?>">Logout</a></li>
				</ul>
					
				
				<?php } ?>
				<?php } ?>
				<?php if($logged_in==false) { ?>
				<ul id="menu">
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