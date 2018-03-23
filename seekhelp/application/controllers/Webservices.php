<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservices extends CI_Controller {

	function __construct( ) {
		// if i remove this parent::__construct(); the error is gone
		parent::__construct ( );
		$this->load->library ( 'session' );
		$this->load->helper ( 'url' );
		$this->load->helper ( 'language' );
		$this->load->helper ( 'custom' );
		/*$this->load->model ( 'auth_model' );*/
		$this->load->model ( 'Webservice_model' );
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function register_user(){
		$postData = $this->input->post ();
		echo $this->auth_model->registerUser( $postData );
	}


	function getUser($id){
		$id = 1;
		print_r($this->Webservice_model->getUserData($id));		
		//echo $this->auth_model->registerUser( $postData );
	}

}
