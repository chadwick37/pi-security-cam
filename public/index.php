<?php
require __DIR__.'/../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() {
	echo 'Hello Raspberry!<br><br>';
	echo '<a href="/cam">Take a pic with the webcam here.</a>';

	if(class_exists('Plivo\Response')) {
		echo 'Loaded Plivo';
	}
});

$app->get('/cam', function() {
	$result = exec("sudo python /home/pi/webcam.py");
	echo "Picture Saved.";
});

$app->run();
 ?>
