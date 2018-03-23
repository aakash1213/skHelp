<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class User_model extends CI_Model {

	function __construct ( ) {
		parent::__construct ( );
		$this->load->database ( );
	}

	/* Check email id is exist or not */
	function is_email_exist ( $email, $user_id = '') {
		$this->db->select ( 'user_id, name' );
		if ($user_id != '')
			$this->db->where ( 'user_id != ', $user_id );
		
		$this->db->where ( 'LOWER(email_id)', strtolower($email) );

		$query = $this->db->get ( TBL_USERS );
		if ($query->num_rows ( ) > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function registerUser($data){

		//pre($data);
		if(!$this->is_email_exist($data['email_id']) ){ // add new user loged in manually
			$name = is_valid_val ( $data, 'name', TRUE );
			$email_id = is_valid_val ( $data, 'email_id', TRUE );
			$contact_number = $data['contact_number'];
			$username = is_valid_val ( $data, 'username', TRUE );
			$password = is_valid_val ( $data, 'password', TRUE );

			$this->is_user_mobile_exist($contact_number);
			
			//$verify_code = get_random_key();

			$this->db->set ( 'ur_name', $name);
			$this->db->set ( 'ur_emailId', $email_id);
			$this->db->set ( 'ur_contactNumber', $contact_number);
			$this->db->set ( 'ur_username',$username);
			$this->db->set ( 'ur_password', md5($password));
			$this->db->set ( 'ur_verifyCode', $verify_code);
			$this->db->set ( 'ur_status','1');
			$this->db->set ( 'ur_delFlg','0');
			$this->db->set ( 'ur_createDate',date('Y-m-d H:i:s'));
			$this->db->set ( 'ur_updateDate',date('Y-m-d H:i:s'));
			
					
			$this->db->insert ( TBL_USERS );
			
			if ( $user_id = $this->db->insert_id ()) {
				$mail_data['full_name'] = $data['full_name'];
				$mail_data['email'] = $data['email'];
				$mail_data['password'] = $verify_code;
				send_mail ( CUSTOMER_REGISTRATION, $data ['email'], $mail_data );
				$data1['user_id']=$user_id;
				$data1['role_id']=1;

				if ($user_id = $this->is_email_exist_return_user_id ( $data['email'] ))
				{

					if ( $device_id = is_valid_val($data, 'device_id'))
					{
						if(!isset($data['device_type']) && empty ($data['device_type']))
						{
							$data['device_type']=2;
						}
						$this->common->store_logged_in_device( $user_id, $device_id, is_valid_val($data, 'device_type') );
					}
					
				}

				return $this->get_user_profile($data);

				/* return $this->get_user_profile($data1); */
			}else{
				return get_json ( 'reg_error',RES_ERROR );
			}

		}		

	}
}