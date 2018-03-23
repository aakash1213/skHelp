<?php

function get_user_lang( ){

	if ( !$lang = get_instance()->session->userdata('user_language') )

		return  'en';

	else 

		return $lang;

}	

/**

 * 

 * @param $devices = common->get_device_ids();

 * @param unknown $message  */

function send_mobile_notification( $devices, $extra_fields = array() ){

	if (isset($devices['android_device_ids']) && !empty($devices['android_device_ids'])){

		send_gcm_notify( $devices['android_device_ids'], $extra_fields );

	}



	if (isset($devices['ios_device_ids']) && !empty($devices['ios_device_ids'])){


		send_IOS_notify( $devices['ios_device_ids'], $extra_fields);

	}

}



function send_gcm_notify( $registatoin_ids, $extra_fields = array() ) {



	// Set POST variables

	$url = GOOGLE_GCM_URL;



	if(array_key_exists('type',$extra_fields)){

		$data = array(

			'registration_ids' => $registatoin_ids,

			'data' => array("message"=> $extra_fields['message'],"from_id"=>$extra_fields['from'] ,"job_id" => $extra_fields['job_id'],"badge" => $extra_fields['badge_count'],"bell_count" =>$extra_fields['bell_count'],"new_count" =>$extra_fields['new_count'],"to_id" => $extra_fields['to_id'],"type"=> $extra_fields['type']),

		);} else {



			$data = array(

				'registration_ids' => $registatoin_ids,

				'data' => array("message"=> $extra_fields['message'],"job_id" => $extra_fields['job_id'],"badge" => $extra_fields['badge_count'],"bell_count" =>$extra_fields['bell_count'],"new_count" =>$extra_fields['new_count'],"to_id" => $extra_fields['to_id']),

			);



		}



		$fields = array_merge( $data, $extra_fields );



		$headers = array(

			'Authorization: key=' . GOOGLE_API_KEY,

			'Content-Type: application/json'

		);

	// Open connection

		$ch = curl_init();



	// Set the url, number of POST vars, POST data

		curl_setopt($ch, CURLOPT_URL, $url);



		curl_setopt($ch, CURLOPT_POST, true);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



	// Disabling SSL Certificate support temporarly

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));



	// Execute post

		$result = curl_exec($ch);



	// Close connection

		curl_close($ch);

		$decode = json_decode( $result );

		$cnt = $decode->success;

		if ($cnt<=0) {

		//die('Curl failed: ' . curl_error($ch));

			return false;

		}

		else return true;

	}



/* $extra_fields['message'] = 'Test Message';

$extra_fields['type'] = 'test_type';

send_IOS_notify('1923689849c58568779d73d38012a1654945a3ef3b39567050212fc28426c20f', $extra_fields); */



function send_IOS_notify( $deviceToken, $extra_fields = array() ){

	

	/* $extra_fields['badge'] = 10;

	pr($extra_fields);

	$deviceToken = '1923689849c58568779d73d38012a1654945a3ef3b39567050212fc28426c20f'; */

	

	$result = FALSE;

	$passphrase='';

	$ctx = stream_context_create();

	//stream_context_set_option($ctx, 'ssl', 'local_cert', 'maharah_dev.pem'); //TEST
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'maharah.pem'); //LIVE


	



	



	//echo 'Connected to APNS' . PHP_EOL;

	if(array_key_exists('type',$extra_fields)){

		$data = array(

			'alert' => $extra_fields['message'],

			'sound' => 'default'

			,"job_id" => $extra_fields['job_id']

			,"badge" => $extra_fields['badge_count']

			,"type" => $extra_fields['type']

			,"to_id" => $extra_fields['to_id']

				//'count' => '25',

				//'badge' => 25

		);

	} else{

		$data = array(

			'alert' => $extra_fields['message'],

			'sound' => 'default'

			,"job_id" => $extra_fields['job_id']

			,"badge" => $extra_fields['badge_count']

			,"to_id" => $extra_fields['to_id']

				//'count' => '25',

				//'badge' => 25

		);

		//$send ['type'] = 'job added by user';

	}

	

	$body['aps'] = array_merge($data, $extra_fields );



	//echo '<pre>'; print_r($body);

	$payload = json_encode($body);



	/*  Used for sending messages on multiple devices at a time	*/

	if (is_string($deviceToken)){

		$deviceToken = array($deviceToken);

	}



	if (count($deviceToken) > 0){

		foreach ( $deviceToken as $token){
			$fp = stream_socket_client(

				'ssl://gateway.push.apple.com:2195', $err,

				$errstr, 600, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

			$msg = chr((0)) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;

			

			$result = fwrite($fp, $msg, strlen($msg));			
			fclose($fp);

		}

	}

	
	

	if (!$result)

		return  "0";

	else

		return "1";

}



function is_json( $string ){

	if(is_object(json_decode($string)))

		return TRUE;

}

/**

 * Used in pagination

 * Just use this function where need to use pagination

 * @param pagination count  $pagination_count  */

function get_limit( $pagination_count = PAGINATION_COUNT){

	$page = '';

	if (isset($_GET['page']) && $_GET['page'] != '')

		$page = $_GET['page'];

	elseif ( isset($_POST['page']) && $_POST['page'] != '')

		$page = $_POST['page'];

	

	if ($page !== ''){

		$page = $page - 1;

		get_instance()->db->limit($pagination_count, $page*$pagination_count);

	}

	else

		get_instance()->db->limit($pagination_count, 0);

}



/* Store post params with IP address */

function save_log( ) {

	//$fileName = BASE_DIR . 'log/' ."log.txt"; /* date ( 'Ymd' ) . */ 

	$fileName = BASE_DIR . 'log/' .date ( 'Ymd' ) .".txt";

	$dataStore = date ( 'Y-m-d H:i:s' ) . ' ->' . $_SERVER ['REMOTE_ADDR'] . '->' . basename ( $_SERVER ['REQUEST_URI'], '/' ) . PHP_EOL . json_encode ( $_POST ).json_encode ( $_FILES ) . PHP_EOL . PHP_EOL;

	file_put_contents ( $fileName, $dataStore, FILE_APPEND ); // Store log

}



/**

 * print well formatted arary

 */

function pr( $data ) {

	echo '<pre>';

	print_r ( $data );

	echo '</pre>';

}



/**

 * print well formatted arary and stop execution

 */

function pre( $data ) {

	echo '<pre>';

	print_r ( $data );

	echo '</pre>';

	exit ( );

}



/**

 * Check is valid and not empty $index value from $data

 * @ Array of value (OR it can be normal variable)

 * @ Index of array

 * If $mandatory is true and not valid value Then exit execution with compulsory field prompt

 *

 * @Returns value of index from array if exist else returns FALSE

 */

function is_valid_val( $data, $index, $mandatory = false ) {

	if ( is_array ( $data ) && isset ( $data [$index] ) && $data [$index] !== '' )

		return $data [$index];

	else {

		if ( ! is_array ( $data ) && $data !== '' ) // If normal valid variable, return its value

		return $data;

		if ( $mandatory ) { // If mandatory, print mandatory message and stop execution

			echo get_json ( sprintf ( lang ( 'field_is_mandatory' ), $index ), 'Error', false );

			exit ( );

		} else

		return;

	}

}



/**

 * @$data can contain array of data or text

 * @Default index of output is 'Success',

 * @By default $data value(If $data is not array and $lang==true) will take from lang variable

 *

 * @Returns data in json format

 * 	{"Error":{"data":"No result found","alert":"Test alert"}} 

 *	{"Success":{"data":["a","b","c"],"alert":"Test alert"}}

 */

function get_json( $data, $type = RES_SUCCESS, $lang = true ) {

	$res = array ();

	if ( ! empty ( $data ) ) {

		if ( ! is_array ( $data ) && $lang ) {

			if ( strpos ( $data, 'error' ) !== FALSE ) // if $data contain any variable like ...._error, Then make $type = "Error"

			$type = RES_ERROR;

			 $data =  get_instance()->lang->line ( $data ); // If $data is not array and $lang==true then take $data value from language variable

			}

			$res [$type] = $data;

		} else {

			$res [RES_ERROR] = lang ( 'no_result_found' );

		}



		/*	Temp, for getting well formated array in website output	*/

		if ( isset ( $_POST ['website_output'] ) && $_POST ['website_output'] == 1 ) {

			echo json_encode ( $res ) . PHP_EOL . PHP_EOL;

			pr ( $res );

			echo PHP_EOL.PHP_EOL.'Web Service output for app--'.PHP_EOL.PHP_EOL;

			return json_encode ( $res );

		} else/*  */{

		if ( isset ( $_POST['webservice'] ) &&  $_POST['webservice'] == 1 ){		// Declared in webservice controller

			unset( $_POST['webservice']  );

			if (!empty($_POST))	

				header ( 'Content-type: application/json' );/*  This if condition is temp	*/

		}

		/* Remove above if condition on live sever */

		return json_encode ( $res );

	}

}



/**

 * @Create folder with path provide if folder not exist

 * @Folder permission code

 */

function createFolder( $path, $permission = '0777' ) {

	if ( ! is_dir ( $path ) )

		mkdir ( $path, $permission, true );

}



/**

 *

 * @return current date or given date as per format specified

 */

function get_db_date( $date = '', $format = DATE_YMD_HIS ) {

	if ( $date == '' )

		$date = date ( $format );

	return date ( $format, strtotime ( $date ) );

}



/* Get date in user readable format */

function get_user_date( $date = '', $format = DATE_YMD_HIS ) {

	if ( $date == '' )

		$date = date ( $format );

	return date ( $format, strtotime ( $date ) );

}



/**

 *

 * @return current time or given time as per format specified

 */

function get_db_time( $time = '', $format = TIME_HIS ) {

	if ( $time == '' )

		$time = date ( $time );

	return date ( $format, strtotime ( $time ) );

}



/* Get time in user readable format */

function get_user_time( $time = '', $format = TIME_HIS ) {

	if ( $time == '' )

		$time = date ( $time );

	return date ( $format, strtotime ( $time ) );

}



/**

 * Send email message of given type (activate, forgot_password, etc.)

 *

 * @param

 *        	string

 * @param

 *        	string

 * @param

 *        	array

 *        	Here use $type for heading, file name and data

 *        	like heading -> ..._heading

 *        	data -> ..._data

 *        	filename-> ...-html.php

 * @return void

 */



function send_mail( $type, $email, $data ) {


	/*

	 * $this->load->library('email'); $this->email->from('your@example.com', 'Your Name'); $this->email->to('amol@iarianatech.com'); $this->email->subject('Email Test'); $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE)); return $this->email->send();

	 */

	


	$full_name = 'no_reply';

	$from_mail = $full_name . '<' .EMAIL_ID_MAHARAH. '>';
	
	//$from_mail = $full_name . 'pooja.chikne@iarianatech.com';
	$header = "Reply-To:" . $from_mail . "\r\n";
	
	$header .= "MIME-Version: 1.0\r\n";

	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";

	$header .= 'Cc: '.EMAIL_ID_TESTER . "\r\n";

	

	

	$data ['heading'] = $data ['file_name'] = $type;

	$mailData ['data'] = $data;

	

	/*if ( isset ( $_POST ['website_output'] ) && $_POST ['website_output'] == 1 ) {
		echo "website";
		//get_instance ( )->load->view ( 'email/send_mail.php', $mailData );

		//exit ( );

	}*/

	if($_SERVER['HTTP_HOST'] != 'localhost'){
		
		$message = get_instance()->load->view ( 'email/send_mail.php' , $mailData, TRUE );

		
		return mail( $email, lang ( 'email_subject_' . $type ),$message,$header, "-f $from_mail" );
		
	}

	return TRUE;

}

function send_invoice_mail( $type, $email, $data ) {
	/*
	
	* $this->load->library('email'); $this->email->from('your@example.com', 'Your Name'); $this->email->to('amol@iarianatech.com'); $this->email->subject('Email Test'); $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE)); return $this->email->send();
	
	*/
	
	
	
	
	$full_name = 'no_reply';
	
	$from_mail = $full_name . '<' .EMAIL_ID_MAHARAH. '>';
	
	//$from_mail = $full_name . 'pooja.chikne@iarianatech.com';
	$header = "Reply-To:" . $from_mail . "\r\n";
	
	$header .= "MIME-Version: 1.0\r\n";
	
	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
	$header .= 'Cc: '.EMAIL_ID_TESTER . "\r\n";
	
	
	
	
	
	$data ['heading'] = $data ['file_name'] = $type;
	
	$mailData ['data'] = $data;
	
	
	
	/*if ( isset ( $_POST ['website_output'] ) && $_POST ['website_output'] == 1 ) {
	 echo "website";
	 //get_instance ( )->load->view ( 'email/send_mail.php', $mailData );
	
	 //exit ( );
	
	}*/
	
	if($_SERVER['HTTP_HOST'] != 'localhost'){

		$message = get_instance()->load->view ( 'email/send_mail.php' , $mailData, TRUE );


		return mail( $email, lang ( 'email_subject_' . $type ),$message,  $from_mail );

	}
	
	return TRUE;
	

}

/* Get date in human readable format upto a day */



function get_human_time( $time ) {

	$time = strtotime ( $time );

	$time = time ( ) - $time; // to get the time since that moment

	

	$tokens = array (

		31536000 => 'year',

		2592000 => 'month',

		604800 => 'week',

		86400 => 'day',

		3600 => 'hour',

		60 => 'minute',

		1 => 'second' );

	

	foreach ( $tokens as $unit => $text ) {

		if ( $time + 1 < $unit )

			continue;

		//if ( $unit > 86400 ){

		$numberOfUnits = floor ( $time / $unit );

		return $numberOfUnits . ' ' . $text . ( ( $numberOfUnits > 1 ) ? 's ' : ' ' );

		//}else return 'Today';

	}



}

function get_random_key( $md5 = FALSE ){

	$key = rand ( '1111', '9999' );

	if ( $md5)

		$key = md5( $key );

	return $key;

}



function uploadImage($index,$file, $field_name, $path, $imgName = '', $extension = false, $resize = false, $width = 500, $height = 400) {

	if (isset ( $file[$field_name] ) && ! empty ( $file[$field_name] )) {

		$file = $file[$field_name];

		if ($imgName == '')

			$imgName = time () . rand(100, 1000) . '.' . pathinfo ( $file['name'][$index], PATHINFO_EXTENSION );

		$destination_base = BASE_DIR . $path;

		$destination = $destination_base . $imgName;

		if (move_uploaded_file ( $file['tmp_name'][$index], $destination )) {

			if ($resize)

				resize_image ( $destination, $destination, $width, $height);

			

			/*  If 'image' is as key name of $_FILES, then create 2 more copies of image	*/

			resize_image($destination, $destination_base . SMALL_FOLDER . $imgName, IMAGE_WIDTH_SMALL, IMAGE_HEIGHT_SMALL);

			resize_image($destination, $destination_base . MEDIUM_FOLDER . $imgName, IMAGE_WIDTH_MEDIUM, IMAGE_HEIGHT_MEDIUM);

			resize_image($destination, $destination_base . LARGE_FOLDER . $imgName, IMAGE_WIDTH_LARGE, IMAGE_HEIGHT_LARGE);



			return $imgName;

		}

	}

}



function uploadUserImage($file, $field_name, $path, $imgName = '', $extension = false, $resize = false, $width = 500, $height = 400) {
	if (isset ( $file[$field_name] ) && ! empty ( $file[$field_name] )) {

		$file = $file[$field_name];

		if ($imgName == '')

			$imgName = time () . rand(100, 1000) . '.' . pathinfo ( $file['name'], PATHINFO_EXTENSION );

		$destination_base = BASE_DIR . $path;

		$destination = $destination_base . $imgName;

		if (move_uploaded_file ( $file['tmp_name'], $destination )) {
			if ($resize)

				resize_image ( $destination, $destination, $width, $height);



			/*  If 'image' is as key name of $_FILES, then create 2 more copies of image	*/

			resize_image($destination, $destination_base . SMALL_FOLDER . $imgName, IMAGE_WIDTH_SMALL, IMAGE_HEIGHT_SMALL);


			return $imgName;

		}

	}

}



function uploadVideo($file, $field_name, $path, $imgName = '', $extension = false, $resize = false, $width = 500, $height = 400) {

	if (isset ( $file[$field_name] ) && ! empty ( $file[$field_name] )) {

		$file = $file[$field_name];

		if ($imgName == '')

			$imgName = time () . rand(100, 1000) . '.' . pathinfo ( $file['name'], PATHINFO_EXTENSION );

		$destination_base = BASE_DIR . $path;

		$destination = $destination_base . $imgName;

		if (move_uploaded_file ( $file['tmp_name'], $destination )) {

			return $imgName;

		}

	}

}

function resize_image($base_file, $new_file, $w, $h, $crop = FALSE) {

	list ( $width, $height ) = getimagesize ( $base_file );

	$r = $width / $height;

	if ($crop) {

		if ($width > $height) {

			$width = ceil ( $width - ($width * abs ( $r - $w / $h )) );

		} else {

			$height = ceil ( $height - ($height * abs ( $r - $w / $h )) );

		}

		$newwidth = $w;

		$newheight = $h;

	} else {

		if ($w / $h > $r) {

			$newwidth = $h * $r;

			$newheight = $h;

		} else {

			$newheight = $w / $r;

			$newwidth = $w;

		}

	}

	

	list($w, $h, $imageType) = getimagesize($base_file);

	$imageType = image_type_to_mime_type($imageType);

	switch($imageType) {

		case "image/gif":

		{

			$src = imagecreatefromgif ( $base_file );

			$dst = imagecreatetruecolor ( $newwidth, $newheight );

			imagecopyresampled ( $dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

			imagegif ( $dst, $new_file );

		}

		break;

		case "image/pjpeg":

		case "image/jpeg":

		case "image/jpg":

		{ 

			$src = imagecreatefromjpeg ( $base_file );

			$dst = imagecreatetruecolor ( $newwidth, $newheight );

			imagecopyresampled ( $dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

			imagejpeg ( $dst, $new_file, IMAGE_QUALITY );

		}			

		break;

		case "image/png":

		case "image/x-png":

		{

			$src = imagecreatefrompng ( $base_file );

			$dst = imagecreatetruecolor ( $newwidth, $newheight );

			imagecopyresampled ( $dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );

			imagepng ( $dst, $new_file, floor(IMAGE_QUALITY/10) );

		}

		break;

	}

}



/*	check user type */

function check_user_type(){

	return get_instance()->session->userdata('user_type');

}



function is_logged_in( $redirect = TRUE, $return_user_id = FALSE ){

	if(get_instance()->session->userdata('user_id')){

		if ($return_user_id)

			return get_instance()->session->userdata('user_id');

		else

			return get_instance()->session->userdata('user_type');

	}elseif ($redirect)

	redirect(base_url(C_LOGIN.'user_login'));

}



function set_after_login_redirect_url(){

	if (isset($_SERVER['ORIG_PATH_INFO']))

		$redirect_url = $_SERVER['ORIG_PATH_INFO'];

	else

		$redirect_url = $_SERVER['PATH_INFO'];

	get_instance()->session->set_userdata( 'login_redirect_url', $redirect_url );

} 



function redirect_using_javascript($url)

{

	if (!headers_sent())

	{

		header('Location: '.$url);

		exit;

	}

	else

	{

		echo '<script type="text/javascript">';

		echo 'window.location.href="'.$url.'";';

		echo '</script>';

		echo '<noscript>';

		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';

		echo '</noscript>'; exit;

	}

}





function send_feedback_mail( $type, $email, $data ) {

  	/*

  	 * $this->load->library('email'); $this->email->from('your@example.com', 'Your Name'); $this->email->to('amol@iarianatech.com'); $this->email->subject('Email Test'); $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE)); return $this->email->send();

  	 */
  	$full_name = 'no_reply';
  	$from_mail = $full_name . '<' . $data['from_user_details']['email']. '>';
  	$header = "Reply-To:" . $from_mail . "\r\n";
  	$header .= "MIME-Version: 1.0\r\n";
  	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
  	$header .= 'Cc: '.EMAIL_ID_TESTER . "\r\n";
  	//$header .= 'Cc: '.'bassamsnake@gmail.com' . "\r\n";
  	$data ['heading'] = $type;
  	$mailData ['data'] = $data;
  	if ( isset ( $_POST ['website_output'] ) && $_POST ['website_output'] == 1 ) {
  		//get_instance ( )->load->view ( 'email/send_mail.php', $mailData );
  		//exit ( );
  	}
  	if($_SERVER['HTTP_HOST'] != 'localhost'){

  		$message = get_instance()->load->view ( 'email/send_feedback_mail.php' , $mailData, TRUE );
  		$data= mail ( $email, $type,$message, $header, "-f $from_mail" );

  	}
        //pre($mailData);
  	$data = get_instance()->auth->add_mail($email,$from_mail,$message,$maildata,$data);

  	return TRUE;

  }

  

  function send_mail_notification( $type,$jobtitle, $to, $from ) {

  	/*

  	 * $this->load->library('email'); $this->email->from('your@example.com', 'Your Name'); $this->email->to('amol@iarianatech.com'); $this->email->subject('Email Test'); $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE)); return $this->email->send();

  	 */

  /* 	pr($type);

  pr($to);

  pr($from); */

  

  $data['from_user_id'] = $from['user_id'];

  $data['from_name'] = $from['full_name'];

  $data['from_email'] = $from['email'];

  $data['jobtitle'] = $jobtitle;

  $data['to_user_id'] = $to['user_id'];

  $data['to_name'] = $to['full_name'];

  $data['to_email'] = $to['email'];

  

  //pre( $data);

  $full_name = 'no_reply';

  $from_mail = $full_name . '<' . EMAIL_ID_MAHARAH. '>';

  

  $header = "Reply-To:" . $from_mail . "\r\n";

  $header .= "MIME-Version: 1.0\r\n";

  $header .= "Content-type: text/html; charset=iso-8859-1\r\n";

  $header .= 'Cc: '.EMAIL_ID_TESTER . "\r\n";

  	//$header .= 'Cc: '.'bassamsnake@gmail.com' . "\r\n";

  

  $data ['heading'] = $data ['file_name'] = $type;

  $mailData ['data'] = $data;

  

  if ( isset ( $_POST ['website_output'] ) && $_POST ['website_output'] == 1 ) {

  		//get_instance ( )->load->view ( 'email/send_mail.php', $mailData );

  		//exit ( );

  }



  	/* $message = get_instance()->load->view ( 'email/send_mail.php' , $mailData, TRUE );

  	echo $message;exit(); */

  	

  	if($_SERVER['HTTP_HOST'] != 'localhost'){

  		$message = get_instance()->load->view ( 'email/send_mail.php' , $mailData, TRUE );

  		//echo $message;exit();

  		return mail ( $data['to_email'], lang ( 'email_subject_' . $type ),$message, $header, "-f $from_mail" );

  	}

  	return TRUE;

  }

  

  

  

  ?>
