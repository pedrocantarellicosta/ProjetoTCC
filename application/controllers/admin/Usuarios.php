<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
    }

    public function page_login(){
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('backend/login');

        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');

    }

    public function page_criar_usuario(){
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('backend/criar-usuario');

        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');

    }

    public function page_administrar_conta(){
        $this->load->view('frontend/template/html-header');
        $this->load->view('frontend/template/header');

        $this->load->view('backend/administrar-conta');

        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

    public function login(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-user', 'Usuário', 'required|min_length[5]');
        $this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[5]');
        if($this->form_validation->run() == FALSE){
            $this->page_login();
        }else{
            $usuario = $this->input->post('txt-user');
            $senha = $this->input->post('txt-senha');

            $this->load->model('usuario');
            $this->usuario->efetua_login(
                $usuario,
                $senha
            );
        }
    }

    public function criarusuario(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-user', 'Usuário', 'required|min_length[5]');
        $this->form_validation->set_rules('txt-email', 'Email', 'required|min_length[10]');
        $this->form_validation->set_rules('txt-nome', 'Nome', 'required|min_length[10]');

        $this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[5]');
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error','Erro ao criar usuário!');
            $this->page_criar_usuario();
        }else{
            $dados['user'] = $this->input->post('txt-user');
            $dados['senha'] = $this->input->post('txt-senha');
            $dados['email'] = $this->input->post('txt-email');
            $dados['nome'] = $this->input->post('txt-nome');

            $this->load->model('usuario');
            $this->usuario->insert_usuario($dados);

    
        }
    }

    public function alterardadosusuario(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-email', 'Email', 'required|min_length[10]');
        $this->form_validation->set_rules('txt-nome', 'Nome', 'required|min_length[10]');

        $this->form_validation->set_rules('txt-senha-antiga', 'Senha Antiga', 'required|min_length[5]');
        $this->form_validation->set_rules('txt-senha-nova', 'Senha Nova', 'required|min_length[5]');
        $this->form_validation->set_rules('txt-redigita-senha-nova', 'Confirmação de Senha', 'required|min_length[5]');

        if($this->form_validation->run() == FALSE){
            $this->page_administrar_conta();
        }else{
            $dados['senhaantiga'] = $this->input->post('txt-senha-antiga');
            $dados['senhanova'] = $this->input->post('txt-senha-nova');
            $dados['senhanovaredigit'] = $this->input->post('txt-redigita-senha-nova');
            $dados['user'] = $this->session->userdata('user')->user;
            $dados['email'] = $this->input->post('txt-email');
            $dados['nome'] = $this->input->post('txt-nome');

            $this->load->model('usuario');
            $this->usuario->update_usuario($dados);

    
        }
    }

    public function logout(){
        $dadosSessao['user'] = null;
        $dadosSessao['logado'] = FALSE;
        $this->session->set_userdata($dadosSessao);
        redirect(base_url('home'));
    }
}
