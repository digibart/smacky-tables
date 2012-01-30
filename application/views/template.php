<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php
		
	echo KillerFile::instance('css', 'screen')->add_files(array(
		'/css/screen.css',
		'/css/style.css',
		))->get_tag(array('media' => 'screen'));
	
	?>
	<title><?php echo (isset($title)) ? $title : ""; ?></title>
</head>
<body>
	<div class="container">
		<header class="row">
			<h1 class="center"><?php echo (isset($title)) ? $title : ""; ?></h1>
		</header>
		<div class="row">
			<?php echo isset($content) ? $content : ""; ?>
		</div>
	</div>
	
	<?php
	    echo KillerFile::instance('js')->add_files(array(
    		'/js/libs/jquery-1.7.1.min.js',
    	))->get_tag();
	?>
	
</body>
</html>
