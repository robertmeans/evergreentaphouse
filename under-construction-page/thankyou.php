<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ABC Company</title>
	<!-- <link rel="icon" type="image/ico" href="_images/favicon.ico"> -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="_css/style.css?<?php echo time(); ?>">	

</head>
<body onload="document.forms[0].name.focus();">
<div id="wrapper">
<header>
	<h1>ABC Company</h1>
	<img src="_images/under-construction.png" alt="Under Construction">
</header>

<section id="success">
	<h2>Your message was sent successfully!</h2>
	<p><a href="/">Back to homepage</a></p>
</section>

<footer>
	<div id="left">
		<p>ABC Company</p>
	</div>
	<div id="center">
		<p><i class="fa fa-map-marker"></i> 123 Main Street, Yourtown, CO</p>
	</div>
	<div id="right">
		<p><i class="fa fa-phone-square"></i> <a class="tel" tabIndex="-1" href="tel:(303) 555-1234">303.555.1212</a></p>
	</div>

</footer>
</div><!-- #wrapper -->

<script type="text/javascript" src="_scripts/scripts.js?<?php echo time(); ?>"></script>
<script src="http://localhost:35729/livereload.js"></script>	
</body>
</html>