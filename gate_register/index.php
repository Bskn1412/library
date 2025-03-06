<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<style type="text/css" >





#sam
{
 -webkit-animation: saam 3s;
 -webkit-animation-iteration-count:infinite;
 -webkit-animation-direction:alternate;
 -moz-animation:saam 3s;
   -moz-animation-iteration-count:infintie;
    -moz-animation-direction:alternate;
    -o-animation:saam 3s;
    -o-animation-iteration-count:infintie;
    -o-animation-direction:alternate;
    animation:saam 3s;
    animation-iteration-count:infintie;
    animation-direction:alternate;
}

@-webkit-keyframes saam
{
0%{opacity:0.2;}
25%{opacity:0.5;}
50%{opacity:0.8;}
100%{opacity:1.0;}
}


#sam1
{
 -webkit-animation: saaam 5s;
 -moz-animation:saaam 5s;
    -o-animation:saaam 5s;
    animation:saaam 5s;
 }

@-webkit-keyframes saaam
{
0%{opacity:0.0;}
10%{opacity:0.1;}
20%{opacity:0.2;}
30%{opacity:0.3;}
40%{opacity:0.4;}
50%{opacity:0.5;}
60%{opacity:0.6;}
70%{opacity:0.7;}
80%{opacity:0.8;}
90%{opacity:0.9;}
100%{opacity:1.0;}
}


@-moz-keyframes saaam
{
0%{opacity:0.0;}
10%{opacity:0.1;}
20%{opacity:0.2;}
30%{opacity:0.3;}
40%{opacity:0.4;}
50%{opacity:0.5;}
60%{opacity:0.6;}
70%{opacity:0.7;}
80%{opacity:0.8;}
90%{opacity:0.9;}
100%{opacity:1.0;}
}



@-moz-keyframes saam
{
0%{opacity:0.2;}
25%{opacity:0.5;}
50%{opacity:0.8;}
100%{opacity:1.0;}
}

@-o-keyframes saam
{
0%{opacity:0.2;}
25%{opacity:0.5;}
50%{opacity:0.8;}
100%{opacity:1.0;}
}


@keyframes saam
{
0%{opacity:0.2;}
25%{opacity:0.5;}
50%{opacity:0.8;}
100%{opacity:1.0;}
}
*{
	margin: 0;
}

body{
	background-color: rgb(55, 75, 72);
}

#menu ul li a{
	text-decoration: none;
	font-size:23px;
	font-family:Verdana, Geneva, Tahoma, sans-serif;
	color: white;
	width: 100%;
}

#menu ul li a:hover{
  color:rgb(0, 217, 69);
}

#menu ul{
	justify-content: space-evenly;
	align-items: center;
	background-color: black;
	display: flex;
	flex-direction: row;
	padding: 15px 10px;
}

#head{
	padding: 45px;
	font-size: bold;
	font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	text-align: center;
	color: rgb(0, 255, 217);
}

.hero{
	display: flex;
	justify-content: center;
	align-items: end;
	flex-direction: row;
	width: 100%;
}
.img{
	display: flex;
	justify-content: center;
	align-items: center;

}
img {
	width: 58%;
	border-radius: 1rem;
}

.old,.new{
	padding: 10px;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	font-size: 1.4em;
	min-width: 200px;
	margin: 5px;
	color: white;
	letter-spacing: 1px;

}




</style>

</head>
<body>
	<!-- start menu -->
	<div id="menu">
		<ul type="none">
			<li><a href="index.php">Home</a></li>
			<li><a href="studentstatus.php">Student status</a></li>
			<li><a href="facultystatus.php">Faculty Status</a></li>
			<li><a href="datepick.php">Day Wise Details</a></li>
			<li><a href="bdetails.php">Branch wise Details</a></li>
		</ul>
	</div>
	<!-- end menu -->
	<!-- start header -->
	<div id="head">
			<h1>Automatic Library Visitors Counter</h1>
	</div>
	<!-- end header -->
	<!-- start page -->
    <div class="hero">
	  <div class="old" >
       <div id="nam" style="color: yellow;">Developed By:</div><br>
       <div id="nam1">P. Pavan Kumar</div>
       <div id="nam1">A. Asif</div>
       <div id="nam1">K. Balaji</div>
       <div id="nam1">P. Mounika</div>
       <div id="nam1">V. L. Prathyusha</div>
      </div>
	  <div class="img">
	    <img src="images/lib.jpg" />
      </div>
	  <div class="new" >
       <div id="nam" style="color: greenyellow;">Upgraded By:</div><br>
       <div id="nam1">A. Yaswanth Kiran</div>
	   <div id="nam1">B. Syam</div>
       <div id="nam1">B. Sai Karthik Nehuru</div>
      </div>
	</div>

</body>
</html>
