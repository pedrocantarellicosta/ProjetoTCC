<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('frontend/contato');
        
        $this->load->view('frontend/template/ajude');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
		
    }
    
    public function enviasugestao(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'nome', 'required|min_length[5]');
        $this->form_validation->set_rules('email', 'email', 'required|min_length[10]');
        $this->form_validation->set_rules('assunto', 'assunto', 'required|min_length[8]');
        //$this->form_validation->set_rules('mensagem', 'mensagem', 'required|min_length[20]');

        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $this->load->model('sugestoes');
            $this->sugestoes->insert_sugestao(
                $this->input->post('nome'), 
                $this->input->post('email'),
                $this->input->post('telefone'),
                $this->input->post('assunto'),
                $this->input->post('mensagem')
            );
        }

    }
}
