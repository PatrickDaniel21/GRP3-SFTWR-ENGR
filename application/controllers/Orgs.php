<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orgs extends CI_Controller {
   public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
		$this->load->database();

        if(!$this->session->userdata('id'))
            return redirect('welcome');
        if($this->session->userdata('status') == '1')
            return redirect('admin');

    }
   public function index(){
        $orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('orgsreg_dashboard', $orgsreg);
   }

   public function createorg(){
        $this->load->view('createorg');
   }

    public function orgsprof(){
        $orgsPosts['data'] = $this->user_model->getOrgsPosts(); 
        $this->load->view('orgsprof',  $orgsPosts);
   }


   function registerNow(){
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
            $org_verification_key = md5(rand());
            $orgadmin_id = $this->session->userdata('id');

            $org_representative = $this->input->post('org_representative');
			$org_reptupid       = $this->input->post('org_reptupid');
			$org_name           = $this->input->post('org_name');
			$org_president      = $this->input->post('org_president');
            $org_contact       = $this->input->post('org_contact');
			$org_about           = $this->input->post('org_about');

            $data = array(
                'orgadmin_id'                   =>$orgadmin_id,
                'org_name'				        =>$org_name,
                'org_president'			        =>$org_president,
                'org_contact'                   =>$org_contact,
                'org_about'			            =>$org_about,
                'org_representative'			=>$org_representative,
                'org_reptupid'			        =>$org_reptupid,
                'org_status'                    => '0',
                'org_verification_key'          =>$org_verification_key,
            );

            if($this->user_model->registerNow($data)){
                redirect(base_url('user/success'));
            }
            else{
                redirect(base_url('user/failed'));
            }

		}
		
	}

    public function orgsprofile($org_id, $orgadmin_id){      
        redirect(base_url('orgs/orgsprof/'.$org_id.'/'.$orgadmin_id));
    }

    public function orgjoined($org_id){      
        redirect(base_url('orgs/orgjoin/'.$org_id));
    }

    public function orgjoin(){
        $orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('orgjoin', $orgsreg);
    }

	public function email_receivedcontact(){
        $this->load->view('email_receivedcontact');
    }

    public function joinorgs($org_id){

        $orgmember_fullname   = $this->input->post('orgmember_fullname');
		$orgmember_section    = $this->input->post('orgmember_section');
		$orgmember_college    = $this->input->post('orgmember_college');
        $orgmember_id         = $this->session->userdata('id');
        $orgm_id              = $org_id;

		// PUT THE INPUT NAME VALUE IN A DATABASE VARIABLES
		$data = array(
			'orgmember_fullname'			=>$orgmember_fullname,
			'orgmember_section'			    =>$orgmember_section,
			'orgmember_college'				=>$orgmember_college,
            'orgmember_id'			        =>$orgmember_id,
			'orgm_id'				        =>$orgm_id,
		);

        $member = $this->user_model->joinorgs($data);

        if($member != ""){

            $subject = "Join Organization";

			$data1 = array(
				'orgmember_fullname'			=>$orgmember_fullname,
				'orgmember_section'			    =>$orgmember_section,
				'orgmember_college'				=>$orgmember_college,
				'orgmember_id'			        =>$orgmember_id,
				'orgm_id'				        =>$orgm_id,
				'org_name'						=> $this->input->post('org_name')
			);
			$message = $this->load->view('email_joinorg',$data1,true);
			
			

			$config = array(
				'protocol'		=> 'smtp',
				'smtp_host'     => 'ssl://smtp.gmail.com',
				'smtp_port' 	=>  465,
				'smtp_user'     => 'clikitstuff@gmail.com',
				'smtp_pass'		=> 'vtbugatfxorjgyro',
				'smtp_timeout'	=> '60',
				'mailtype' 		=> 'html',
				'charset'		=> 'iso-8859-1',
				'wordwrap'		=> 	TRUE
			);

			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('clikitstuff@gmail.com','Clikit Admin');
			$this->email->to($this->input->post('org_contact'));
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send()){
				redirect(base_url('orgs/email'));
			}
			else{
				redirect(base_url('orgs/failedemail'));
			}


        }
    }

    function email(){
        $this->index();
    }
	function failedemail(){
        $this->index();
    }

    function verify_joined(){
		if($this->uri->segment(3)){
  			$orgmember_id = $this->uri->segment(3); 
            $orgm_id = $this->uri->segment(4); 

		  if($this->user_model->verify_joined($orgmember_id, $orgm_id))
		   {
			  $data['message'] = '1';
		   }
		   else
		   {
			  $data['message'] = '0';
		   }
		   $this->load->view('verify_joined', $data);
		}
	}

	public function contact(){
		$orgsreg['data'] = $this->user_model->getOrgs(); 
        $this->load->view('contact', $orgsreg);
   }

   function sendcontact(){

	$subject = $this->input->post('subject');

	$data1 = array(
		'email'			        		=>$this->input->post('email'),
		'message'				        =>$this->input->post('message'),
		'org_name'						=> $this->input->post('org_name')
	);

	$message = $this->load->view('email_contact',$data1,true);


	$config = array(
		'protocol'		=> 'smtp',
		'smtp_host'     => 'ssl://smtp.gmail.com',
		'smtp_port' 	=>  465,
		'smtp_user'     => 'clikitstuff@gmail.com',
		'smtp_pass'		=> 'vtbugatfxorjgyro',
		'smtp_timeout'	=> '60',
		'mailtype' 		=> 'html',
		'charset'		=> 'iso-8859-1',
		'wordwrap'		=> 	TRUE
	);

	$this->email->initialize($config);
	$this->email->set_newline("\r\n");
	$this->email->from('clikitstuff@gmail.com','Clikit Admin');
	$this->email->to($this->input->post('org_contact'));
	$this->email->subject($subject);
	$this->email->message($message);

	if($this->email->send())
	{
		
		$subject = "Contact Us Update";

		$data1 = array(
			'subject'			        		=>$this->input->post('subject'),
			'message'				        =>$this->input->post('message'),
			'org_name'						=> $this->input->post('org_name')
		);
	
		$message = $this->load->view('email_receivedcontact',$data1,true);

		
		$config = array(
			'protocol'		=> 'smtp',
			'smtp_host'     => 'ssl://smtp.gmail.com',
			'smtp_port' 	=>  465,
			'smtp_user'     => 'clikitstuff@gmail.com',
			'smtp_pass'		=> 'vtbugatfxorjgyro',
			'smtp_timeout'	=> '60',
			'mailtype' 		=> 'html',
			'charset'		=> 'iso-8859-1',
			'wordwrap'		=> 	TRUE
		);

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('clikitstuff@gmail.com','Clikit Admin');
		$this->email->to($this->input->post('email'));
		$this->email->subject($subject);
		$this->email->message($message);

		if($this->email->send())
		{
			
			redirect(base_url('orgs/emailcontact'));
		}
		else{
			redirect(base_url('orgs/failedemailcontact'));
		}

   } else{
		redirect(base_url('orgs/failedemailcontact'));
	}

   }

   function emailcontact(){
    	$this->index();
   }
   function failedemailcontact(){
        $this->index();
   }

   public function aboutus(){
	$this->load->view('aboutus');
}

}
