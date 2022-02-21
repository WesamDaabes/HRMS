<?php
session_start();
if($_SESSION['Status']!="Active")
{
    header('location:index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>HomePage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* make scrollbar transparent */
}
.header {
  padding: 20px;
  text-align: center;
  background: #E87521;
  color: white;
}
.header h1 {
  font-size: 40px;
}
.navbar {
  overflow: hidden;
  background-color: #333;
   opacity:95%;
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}
.navbar a.right {
  float: right;
}
.navbar a:hover {
  background-color: #ddd;
  color: black;
}
.row {  
  display: flex;
  flex-wrap: wrap;
}
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}
.main {   
  flex: 70%;
  background-color: white;
  padding: 20px;
}
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}
.footer {
  padding: 5px;
  text-align: center;
  background: #ddd;
  background-color: #efefef;
  flex: 0 0 50px;
  margin-top: auto;
  
}
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width:100%;
  }
}
.WebpageButton {
    background-color: transparent;
    background-repeat: no-repeat;
    border: none;
    cursor: pointer;
    overflow: hidden;
    outline: none;
  }
  .slideshow-container {
  max-width: 750px;
  position: relative;
  margin: auto;
}

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

.numbertext {
  color: #f2f2f2;
  font-size: 14px;
  padding: 8px 12px;
  position: absolute;
  font-weight: bold;
  top: 0;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<div class="header">
  <img src="images/logo.png" style="height: auto;position: absolute;margin-left: -58%;width: 27%;margin-top: -3%;"   class="left"  ><h1 style="margin-left:-30%;margin-top:2.7%;">Human Resources Managment System</h1><h1 style="color:transparent;margin-top:-4%;margin-left:150%;overflow:hidden;">.</h1>
  <p style="margin-left:80%;margin-top:-4.8%;position:absolute;"><?php echo "Hello " . $_SESSION['First_Name'] . " " . $_SESSION['Last_Name'] . " / " . $_SESSION['Employee_ID'] ; ?></p>
</div>

<div class="navbar">
  <a style="background-color:#E87521;" href="Homepage.php">Home</a>
  <?php
  if ($_SESSION['Access']=="Admin") {
      echo '<a href="AddEmployee.php">Add New Employee</a>';
  }
  ?>
  <a href="Requests.php">Requests</a>
  <?php
  if ($_SESSION['Access']!="Admin") {
      echo '<a href="MyRequests.php">My Requests</a>';
  }
  if ($_SESSION['Access']=="Admin") {
      echo '<a href="Employee_Managment.php">Employee Management</a>';
  }
  if ($_SESSION['Access']!="Admin") {
      echo '<a href="Employee_Managment.php">Edit My Info</a>';
  }
  ?>
  <a href="php/logout.php" class="right">Logout</a>
</div>
  <div class="main">
  <div class="slideshow-container" style="margin-top:1%;">

<div class="mySlides fade">
  <div class="numbertext">1 / 4</div>
 <img src="images/S1.jpeg"  style="width:100%" height="auto">

</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 4</div>
  <img src="images/S2.png"  style="width:100%" height="auto">

</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 4</div>
  <img src="images/S3.jpeg"  style="width:100%" height="auto">

</div>
<div class="mySlides fade">
  <div class="numbertext">4 / 4</div>
  <img src="images/S4.png"  style="width:100%" height="auto">

</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span>
  <span class="dot" onclick="currentSlide(4)"></span> 
</div>
  </div>
  <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
<script>
let sliderimage=2;
setInterval(function() {
  currentSlide(sliderimage);
  sliderimage=sliderimage+1;
  if(sliderimage>4){sliderimage=1;}
  }, 2500);
</script>
<div class="footer">
  <h4>Philadephia Uninversity Human Resourses Managment Project</h4>
  <input  class="WebpageButton" type="button" onclick="location.href='https://www.philadelphia.edu.jo';" value="Go To University Webpage" />
</div>
</body>
</html>
