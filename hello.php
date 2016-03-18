<html>
	<head>
		<title>PHP Test</title>
	</head>
<body>
<?php echo '<p>Hello World</p>'; ?> 

<?php phpinfo(); ?>

<h3>
	<?php
	echo $_SERVER['HTTP_USER_AGENT'];
	?>
</h3>

<?php
   foreach ($_SERVER as $key=>$value) 
   {
      echo $key."=".$value;
      echo "<br><br>";
   }
?>
</body>
</html>
