<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busca extends CI_Controller {

	public function index()
	{

		$dados['titulo'] = 'Serviços Prestados';
		$dados['keywords'] = 'Palavras Chave';
		$dados['description'] = 'Descrição';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$this->load->view('home', $dados);
	}

	public function resultado($offset=0)
	{

		$tipo = $this -> input -> post('tipo');
		$negocio = $this -> input -> post('negocio');
		$cidade = $this -> input -> post('cidade');
		$bairro = $this -> input -> post('bairro');
		$faixapreco = $this -> input -> post('faixapreco');
		
		if($faixapreco):
			$valor = explode('a', $faixapreco);
			$valorMin = $valor[0];
			$valorMax = $valor[1];	
		else:
			$valorMin = '';
			$valorMax = '';
		endif;
		
		$imoveis = $this -> site -> resultado($negocio, $tipo, $cidade, $bairro, $faixapreco, $valorMin, $valorMax) -> result();
		
		$dados['titulo'] = 'Resultado da Busca';
		$dados['keywords'] = 'imóveis, busca, resultado, casas, apartamentos, lotes';
		$dados['description'] = 'Resultado da busca Cioffi Imóveis';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		$dados['imoveis'] = $imoveis;
		
		$this->load->view('resultado', $dados);
	}

	public function codigo()
	{
		$codunico = $this -> input -> post('codigo');
		
		 

		if($this -> site -> codigo($codunico) -> result()):
			redirect('imoveis/detalhe-imovel/'.$codunico, 'location');
		else:
			redirect('erro404', 'location');
		endif;
		
	}
	
	
}