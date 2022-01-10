<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->model('user_model');

        // if(!$this->session->userdata('id'))
        //     return redirect('welcome');
        if($this->session->userdata('status') == '1')
            return redirect('admin');
    }

   public function index(){
        $id = $this->session->userdata('id');

        /*CHECK IF PERSONAL INFORMATION WAS SAVED*/
        $personalData = $this->user_model->chkPersonalInfo($id); 
        $userPosts['data'] = $this->user_model->getUserPosts(); 
        $this->load->view('user_dashboard', $userPosts);
   }

   public function editprofile(){
    $id = $this->session->userdata('id');

    /*CHECK IF PERSONAL INFORMATION WAS SAVED*/
    //$data['image'] = $this->user_model->getimage($id);
    $userPosts['data'] = $this->user_model->getUser(); 
    $this->load->view('editprofile', $userPosts);                
   }
   
    public function post(){

        if($_SERVER['REQUEST_METHOD']=='POST')
		{
			// MAKE AN ALERTS OR SET ERRORS FOR UNWANTED INPUT
			$this->form_validation->set_rules('status1','Status','required');
			$this->form_validation->set_rules('post','Post','required');

			// VERIFY IF ERRORS ARE NOT OCCUR
			if($this->form_validation->run()==TRUE)
			{
					// TRANSFER INPUT NAME VALUE IN VARIABLES
                    $id = $this->session->userdata('id');
                    $post = $this->input->post('post');
                    $published_date = $this->input->post('published_date');
					$status1 = $this->input->post('status1');
					
					// PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
					$data = array(
						'id'			   => $id,
						'post'			   => $post,
						'published_date'   => $published_date,
						'status_post'		   => 0,
                        'status1'          => $status1,
					);

                    $returndata = $this->user_model->savePosts($data);

                    if($returndata != false){ 
                        return redirect('user');
                    }
			}
			else{
				$this->index();
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
                redirect(base_url('user/validimage'));
            }else{
                redirect(base_url('user/notvalidimage'));
            }
        }
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
                    redirect(base_url('user/validation'));
                }else{
                    redirect(base_url('user/validation1'));    
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
                        redirect(base_url('user/valid'));
                    }else{
                        redirect(base_url('user/error1'));      
                    }
                }else{
                    redirect(base_url('user/error'));   
                }

                
			}
		}
    }

    function validimage(){
		$this->editprofile();
	}
    function notvalidimage(){
		$this->editprofile();
	}
    function validation(){
		$this->editprofile();
	}
    function validation1(){
		$this->editprofile();
	}
    function error(){
		$this->editprofile();
	}
    function error1(){
		$this->editprofile();
	}
    function valid(){
		$this->editprofile();
	}

    public function report($user_id, $post_id){
        if($this->user_model->report($user_id, $post_id)){  
            redirect(base_url('user/reports'));   
        }else{
            redirect(base_url('user/reporterror'));   
        }
    }

    function reports(){
		$this->index();
	}
    function reporterror(){
		$this->index();
	}

    public function feedback($user_id, $post_id){
        $this->form_validation->set_rules('post','Post','required');

		// VERIFY IF ERRORS ARE NOT OCCUR
		if($this->form_validation->run()==TRUE){

            // TRANSFER INPUT NAME VALUE IN VARIABLES
            $post = $this->input->post('post');
            
            // PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
            $data = array(
                'feedback'  => $post
            );

            if($this->user_model->feedback($user_id, $post_id, $data)){  
                redirect(base_url('user/feedbacks'));   
            }else{
                redirect(base_url('user/feedbackerror'));   
            }
        }
    }

    function feedbacks(){
		$this->index();
	}
    function feedbackerror(){
		$this->index();
	}
}