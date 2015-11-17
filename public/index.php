<?php
require __DIR__.'/../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() {
	echo 'Hello Raspberry!<br><br>';
	echo '<a href="/cam">Take a pic with the webcam here.</a><br>';

/*
	if(class_exists('Plivo\Response')) {
		echo 'Loaded Plivo';
	}
*/
	echo '<form method="post" action="/send_message"><input type="submit" name="send_text" value="Sent Text"></form>';

});

$app->get('/cam', function() {
	$result = exec("sudo python /home/pi/webcam.py");
	echo "Picture Saved.";
});

$app->post('/send_message', function() {
	
	$p = new Plivo\RestAPI(PLIVO_AUTH_ID, PLIVO_AUTH_TOKEN);

    // Set message parameters
    $params = array(
        'src' => '16623671113', // Sender's phone number with country code
        'dst' => '13603069502', // Receiver's phone number with country code
        'text' => 'Hi, Message from Plivo', // Your SMS text message
        'url' => 'http://autobaron.noip.me/report', // The URL to which with the status of the message is sent
        'method' => 'POST' // The method used to call the url
    );
    // Send message
    $response = $p->send_message($params);

    // Print the response
    echo "Response : ";
    print_r ($response['response']);

    // Print the Api ID
    echo "<br> Api ID : {$response['response']['api_id']} <br>";

    // Print the Message UUID
    echo "Message UUID : {$response['response']['message_uuid'][0]} <br>";	
    
});

// plivo callback
$app->get('/report', function() {
	// do something
});

$app->run();
 ?>
