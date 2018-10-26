<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noxus extends CI_Controller {

	public function index()
	{
		$this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

		$this->load->view('frontend/noxus');
		
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
	}

	public function carrega_codigo($linha)
	{
		$codigos = $this->session->userdata('codigo');
		$linha--;
		$data['cod']= $codigos[$linha]->codigo;

		
		$this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

		$this->load->view('frontend/noxus', $data);
		
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
	}

}
