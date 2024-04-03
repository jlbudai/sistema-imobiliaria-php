<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imoveis extends CI_Controller {

	public function index($offset=0)
	{
		$limite_por_pag = 20;
		$config['base_url'] = base_url()."imoveis";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('imoveis') -> num_rows(); 
		$this->pagination->initialize($config);

		$dados['titulo'] = 'Encontre seu imóvel';
		$dados['keywords'] = 'imóveis, pouso alegre, compra, venda, sul de minas, imóveis para venda';
		$dados['description'] = 'Conheça todos os nossos imóveis';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$dados['imoveis'] = $this -> site -> pag_imoveis($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this->load->view('imoveis', $dados);
	}
	
	public function imoveis_cadastrados($offset=0)
	{
		$limite_por_pag = 20;
		$config['base_url'] = base_url()."imoveis/imoveis_cadastrados";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('imoveis') -> num_rows(); 
		$this->pagination->initialize($config);

		$dados['titulo'] = 'Encontre seu imóvel';
		$dados['keywords'] = 'imóveis, pouso alegre, compra, venda, sul de minas, imóveis para venda';
		$dados['description'] = 'Conheça todos os nossos imóveis';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$dados['imoveis'] = $this -> site -> pag_imoveis($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this->load->view('imoveis', $dados);
	}


	public function detalhe_imovel()
	{
		
		if($this->uri->segment(3)):			
			$imovel = $this -> site -> detalhe_imovel($this->uri->segment(3)) -> row();
			
			if($imovel):
				
				$dados['titulo'] = $imovel -> tipo .' para '.$imovel -> negocio. ' em ' .$imovel -> cidade;
				$dados['keywords'] = $imovel -> tipo .', '.$imovel -> cidade .', '.$imovel -> dormitorios;
				$dados['description'] = $imovel -> tipo .' para '.$imovel -> negocio. ' em ' .$imovel -> cidade . ' com '.$imovel -> dormitorios;
				$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
				$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
				$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
				
				
				$dados['idImovel'] = $imovel -> idImovel;
				$dados['codunico'] = $imovel -> CodUnico;
				$dados['valor'] = $imovel -> valor;
				$dados['tipo'] = $imovel -> tipo;
				$dados['negocio'] = $imovel -> negocio;
				$dados['endereco'] = $imovel -> endereco;
				$dados['cidade'] = $imovel -> cidade;
				$dados['bairro'] = $imovel -> bairro;
				$dados['capa'] = $imovel -> capa;
				$dados['areaTotal'] = $imovel -> areaTotal;
				$dados['areaCons'] = $imovel -> areaCons;
				$dados['destaque'] = $imovel -> destaque;
				$dados['dormitorios'] = $imovel -> dormitorios;
				$dados['suites'] = $imovel -> suites;
				$dados['banheiros'] = $imovel -> banheiros;
				$dados['garagem'] = $imovel -> garagem;
				$dados['salaTv'] = $imovel -> salaTv;
			    $dados['salaEstar'] = $imovel -> salaEstar;
				$dados['salaJantar'] = $imovel -> salaJantar;
				$dados['sala2ambientes'] = $imovel -> sala2ambientes;
				$dados['cozinha'] = $imovel -> cozinha;
				$dados['cozinhaPlanejada'] = $imovel -> cozinhaPlanejada;
				$dados['cozinhaAmericana'] = $imovel -> cozinhaAmericana;
				$dados['cozinhaMineira'] = $imovel -> cozinhaMineira;
				$dados['cozinhaMineira'] = $imovel -> cozinhaMineira;
				$dados['lavabo'] = $imovel -> lavabo;
				$dados['areaServico'] = $imovel -> areaServico;
				$dados['quartoEmpregada'] = $imovel -> quartoEmpregada;
				$dados['quintal'] = $imovel -> quintal;
				$dados['copa'] = $imovel -> copa;
				$dados['escritorio'] = $imovel -> escritorio;
				$dados['despensa'] = $imovel -> despensa;
				$dados['porao'] = $imovel -> porao;
				$dados['piscina'] = $imovel -> piscina;
				$dados['churrasqueira'] = $imovel -> churrasqueira;
				$dados['jardim'] = $imovel -> jardim;
				$dados['jardimInverno'] = $imovel -> jardimInverno;
				$dados['areaLazer'] = $imovel -> areaLazer;
				$dados['salaoJogos'] = $imovel -> salaoJogos;
				$dados['sauna'] = $imovel -> sauna;
				$dados['hidromassagem'] = $imovel -> hidromassagem;
				$dados['ofuroJacuzi'] = $imovel -> ofuroJacuzi;
				$dados['gourmet'] = $imovel -> gourmet;
				$dados['sacada'] = $imovel -> sacada;
				$dados['varanda'] = $imovel -> varanda;
				$dados['portaoEletronico'] = $imovel -> portaoEletronico;
				$dados['interfone'] = $imovel -> interfone;
				$dados['aquecedorSolar'] = $imovel -> aquecedorSolar;
				$dados['cercaEletrica'] = $imovel -> cercaEletrica;
				$dados['farmacia'] = $imovel -> farmacia;
				$dados['supermercado'] = $imovel -> supermercado;
				$dados['mercado'] = $imovel -> mercado;
				$dados['padaria'] = $imovel -> padaria;
				$dados['acougue'] = $imovel -> acougue;
				$dados['pizzaria'] = $imovel -> pizzaria;
				$dados['restaurante'] = $imovel -> restaurante;
				$dados['lanchonete'] = $imovel -> lanchonete;
				$dados['igrejaEvangelica'] = $imovel -> igrejaEvangelica;
				$dados['igrejaCatolica'] = $imovel -> igrejaCatolica;
				$dados['templo'] = $imovel -> templo;
				$dados['parque'] = $imovel -> parque;
				$dados['onibus'] = $imovel -> onibus;
				$dados['postoGasolina'] = $imovel -> postoGasolina;
				$dados['postoSaude'] = $imovel -> postoSaude;
				$dados['hospital'] = $imovel -> hospital;
				$dados['escola1grau'] = $imovel -> escola1grau;
				$dados['escola2grau'] = $imovel -> escola2grau;
				$dados['faculdade'] = $imovel -> faculdade;
				$dados['creche'] = $imovel -> creche;
				$dados['observacoes'] = $imovel -> observacoes;
				$dados['status'] = $imovel -> status;
				$dados['fotos'] = $this -> site -> fotos_imovel($imovel -> idImovel) -> result();
		
				$this->load->view('detalhe-imovel', $dados);

			else:
				redirect('imoveis', 'refresh');				
			endif;
					
		else:
			redirect('erro404', 'refresh');
		endif;
	}

	public function imprimir()
	{
		
		if($this->uri->segment(3)):			
			$imovel = $this -> site -> detalhe_imovel($this->uri->segment(3)) -> row();
			
			if($imovel):
				
				$dados['titulo'] = $imovel -> tipo .' para '.$imovel -> negocio. ' em ' .$imovel -> cidade;
				$dados['keywords'] = $imovel -> tipo .', '.$imovel -> cidade .', '.$imovel -> dormitorios;
				$dados['description'] = $imovel -> tipo .' para '.$imovel -> negocio. ' em ' .$imovel -> cidade . ' com '.$imovel -> dormitorios;
				$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
				$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
				$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
				
				
				$dados['idImovel'] = $imovel -> idImovel;
				$dados['codunico'] = $imovel -> CodUnico;
				$dados['valor'] = $imovel -> valor;
				$dados['tipo'] = $imovel -> tipo;
				$dados['negocio'] = $imovel -> negocio;
				$dados['cidade'] = $imovel -> cidade;
				$dados['bairro'] = $imovel -> bairro;
				$dados['capa'] = $imovel -> capa;
				$dados['areaTotal'] = $imovel -> areaTotal;
				$dados['areaCons'] = $imovel -> areaCons;
				$dados['destaque'] = $imovel -> destaque;
				$dados['dormitorios'] = $imovel -> dormitorios;
				$dados['suites'] = $imovel -> suites;
				$dados['banheiros'] = $imovel -> banheiros;
				$dados['garagem'] = $imovel -> garagem;
				$dados['salaTv'] = $imovel -> salaTv;
			    $dados['salaEstar'] = $imovel -> salaEstar;
				$dados['salaJantar'] = $imovel -> salaJantar;
				$dados['sala2ambientes'] = $imovel -> sala2ambientes;
				$dados['cozinha'] = $imovel -> cozinha;
				$dados['cozinhaPlanejada'] = $imovel -> cozinhaPlanejada;
				$dados['cozinhaAmericana'] = $imovel -> cozinhaAmericana;
				$dados['cozinhaMineira'] = $imovel -> cozinhaMineira;
				$dados['cozinhaMineira'] = $imovel -> cozinhaMineira;
				$dados['lavabo'] = $imovel -> lavabo;
				$dados['areaServico'] = $imovel -> areaServico;
				$dados['quartoEmpregada'] = $imovel -> quartoEmpregada;
				$dados['quintal'] = $imovel -> quintal;
				$dados['copa'] = $imovel -> copa;
				$dados['escritorio'] = $imovel -> escritorio;
				$dados['despensa'] = $imovel -> despensa;
				$dados['porao'] = $imovel -> porao;
				$dados['piscina'] = $imovel -> piscina;
				$dados['churrasqueira'] = $imovel -> churrasqueira;
				$dados['jardim'] = $imovel -> jardim;
				$dados['jardimInverno'] = $imovel -> jardimInverno;
				$dados['areaLazer'] = $imovel -> areaLazer;
				$dados['salaoJogos'] = $imovel -> salaoJogos;
				$dados['sauna'] = $imovel -> sauna;
				$dados['hidromassagem'] = $imovel -> hidromassagem;
				$dados['ofuroJacuzi'] = $imovel -> ofuroJacuzi;
				$dados['gourmet'] = $imovel -> gourmet;
				$dados['sacada'] = $imovel -> sacada;
				$dados['varanda'] = $imovel -> varanda;
				$dados['portaoEletronico'] = $imovel -> portaoEletronico;
				$dados['interfone'] = $imovel -> interfone;
				$dados['aquecedorSolar'] = $imovel -> aquecedorSolar;
				$dados['cercaEletrica'] = $imovel -> cercaEletrica;
				$dados['farmacia'] = $imovel -> farmacia;
				$dados['supermercado'] = $imovel -> supermercado;
				$dados['mercado'] = $imovel -> mercado;
				$dados['padaria'] = $imovel -> padaria;
				$dados['acougue'] = $imovel -> acougue;
				$dados['pizzaria'] = $imovel -> pizzaria;
				$dados['restaurante'] = $imovel -> restaurante;
				$dados['lanchonete'] = $imovel -> lanchonete;
				$dados['igrejaEvangelica'] = $imovel -> igrejaEvangelica;
				$dados['igrejaCatolica'] = $imovel -> igrejaCatolica;
				$dados['templo'] = $imovel -> templo;
				$dados['parque'] = $imovel -> parque;
				$dados['onibus'] = $imovel -> onibus;
				$dados['postoGasolina'] = $imovel -> postoGasolina;
				$dados['postoSaude'] = $imovel -> postoSaude;
				$dados['hospital'] = $imovel -> hospital;
				$dados['escola1grau'] = $imovel -> escola1grau;
				$dados['escola2grau'] = $imovel -> escola2grau;
				$dados['faculdade'] = $imovel -> faculdade;
				$dados['creche'] = $imovel -> creche;
				$dados['observacoes'] = $imovel -> observacoes;
				$dados['status'] = $imovel -> status;
				$dados['fotos'] = $this -> site -> fotos_imovel($imovel -> idImovel) -> result();
		
				$this->load->view('imprimir', $dados);

			else:
				redirect('imoveis', 'refresh');				
			endif;
					
		else:
			redirect('erro404', 'refresh');
		endif;
	}
	
	
	public function envia_email()
	{
		$this -> email -> initialize();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = date("d/m/Y");
		$hora = date("H:i");
		$nome = $this->input->post('nome');
		$email = $this->input->post('email');
		$nomeAmigo = $this->input->post('nomeAmigo');
		$emailAmigo = $this->input->post('emailAmigo');
		$url = $this->input->post('url');
		
		$conteudo = '
				<p>Olá, <b>'.$nomeAmigo.'</b></p>
				<p><b>'.$nome.'</b> visitou do site da Colibri Empreendimentos Imobiliários e lhe indicou uma oferta de imóvel em nosso site.</p><br />
				<p>Para acessar, clique no link abaixo:</p>
				<p><a href="'.$url.'" target="_blank">Ver detalhes do Imóvel</a></p><br/><br/><br/>
				<p>Este e-mail foi enviado utilizando o IP '.$ip.'</p>
				<p>Este e-mail é enviado pelo sistema do site, por favor não responda ao e-mail.</p>
			' ;
			
		$this -> email -> from('site@colibri.imb.br', 'Colibri Empreendimentos Imobiliários');
		$this -> email -> to($emailAmigo);
		$this -> email -> subject($nome.' lhe indicou um imóvel');
		$this -> email -> message($conteudo);

		$this -> email -> send();
		
	}
	
	
}