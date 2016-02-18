<?php
// ========================================================================
//
// MAIN Server to process POST requests
//
// Define a server to handle ajax requests with sepcific actions.
if (is_ajax()) {

	if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists

		$action = $_POST["action"];   // Get the action requested, make these up as needed

		switch ($action) {
			case "getPlaylist":
				do_getPlaylist ();
				break;
			
			case "play" :
				do_play ();
				break;
				
			case "pause" :
				do_pause ();
				break;
				
			case "next" :
				do_next ();
				break;
				
			case "last" :
				do_last ();
				break;
			
			default :
				is_error ( "Error 101: Invalid Command." );
				break;
		}
	}
}

// Function to check if the request is an AJAX request
//
function is_ajax() {

	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


function is_error( $error_msg ) {

	$response = $_POST;

	$response["error"] = $error_msg;

	$response["json"] = json_encode($response);
	echo json_encode($response);
}


 function do_getPlaylist() {
	$request = $_POST;
	$response = [];
	
	$dir = "media";
	$playlist = array();
	$mediadir = scandir($dir);
 	foreach ($mediadir as $key => $value) { 
		if (!in_array($value, array(".",".."))) { 
	        if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) { 
	            $playlist[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value); 
	        } 
	        else{ 
	        	//Return the name only, no extention
	        	$info = pathinfo($value);
	            $playlist[] = $info['filename']; 
	        } 
		} 
   	}
   
	$response['playlist'] = $playlist;
	// echo the response JSON back to stdout where the reciever can access and work with it.
	echo json_encode ( $response );
}

 function do_play() {
	// Here is the actual worker function, this is where you do your server sode processing and
	// then generate a json data packet to return.
	$request = $_POST;
	
	// Here is what we will send back (echo) to the person that called us.
	// fill this dictionary with attribute => value pairs, then
	// encode as a JSON string, then
	// echo back to caller
	$response = [ ];
	
	// As we are debugging, mirror the entire original request so we can be sure
	// that we are getting back what we asked for.
	// Turn this off when we release
	//
	if ($debug) {
		$response = $request;
	}
	
	// Do what you need to do with the info. The following are some examples.
	// This is the real set of actual things we use
	$response ["favorite_beverage"] = $request ["favorite_beverage"];
	if ($request ["favorite_beverage"] == "") {
		$response ["favorite_beverage"] = "Coke";
	}
	$response ["favorite_restaurant"] = "McDonald's";
	
	// Another debug aid.
	// Take the entire response, encode as a single JSON string, then
	// add that string to an attribute of the response.
	// This enables us to look at the actual JSON being sent to us as JSON, before
	// its turned into something else.
	//
	// It also doubles the size of the return data
	//
	if ($debug) {
		$response ["json"] = json_encode ( $response );
	}
	
	// echo the response JSON back to stdout where the reciever can access and work with it.
	echo json_encode ( $response );
}

 function do_pause() {
	$request = $_POST;

	$response = [ ];

	if ($debug) {
		$response = $request;
	}

	if ($debug) {
		$response ["json"] = json_encode ( $response );
	}

	// echo the response JSON back to stdout where the reciever can access and work with it.
	echo json_encode ( $response );
}

 function do_next() {
	$request = $_POST;

	$response = [ ];

	if ($debug) {
		$response = $request;
	}

	if ($debug) {
		$response ["json"] = json_encode ( $response );
	}

	// echo the response JSON back to stdout where the reciever can access and work with it.
	echo json_encode ( $response );
}


 function do_last() {
	$request = $_POST;

	$response = [ ];

	if ($debug) {
		$response = $request;
	}

	if ($debug) {
		$response ["json"] = json_encode ( $response );
	}

	// echo the response JSON back to stdout where the reciever can access and work with it.
	echo json_encode ( $response );
}
?>