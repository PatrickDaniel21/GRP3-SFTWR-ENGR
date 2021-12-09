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
		$query = $this->db->query("SELECT * FROM users WHERE password='$password' AND email='$email' AND is_email_verified ='yes'");

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

}