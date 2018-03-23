<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class User_model extends CI_Model {

	public function get_user($data= array()){

	}

	public function login($data= array()){
		$this->db->select ('*');
		if(isset($data['email'])){
			$this->db->where('email',$data['email']);
		}
		if(isset($data['password']) && $data['password']!=''){
			$this->db->where('password',$data['password']);
		}	
		
		$query = $this->db->get(TBL_CUSTOMER);
		return $query->row_array();
	}

	public function add_user($data= array()){
		if(!empty(array_filter($data))){

			// Inserting in Table
			$this->db->insert(TBL_CUSTOMER, $data);
			if ( $user_id = $this->db->insert_id ()) {
				return $user_id;
			}else{
				return false;
			}
		}
	}

	public function update_user($url=''){

	}
}