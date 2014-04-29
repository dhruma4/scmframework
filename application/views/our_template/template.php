<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
<meta charset="utf-8" />
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
   
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
  
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 12px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 12px;
}
a:hover
{
    text-decoration: underline;
}
</style>
</head>
<body>
<div id="wrapper">
    <div id="wrapper2">
        <div id="header" class="container">
            <div id="logo">
                <h1><span> S &nbsp  C &nbsp M &nbsp</span></h1>
            </div> 
            <div id="menu">
                <ul>
                    <li class="current_page_item"><a href="<?php echo site_url();?>">Homepage</a></li>
                    <li><a href='<?php echo site_url('manage/list_of_faculty')?>'>Faculty</a></li>
                    <li><a href='<?php echo site_url('manage/list_of_student')?>'>Student</a></li>
                    <li><a href='<?php echo site_url('manage/list_of_subject')?>'>Subjects</a></li>
                    <li><a href="#">Components</a>
                        <ul>
                            <li><a href='<?php echo site_url('manage/list_of_assignment')?>'>Assignments</a></li>
                            <li><a href='<?php echo site_url('manage/list_of_test')?>'>Tests</a></li>
                            <li><a href='<?php echo site_url('manage/list_of_quiz')?>'>Quizess</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Results</a>
                        <ul>
                            <li><a href='<?php echo site_url('manage/quiz_result')?>'>Quiz results</a></li>
                            <li><a href='<?php echo site_url('manage/test_result')?>'>Classtest results</a></li>
                        </ul> 
                    </li>
                    <li><a href='<?php echo site_url('manage/disc_topics');?>'>Discussion topics</a></li>
                    <li><a href='<?php echo site_url('manage/comments');?>'>Comments</a></li>

                </ul>
            </div>
<!-- Beginning header -->
  </div>
<!-- End of header-->
<div style='width:652px; padding:20px 500px;'>
        <?php echo $output; ?>
 
    </div>
    <div style='height:20px;'></div>  
 <!-- Beginning footer -->
<div>
<div style="clear: both;">&nbsp;</div>
            </div>
            <!-- end #content -->
            <div style="clear: both;">&nbsp;</div>
                
                        <!-- end #page -->
                        <div id="footer">
                            <p></p>
                        </div>
                    </div>
                </div>
            <!-- end #footer -->
        </body>
</html>

