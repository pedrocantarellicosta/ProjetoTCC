<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('frontend/home');
        
        $this->load->view('frontend/template/ajude');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
		
    }
}
