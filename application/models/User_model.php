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

			$this->db->where('email', $email);
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
			
			$this->db->where('email', $email);
			$this->db->update('users',$data);
		}

	}

	public function changepassvalue($password, $id){

		$this->db->where('id', $id);
		$query = $this->db->get('users');

		if($query->num_rows() == 1){
			$data = array(
				'password'=> $password,
			);
			
			$this->db->where('id', $id);
			$this->db->update('users',$data);

			return true;

		}else{
			return false;
		}
	}

	//EDIT PROFILE
	public function allusers(){

		$id = $this->session->userdata('id');
		$this->db->select(['users.id', 'users.image', 'users.username', 'users.email', 'posts.post']);
		$this->db->from("users");
		$this->db->join("posts", "posts.id = users.id", "left");
		$this->db->where("users.id !=", $id);
		$this->db->order_by("users.id", "DESC");
		$users = $this->db->get();
		return $users->result();

	}

	public function allusers1(){
		
		$id = $this->session->userdata('id');
		$this->db->select(['users.id', 'users.image', 'users.username', 'users.email', 'posts.post', 'posts.status1', 'posts.status_post', 'posts.post_id', 'posts.report', 'posts.feedback']);
		$this->db->from("users");
		$this->db->join("posts", "posts.id = users.id");
		$this->db->where("users.id !=", $id);
		$this->db->order_by("posts.published_date", "DESC");
		$users = $this->db->get();
		return $users->result();
	}

	public function chkPersonalInfo($id){
		$query = $this->db->query("SELECT * FROM users WHERE id='$id'");

		// TRUE IF THE EMAIL AND PASSWORD ARE IN DATABASE
		if($query->num_rows()==1){
			// RETURN THE ROW OF EMAIL AND PASSWORD
			return $query->row();
		}
	}

	// SAVE POST TO DATABASE
	public function savePosts($data){
		return $this->db->insert('posts', $data);
 	}

	// FETCH POST IN DATABASE
	public function getUserPosts (){
		$this->db->select('*');
		$this->db->from("users");
		$this->db->join("posts", "users.id = posts.id");
		$this->db->order_by("posts.published_date", "DESC");
		return $this->db->get();
	}
	
	public function insert_image($id, $image){

		$this->db->where('id', $id);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			$data = array(
				'image'=>$image,
			);
			
			$this->db->where('id', $id);
			$this->db->update('users',$data);

			return true;
		}
	}

	public function getimage($id){
		$query = $this->db->query("SELECT * FROM users WHERE id='$id'");

		// TRUE IF THE EMAIL IS IN DATABASE
		if($query->num_rows()==1){
			// RETURN THE ROW OF EMAIL
			return $query->row();
		}
	}

	public function getUser(){
		$this->db->select('*');
		$this->db->from("posts");
		$this->db->join("users", "users.id = posts.id");
		$this->db->join("orgs", "orgs.orgadmin_id = users.id", "left");
		$this->db->order_by("posts.published_date", "DESC");
		return $this->db->get();
	}

	public function cusername($username, $id){

		$this->db->where('id', $id);
		$query = $this->db->get('users');

		if($query->num_rows() > 0){
			$data = array(
				'username'=> $username,
			);
			
			$this->db->where('id', $id);
			$this->db->update('users',$data);

			return true;
		}
	}

	public function cpass($password, $newpassword2, $id){

		$this->db->where('id', $id);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if($query->num_rows() == 1){
			$data = array(
				'password'=> $newpassword2,
			);
			
			$this->db->where('id', $id);
			$this->db->update('users',$data);

			return true;

		}else{
			return false;
		}
	}


	// ORGANIZATION
	function registerNow($data){
		$this->db->insert('orgs',$data);
		return $this->db->insert_id();
	}



	// FETCH POST IN DATABASE
	public function getOrgsPosts (){
		$this->db->select('*');
		$this->db->from("orgs");
		$this->db->join("orgs_posts", "orgs_posts.orgpadmin_id = orgs.orgadmin_id");
		$this->db->order_by("orgs_posts.org_published_date", "DESC");
		return $this->db->get();
	}





}