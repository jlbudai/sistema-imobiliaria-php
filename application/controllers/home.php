<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$dados['titulo'] = 'Imóveis em Camaducaia';
		$dados['keywords'] = 'Palavras Chave';
		$dados['description'] = 'Descrição';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		$dados['destaques'] = $this -> site -> get_destaques() -> result();
		$dados['imoveis'] = $this -> site -> get_imoveis() -> result();

		$this->load->view('home', $dados);
	}
	
	public function erro404()
	{	
		$dados['titulo'] = 'Erro 404 - Página não encontrada';
		$dados['keywords'] = 'erro, 404, página não encontrada';
		$dados['description'] = 'A página solicitada não pode ser encontrada.';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$this->load->view('erro404', $dados);
	}
	
	
	public function lista_bairros($cidade) {
		
		$cidade = str_replace('%20', ' ', $cidade);
		$cidade = str_replace('_', '-', $cidade);
		$cidade = str_replace('%C3%A1', 'á', $cidade);		
		$cidade = str_replace('%C3%A3', 'ã', $cidade);
		$cidade = str_replace('%C3%A9', 'é', $cidade);
		$cidade = str_replace('%C3%AD', 'í', $cidade);
		$cidade = str_replace('%C3%B3', 'ó', $cidade);
		$cidade = str_replace('%C3%B5', 'õ', $cidade);
		$cidade = str_replace('%C3%BA', 'ú', $cidade);
		$cidade = str_replace('%C3%A7', 'ç', $cidade);
		
        $bairros = $this-> admin_model -> lista_bairros($cidade);
		
		$this -> output -> set_content_type('application/json');
        $this -> output -> set_output(json_encode($bairros));
        
        return;
 		
	}
	
}