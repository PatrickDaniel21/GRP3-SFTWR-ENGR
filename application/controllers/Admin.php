<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
		$this->load->database();

        if(!$this->session->userdata('id'))
            return redirect('welcome');
    }
   public function index(){
        $id = $this->session->userdata('id');

        /*To check if personal information is saved or not*/
        $user['data'] = $this->user_model->allusers1();  
        $this->load->view('admin_dashboard', $user);
   }

   public function organization(){ 
        $user['data'] = $this->user_model->allorgs();
        $this->load->view('organization_dashboard', $user);
   }

   public function editprofileadmin(){
    $this->load->view('editprofileadmin');                
   }

   public function changeusername(){

        if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('username','Username','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
				// TRANSFER INPUT NAME VALUE IN VARIABLES
                $id = $this->session->userdata('id');
				$username    = $this->input->post('username');

                $status = $this->user_model->cusername($username, $id);

                if($status){
                    redirect(base_url('admin/validation'));
                }else{
                    redirect(base_url('admin/validation1'));    
                }
			}
		}
    }

    public function changepass(){

        if($_SERVER['REQUEST_METHOD']=='POST')
		{	
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('newpassword1','Password','required');
            $this->form_validation->set_rules('newpassword2','Password','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
                if($this->input->post('newpassword1') === $this->input->post('newpassword2')){

                    $id = $this->session->userdata('id');
                    $password = sha1($this->input->post('password'));
                    $newpassword2 = sha1($this->input->post('newpassword2'));

                    $status = $this->user_model->cpass($password, $newpassword2, $id);

                    if($status){
                        redirect(base_url('admin/valid'));
                    }else{
                        redirect(base_url('admin/error1'));      
                    }
                }else{
                    redirect(base_url('admin/error'));   
                }

                
			}
		}
    }

    public function insertimage(){

        $config=[
            'upload_path'   =>'./upload/',
            'allowed_types' =>'jpg|png|gif',
        ];
        
        $this->load->library('upload', $config);

        if($this->upload->do_upload('image')){
            $img=$this->upload->data();
            $image= $img['raw_name'].$img['file_ext'];
            $id = $this->session->userdata('id');

            if($this->user_model->insert_image($id, $image)){
                redirect(base_url('admin/validimage'));
            }else{
                redirect(base_url('admin/notvalidimage'));
            }
        }
    }

    public function pending($user_id, $post_id){
        
        if($this->user_model->pending($user_id, $post_id)){  
            return redirect("admin");
        }
    }

    public function report($user_id, $post_id){
        
        if($this->user_model->report($user_id, $post_id)){  
            redirect(base_url('admin'));
        }
        else{
        }
    }
    function validation(){
		$this->editprofileadmin();
	}
    function validimage(){
		$this->editprofileadmin();
	}
    function notvalidimage(){
		$this->editprofileadmin();
	}
    function validation1(){
		$this->editprofileadmin();
	}
    function error(){
		$this->editprofileadmin();
	}
    function error1(){
		$this->editprofileadmin();
	}
    function valid(){
		$this->editprofileadmin();
	}

    public function orgpending($org_id, $orgadmin_id){
        
        if($this->user_model->orgpending($org_id, $orgadmin_id)){  
            return redirect("admin/organization");
        }
    }

    public function orgreport($org_id, $orgadmin_id){
        
        if($this->user_model->orgreport($org_id, $orgadmin_id)){  
            return redirect("admin/organization");
        }
    }

    public function admincontrol(){
        $orgsPosts['data'] = $this->user_model->getOrgsPosts(); 
        $this->load->view('admin_control', $orgsPosts);
    }

    public function orgpost(){

        $this->form_validation->set_rules('post','Post','required');
		$this->form_validation->set_rules('status1','Status','required');

        if($this->form_validation->run()==TRUE)
		{

            $orgpadmin_id = $this->session->userdata('id');
            $org_post = $this->input->post('post');
            $org_published_date = $this->input->post('published_date');
            $org_status = $this->input->post('status1');
                        
            // PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
            $data = array(
                'orgpadmin_id'		   => $orgpadmin_id,
                'org_post'			   => $org_post,
                'org_published_date'   => $org_published_date,
                'org_status'           => $org_status
            );

            if($this->user_model->saveorgsPosts($data)){ 
                return redirect('admin/admincontrol');
            }
        }else{
            $this->admincontrol();
        }
    }


}