<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model{

    var $nome;
    var $user;
    var $email;
    var $senha;

    public function __contruct(){
        parent::__contruct();
    }


	public function insert_usuario($dados){

        if($this->pesquisa_usuario($dados['user']) == 0){
            $this->db->insert('usuario', $dados);

            if($this->db->affected_rows() > 0){
                
                $this->session->set_flashdata('success','Usuário criado com sucesso!');
                
                $this->efetua_login($dados['user'], $dados['senha']);
            }
        }else{
            $this->session->set_flashdata('error','Usuario já existe no sistema. Tente novamente!');
            redirect(base_url('admin/criar-usuario')); //Irá da um refresh na página

        }
    }
    public function update_usuario($dados){
        $this->db->where('user', $dados['user']);
        $this->db->where('senha', $dados['senhaantiga']);

        $result = $this->db->get('usuario')->result();

        if(count($result) == 1){
            if($dados['senhanova'] == $dados['senhanovaredigit']){
                $dadosupdate = Array(
                    "nome" => $dados['nome'],
                    "senha" => $dados['senhanova'],
                    "email" => $dados['email']
                );
                $this->db->where('user', $dados['user']);
                $this->db->update('usuario', $dadosupdate);

                $this->session->set_flashdata('success','Alterações Efetuadas com Sucesso!');
                redirect(base_url('admin/administrar-conta'));
            }else{
                $this->session->set_flashdata('error','Erro na confirmação da Senha Nova!');
                redirect(base_url('admin/administrar-conta'));
            }
        }else{
            $this->session->set_flashdata('error','Ocorreu um erro na alteração dos dados. Tente novamente!');
            redirect(base_url('admin/administrar-conta'));
        }
    }

    public function efetua_login($user, $senha){
        $this->db->where('user', $user);
        $this->db->where('senha', $senha);

        //Se userlogado nao for null é porque achou o resultado no banco
        $userlogado = $this->db->get('usuario')->result();
        if(count($userlogado) == 1){
            $dadosSessao['user'] = $userlogado[0];
            $dadosSessao['user']->senha = "";
            $dadosSessao['logado'] = TRUE;
            $this->session->set_userdata($dadosSessao);
            redirect(base_url('home'));
        }else{
            $dadosSessao['user'] = null;
            $dadosSessao['logado'] = FALSE;
            $this->session->set_userdata($dadosSessao);
            $this->session->set_flashdata('error','Usuario ou Senha invalidos. Tente novamente!');

            redirect(base_url('admin/login'));
        }
    }

    public function pesquisa_usuario($user){
        $this->db->where('user', $user);
        $existeusuario = $this->db->get('usuario')->result();
        return count($existeusuario);
    }

    public function pega_id_usuario($user){
        $this->db->where('user', $user);
        $existeusuario = $this->db->get('usuario')->result();
        return $existeusuario->id_usuario;
    }
}
