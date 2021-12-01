<?php 

class User_model extends CI_Model {

	// PUT DATA IN DATABASE
	function insertuser($data){
		$this->db->insert('users',$data);
	}

	// CHECK EMAIL AND PASSWORD
	function checkPassword($password,$email){

		// CHECK IF THE EMAIL AND PASSWORD ARE IN THE DATABASE
		// PASS THE RESULT IN $query
		$query = $this->db->query("SELECT * FROM users WHERE password='$password' AND email='$email' AND status='1'");

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