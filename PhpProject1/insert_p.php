<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  
  <title>Lokhandwala Foundation School Student Centre</title>
  

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <style>
       select{
        background-color:black;
    opacity: 0.5;
    color: #CCC;   
       }
       
       
       
       label {
	font-family: times;
        font-weight: 200;
        font-size:20px;
	color: white;
	margin-bottom: 5px;
}

input[type=number]
{
    background-color:black;
    opacity: 0.5;
    color: #CCC;
}
input[type=submit]:hover
{
    background-color:black;
    opacity: 0.5;
    color: white;
}
input[type=submit]
{
    background-color:black;
    opacity: 0.8;
    color: white;
}

       div.container{
           
               
           align-content: 
               center;
       }
   div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: auto;
}
form{
    letter-spacing: 2px;
    color:teal;
    font-family: times;
    
    font-size: 18px;
    
     
}

   body {
    background-color:#152b39;
}
   h2 {
      color:white;
      text-align: center;
      font-weight: 700;
    letter-spacing: 15px;
    text-transform: uppercase;
}
   .pull-right{
        margin-top: 7px
    } 
    .btn {
    padding: 14px 24px;
    border: 0 none;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}
 
.btn:focus, .btn:active:focus, .btn.active:focus {
    outline: 0 none;
}
 
.btn-primary {
    background: #0099cc;
    color: #ffffff;
}
 
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background: #33a6cc;
}
 
.btn-primary:active, .btn-primary.active {
    background: #007299;
    box-shadow: none;
}



   </style>
  
  
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['submit'])) { //user logging in
        
        
       $fid=$_SESSION['fid'];
        $course=$_POST['course']; // Displaying Selected Value
 
 //echo $course," ";
$std=$_POST['std'];
//echo $std," ";
$dv=$_POST['Division'];
//echo $dv," ";
//$exam=$_POST['Exam'];

//echo $sid," ";
$check=$mysqli->query("select DISTINCT fid from course inner join taught on taught.cid=course.cid inner join subject on subject.subid=course.subid where (subject.sname='$course' and subject.std=$std and course.dv='$dv')");     
           $open=$check->fetch_assoc();
           
           
          // echo $open['dv'],$open['std'],$open['sname'],$exam;
           //die;
            if($open['fid']!=$_SESSION['fid'])
           {   
                
                
                 $_SESSION['message'] = "Unauthorized Access!";
                 
                header("location: error.php");
                
                die;
           }


       $check=$mysqli->query("select distinct cid from course where dv='$dv' and subid in(select subid from subject where sname='$course' and std=$std) ");     
       $res=$check->fetch_assoc();
        $cid=$res['cid'];

        if($check->num_rows==0)
           {   
                
                 $_SESSION['message'] = "No course found!";
                header("location: error.php");
           }
       $date=$_POST['submit-date'];
       $name=$_POST['proj-desc'];
       $qu="update proj_details set subdate='$date',pname='$name' where cid='$cid'";
        $getid=$mysqli->query($qu);
        
         
  
      }   
        
        
        
        
}
?>


    
<body> 

<div class="container">
  <h2>
 
  Lokhandwala Foundation School
  </h2>
    <div class="btn-group btn-group-justified">
    <a href="about.php" class="btn btn-default" style="background-color:#1ab188; color:white;">About</a>
     <div class="dropdown btn-group" >
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="background-color:#e9fcf7;">Faculty<span class="caret pull-right"></span></button>
    <ul class="dropdown-menu">
        <li><a href="faculty.php" class="btn btn-default btn-block">Sign Up/Login</a></li>
    <li><a href="update_a.php" class="btn btn-default btn-block">Update Attendance</a></li>
    <li><a href="update_m.php" class="btn btn-default btn-block">Update Marks</a></li>
    <li><a href="update_r.php" class="btn btn-default btn-block">Remarks</a></li>
    <li><a href="project.php" class="btn btn-default btn-block">Project</a></li>
    </ul>
    </div>
     <a href="courses.php" class="btn btn-default" style="background-color:#1ab188; color:white;">Courses</a>


    <div class="dropdown btn-group" >
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="background-color:#e9fcf7;">Academics<span class="caret pull-right"></span></button>
    <ul class="dropdown-menu">
    <li><a href="#" class="btn btn-default btn-block">Academic Calendar</a></li>
    <li><a href="#" class="btn btn-default btn-block">Exam Schedule</a></li>
    <li><a href="#" class="btn btn-default btn-block">Timetable</a></li>

    </ul>
    </div>

<div class="dropdown btn-group" >
    <button type="button" class="btn btn-default dropdown-toggle" style="background-color:#1ab188; color:white;" data-toggle="dropdown">Events<span class="caret pull-right"></span></button>
    <ul class="dropdown-menu">
    <li><a href="#" class="btn btn-default btn-block">Sports</a></li>
    <li><a href="events.php" class="btn btn-default btn-block">House Events</a></li>

    </ul>
    </div>


    <div class="dropdown btn-group" >
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="background-color:#e9fcf7;" >Student<span class="caret pull-right"></span></button>
    <ul class="dropdown-menu" >
    <li><a href="attendance.php" class="btn btn-default btn-block">Attendance</a></li>
    <li><a href="marksheet.php" class="btn btn-default btn-block">Gradesheet</a></li>
    <li><a href="remarks.php" class="btn btn-default btn-block">Remarks</a></li>
    <li><a href="viewproj.php" class="btn btn-default btn-block">Projects</a></li>
    </ul>
    </div>

  
</div>
</div>
    
    
   <div class="container">
    <form method="post" align="center" >
            
              <br>
        <br>
      <label for="course">CHOOSE   COURSE:</label>
    <select id="course" name="course"  placeholder="Select..." style="width: 300px; height:40px;">
        <?php
        $fid=$_SESSION['fid'];
        $q=$mysqli->query("SELECT DISTINCT sname from subject where subid in(select subid from course where cid in (select cid from taught where fid='$fid'))");
        $q2=$mysqli->query("SELECT DISTINCT std from subject where subid in(select subid from course where cid in (select cid from taught where fid='$fid'))");
         while($c = $q->fetch_assoc()) {
        ?>
      <option value="<?=$c['sname']?>" style="width: 300px; height:40px;"><?=$c['sname']?></option>
         <?php }
         ?>
    </select>
            
       <br>
      <br>
        <label for="STD">CHOOSE STANDARD:</label>
          <select id="standard" name="std"  placeholder="Select..." style="width: 300px; height:40px;">
        <?php
         while ($c2=$q2->fetch_assoc())
         {
        ?>
      <option value="<?=$c2['std']?>" style="width: 300px; height:40px;"><?=$c2['std']?></option>
         <?php }?>
    </select>
      
      <br>
       <br>
        <label for="STD">CHOOSE DIVISION:</label>
          <select id="division" name="Division"  placeholder="Select..." style="width: 300px; height:40px;">
        <?php
        $q=$mysqli->query("SELECT DISTINCT dv from course where cid in(select cid from taught where fid='$fid')");
         while ($c=$q->fetch_assoc())
         {
        ?>
      <option value="<?=$c['dv']?>" style="width: 300px; height:40px;"><?=$c['dv']?></option>
         <?php }
         
         ?>
    </select>
        
         <br>
       <br>
     
    
    <label for="pname">Project Description
       <br> (in less than 300 characters): </label>
    <input type="text" id="proj-desc" name="proj-desc" placeholder="Enter Desc.." style="width: 300px; height:40px;">
            
    <br>
        <br>
    <label for="submission date">Enter Submission Date</label>
    <input type="date" id="submit-date" name="submit-date" placeholder="Date.." style="width: 300px; height:40px;">
    <br>
    <br>
    
    <input type="submit" name="submit" value="SUBMIT">        
            
    </form>
    </div>

      
     
   

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
    <footer 
 <div class="row" align="center" style="padding: 25px; align-items: center; height: 100px;">
  <a href="logout.php"><button class="button button-block" style="width:100px; height:30px; align-items: center; font-size: small; color:white; background:#00001a; font-family: times;"/>LOGOUT</button></a>

    </div>
  
      
</footer>
</html>