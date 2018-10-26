<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codigo extends CI_Model{

    var $id_codigo;
    var $id_usuario;
    var $codigo;
    var $data;
    var $descricao;


    public function __contruct(){
        parent::__contruct();
    }
	public function insert_codigo($id_usuario, $codigo, $data, $descricao){   
        if($id_usuario != NULL && $codigo != NULL && $data != NULL && $descricao != NULL){
            $dados = Array(
                "id_usuario" => $id_usuario,
                "codigo" => $codigo,
                "data"=> $data,
                "descricao" => $descricao
            );
            $this->db->insert('codigos', $dados);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success','Código Salvo com Sucesso!');
            }else{
                $this->session->set_flashdata('error','Erro ao Salvar seu Código, tente novamente!');
            }
        }
    }
    public function delete_codigo($id_codigo, $id_usuario){   
        if($id_codigo != NULL && $id_usuario != NULL){
            $dados = Array(
                "id_usuario" => $id_usuario,
                "id_codigos" => $id_codigo
            );
            $this->db->where('id_codigos', $id_codigo, 'id_usuario', $id_usuario);
            $this->db->delete('codigos');

            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success','Código Excluido com Sucesso!');
            }else{
                $this->session->set_flashdata('error','Erro ao Excluir seu Código, tente novamente!');
            }
        }
    }


    public function get_codigos($id_usuario){
        $this->db->where('id_usuario', $id_usuario);

        $result['codigo'] = $this->db->get('codigos')->result();
        
        $this->session->set_userdata($result);

    }
}
