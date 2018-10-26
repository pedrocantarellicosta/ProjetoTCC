<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sugestoes extends CI_Model{

    var $nome;
    var $email;
    var $telefone;
    var $assunto;
    var $mensagem;


    public function __contruct(){
        parent::__contruct();
    }
	public function insert_sugestao($nome, $email, $telefone, $assunto, $mensagem)
	{
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
        
        if($this->nome != NULL || $this->assunto != NULL || $this->mensagem != NULL){
            $this->db->insert('sugestoes', $this);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success','Sugestão enviada com sucesso!');
            }else{
                $this->session->set_flashdata('error','Erro ao enviar sua sugestão');
            }
            redirect(current_url()); //Irá da um refresh na página
        }
    }
}
