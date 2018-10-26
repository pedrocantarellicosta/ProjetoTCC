<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codigos extends CI_Controller {

    public function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
    }
    public function listar_codigos(){
        $this->load->model('codigo');
        $this->codigo->get_codigos($this->session->userdata('user')->id_usuario);
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('backend/codigos-salvos');

        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

    public function salvarcodigo(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('descricao', 'descricao', 'required|min_length[10]');
        $this->form_validation->set_rules('txt-codigo', 'codigo', 'required|min_length[10]');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{

            $id_usuario = $this->session->userdata('user')->id_usuario;
            $data = date("Y/m/d");
            $codigo = $this->input->post('txt-codigo');
            $descricao = $this->input->post('descricao');

            $this->load->model('codigo');
            $this->codigo->insert_codigo(
                $id_usuario, 
                $codigo,
                $data,
                $descricao
            );
        }
        redirect(base_url('/noxus'));//será?
    }

    public function excluicodigo(){
        $id_codigo = $this->uri->segment(4);
        $id_usuario = $this->uri->segment(5);


        if($id_codigo != null || $id_usuario != null ){
            $this->load->model('codigo');
            $this->codigo->delete_codigo(
                $id_codigo, 
                $id_usuario
            );
        }
        redirect(base_url('/admin/codigos-salvos'));
    }
}
