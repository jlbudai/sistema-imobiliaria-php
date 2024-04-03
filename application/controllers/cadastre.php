<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastre extends CI_Controller {

	public function index()
	{

		$dados['titulo'] = 'Cadastre seu imóvel';
		$dados['keywords'] = 'Palavras Chave';
		$dados['description'] = 'Descrição';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$this->load->view('cadastre-seu-imovel', $dados);
	}
	
	
}