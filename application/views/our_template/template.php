<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
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
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
</head>
<body>
<!-- Beginning header -->
    <div>

        <a href='<?php echo site_url('manage/list_of_faculty')?>'>Faculty</a> | 
        <a href='<?php echo site_url('manage/list_of_student')?>'>Student</a> |
        <a href='<?php echo site_url('manage/list_of_assignment')?>'>Assignments</a> |
        <a href='<?php echo site_url('manage/list_of_test')?>'>Tests</a> |
        <a href='<?php echo site_url('manage/list_of_quiz')?>'>Quizess</a> | 
         <a href='<?php echo site_url('manage/list_of_subject')?>'>Subjects</a> |
         <a href='<?php echo site_url('manage/quiz_result')?>'>Quiz results</a> |
         <a href='<?php echo site_url('manage/test_result')?>'>Classtest results</a> |

 
    </div>
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div></div>
<!-- End of Footer -->
</body>
</html>