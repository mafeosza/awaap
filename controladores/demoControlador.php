<?php 
	
	// Include the editor SDK.
	require '../js/wysiwyg/lib/FroalaEditor.php';
	

		// Store the image.
		try {
		  $response = FroalaEditor_Image::upload('../imagenes/');
		  echo stripslashes(json_encode($response));
		}
		catch (Exception $e) {
		  http_response_code(404);
		}

	
	//$funcion = $_GET['a'];
	//call_user_func($funcion);

?>