<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	function __construct( ) {
		// if i remove this parent::__construct(); the error is gone
		parent::__construct ( );
		$this->load->model('user_model');
	}

	/**
	 * Index Page for this controller.
	 **/
	public function index()
	{
		$this->load->view('index');
	}

	/**
	 * login Page for this controller.
	 **/
	public function login(){
		if(isset($_POST['email']) && $_POST['email']!=''){

			$insert_data['email']=$_POST['email'];
			$insert_data['password']=md5($_POST['password']);

			$result	=	$this->user_model->login($insert_data);
			if(!empty($result)){
				echo 'you are logged in!';exit();
			}else{
				$this->load->view('login');
			}
			
		}else{
			$this->load->view('login');
		}		
	}

	/**
	 * register Page for this controller.
	 **/
	public function register()
	{
		if(isset($_POST['email']) && $_POST['email']!=''){
			
			if(isset($_POST['chkTerms']) && $_POST['password']!='' && $_POST['password']==$_POST['c_password']){
				$insert_data=array();
				$insert_data['email']=$_POST['email'];
				$insert_data['password']=md5($_POST['password']);
				$insert_data['fname']=$_POST['fname'];
				$insert_data['lname']=$_POST['lname'];
				$insert_data['company']=$_POST['company'];
				$insert_data['phone']=$_POST['phone'];
				$insert_data['address']=$_POST['address'];
				$insert_data['city']=$_POST['city'];
				$insert_data['state']=$_POST['state'];
				$insert_data['zipcode']=$_POST['zipcode'];
				$insert_data['country']=$_POST['country'];
				
				$result	=	$this->user_model->add_user($insert_data);
				
				echo '<pre>';print_r($insert_data);exit();
			}
			
		}else{
			$this->load->view('register');
		}	
		
	}

	/**
	 * review_transfer Page for this controller.
	 **/
	public function review_transfer()
	{
		$this->load->view('assets/review_transfer');
	}

	/**
	 * register Page for this controller.
	 **/
	public function contact()
	{
		$this->load->view('assets/contact');
	}

}
