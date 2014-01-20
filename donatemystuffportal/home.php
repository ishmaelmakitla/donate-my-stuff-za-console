<?php

session_start();

if(isset($_SESSION['userid']))
{
//For The Default Time Zone
date_default_timezone_set('Africa/Johannesburg'); //It works
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Donate My Stuff Portal</title>
<meta name="description" content="website description" />
<meta name="keywords" content="website keywords, website keywords" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- modernizr enables HTML5 elements and feature detects -->
<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
<div id="main">
<header>
<div id="logo">
<div id="logo_text">
<!-- class="logo_colour", allows you to change the colour of the text -->
<h1><a href="#">Donate-My-Stuff Management Portal<span class="logo_colour"> version 1.0</span></a></h1>
<h2>"Making a difference with what we have".</h2>
</div>
<form method="post" action="#" id="search">
<input class="search" type="text" name="search_field" value="search....." onclick="javascript: document.forms['search'].search_field.value=''" />
<input name="search" type="image" style="float: right;border: 0; margin: 20px 0 0 0;" src="images/search.png" alt="search" title="search" />
</form>
</div>
<nav>
<ul class="sf-menu" id="nav">
<li class="current"><a href="#">Home</a></li>
<li><a href="requests.php">Requests</a></li>
<li><a href="offers.php">Offers</a></li>
<li><a href="donors.php">Donors</a></li>
<li><a href="beneficiaries.php">Beneficiaries</a></li>
<li><a href="#">Contact Us</a></li>
                 <li><a href="logout.php">Logout</a></li>
</ul>
</nav>
</header>
<div id="site_content">
<div id="sidebar_container">
<div class="sidebar">
<h3>Recent Donations</h3>
<div class="sidebar_item">
<?php
                $json = file_get_contents('http://za-donate-my-stuff.appspot.com/donationoffers');
                $data = json_decode($json);
                
                //parse the json of requests
                //We will show the following tags (BeneficiaryID, Name, GenderCode, Size, Age, and Age Restrictions)
                //var_dump($data);
                $count=0;   $count2=0;
                foreach($data->offers as $offers) {
                if($count==1) break;
		
		if($offers->status=='1'  ||  $offers->status=='2') {   //Considered what would be called donations
		
		?>
		
		<h4> <?php echo $offers->quantity.' '.$offers->item->type; ?> Donated</h4>
		<h5><?php echo date('M d, Y', strtotime($offers->offerdate)) ?></h5>
		<?php
		 $json = file_get_contents('http://za-donate-my-stuff.appspot.com/donors?managerid='.$_SESSION['userid']);
		                $ddata = json_decode($json);
                                 
		                foreach($ddata->donors as $donors) {
		               
                                 if($count2==1) break;
				  echo $donors->donorid . PHP_EOL ;				  
				 
				 echo '	<p>'.$offers->quantity.' '.$offers->item->type. ' were donated by...<br /><a href="offers.php?action=donor_information&id='.$offers->donorid . PHP_EOL.'">Read more</a></p>';
				 $count2++;
				}    
		
		?>
                
         <?php       }
	         else {
		     echo '<p>Sorry there are no recent donations made</p>';
		 }
	 
                $count++;
                }

                ?>
</div>
<div class="sidebar_base"></div>
</div>
<div class="sidebar">
<h3>Latest Offers</h3>
<div class="sidebar_item">
<ul>
<?php
                $json = file_get_contents('http://za-donate-my-stuff.appspot.com/donationoffers');
                $data = json_decode($json);
                
                $count=0;
                foreach($data->offers as $offers) {
                if($count==4) break;
                 echo '<li><a href="offers.php?action=donor_information&id='.$offers->donorid . PHP_EOL.'">'.$offers->item->name . PHP_EOL.'</a></li>' ;
                
                $count++;
                }

                ?>
</ul>
</div>
<div class="sidebar_base"></div>
</div>
<div class="sidebar">
<h3>Latest Requests</h3>
<div class="sidebar_item">
<ul>
<?php
                $json = file_get_contents('http://za-donate-my-stuff.appspot.com/donationrequests?beneficiary='.$_SESSION['userid']);
                $data = json_decode($json);
                
                $count=0;
                foreach($data->requests as $requests) {
                if($count==4) break;
               echo ' <li><a href="requests.php?id=95a7f483-3571-44e6-90af-af6de72664d6">'.$requests->item->name.'</a></li>';
$count++;
}

?>
</ul>
</div>
</div>
</div>
<div class="content">
<h1>Shoes</h1>
<div class="content_item">
<?php
                $json = file_get_contents('http://za-donate-my-stuff.appspot.com/donationoffers');
                $data = json_decode($json);
                
              
                $count=0;
                foreach($data->offers as $offers) {
		$blankets=count($offers->item->type);
                if($count==1) break;
	
		if($offers->item->type=='shoes') {   
		?>
		<p>Donated: <?php echo count($blankets); ?></p>

         <?php       }
	         else {
		     echo '<p>Sorry there are no recent donations made</p>';
		 }
	 
                $count++;
                }

                ?>


</div>
</div>
         <div class="content">
<h1>Books</h1>
<div class="content_item">
</div>
</div>
         <div class="content">
<h1>Blankets</h1>
<div class="content_item">
</div>
</div>
         <div class="content">
<h1>Sport</h1>
<div class="content_item">
                
</div>
</div>
</div>
<footer>
<p><a href="#">Home</a> | <a href="requests.php">Requests</a> | <a href="offers.php">Offers</a> | <a href="donations.php">Donations</a> | <a href="contact.php">Contact Us</a></p>
<p>Copyright &copy; Donate-My-Stuff</p>
</footer>
</div>
<!-- javascript at the bottom for fast page loading -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
<script type="text/javascript" src="js/jquery.sooperfish.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('ul.sf-menu').sooperfish();
});
</script>
</body>
</html>
<?php
}
else
{
//user session not set.
header("Location: login.php");
}
?>
