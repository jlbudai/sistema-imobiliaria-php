<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicos extends CI_Controller {

	public function index()
	{

		$dados['titulo'] = 'Serviços Prestados';
		$dados['keywords'] = 'Palavras Chave';
		$dados['description'] = 'Descrição';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		$dados['conteudo'] = $this -> admin_model -> get_pagina('2') -> row();
		
		$this->load->view('servicos', $dados);
	}
	
	
}