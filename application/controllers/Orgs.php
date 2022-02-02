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




}