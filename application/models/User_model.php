<?php 

class User_model extends CI_Model {

	// PUT DATA IN DATABASE
	function insertuser($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}

	// VERIFICATION KEY
	function verify_email($key){
    	$this->db->where('verification_key', $key);
		$this->db->where('is_email_verified', 'no');
		$query = $this->db->get('users');

		if($query->num_rows () > 0){
			$data = array(
				'is_email_verified' => 'yes'
			);

			$this->db->where('verification_key', $key);
			$this->db->update('users', $data);
			return true;
		}
		else
		{
			return false;
		}
	}

	// CHECK EMAIL AND PASSWORD
	function checkPassword($password,$email){

		// CHECK IF THE EMAIL AND PASSWORD ARE IN THE DATABASE
		// PASS THE RESULT IN $query
		$query = $this->db->query("SELECT * FROM users WHERE password='$password' AND email='$email' AND is_email_verified ='yes' AND status='0'");

		// TRUE IF THE EMAIL AND PASSWORD ARE IN DATABASE
		if($query->num_rows()==1){
			// RETURN THE ROW OF EMAIL AND PASSWORD
			return $query->row();
		}
		// FALSE IF NOT
		else{
			return false;
		}

	}

	// FORGOT PASSWORD
	function checkemail($email){

		// CHECK IF THE EMAIL IS IN THE DATABASE
		// PASS THE RESULT IN $query
		$query = $this->db->query("SELECT * FROM users WHERE email='$email' AND is_email_verified ='yes' AND status='0'");

		// TRUE IF THE EMAIL IS IN DATABASE
		if($query->num_rows()==1){
			// RETURN THE ROW OF EMAIL
			return $query->row();
		}
		// FALSE IF NOT
		else{
			return false;
		}

	}

	// CODE VERIFICATION
	function code_verification($email, $code ){

		$this->db->where('email', $email);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			$data = array(
				'code_verification' => $code
			);

			$this->db->update('users',$data);
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	// FIND THE CODE VERIFICATION
	function find_code($code){

		// CHECK IF THE CODE IS IN THE DATABASE
		// PASS THE RESULT IN $query
		$query = $this->db->query("SELECT * FROM users WHERE code_verification='$code' AND is_email_verified ='yes' AND status='0'");

		// TRUE IF THE CODE IS IN DATABASE
		if($query->num_rows()==1){
			// RETURN THE ROW OF CODE
			return $query->row();
		}
		// FALSE IF NOT
		else{
			return false;
		}

	}

	// RESET THE CODE_VERIFICATION
	function reset_code($email, $username){

		$this->db->where('email', $email);
		$this->db->where('username', $username);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			$data = array(
				'code_verification' => ""
			);

			$this->db->update('users',$data);
		}

	}
}