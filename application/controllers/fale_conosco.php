<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fale_conosco extends CI_Controller {

	public function index()
	{

		$dados['titulo'] = 'Entre em contato com a Cioffi';
		$dados['keywords'] = 'Palavras Chave';
		$dados['description'] = 'Descrição';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		
		$this->load->view('fale-conosco', $dados);
	}

	public function envia_email()
	{
		$this -> email -> initialize();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = date("d/m/Y");
		$hora = date("H:i");
		$nome = $this->input->post('nome');
		$ddd = $this->input->post('ddd');
		$telefone = $this->input->post('telefone');
		$email = $this->input->post('email');
		$mensagem = $this->input->post('mensagem');
		
		$conteudo = '
				<p>Olá,</p>
				<p><b>'.$nome.'</b> enviou um e-mail às '.$hora.' do dia '.$data.' através do formulário de contato do site.<br />Seguem abaixo seus dados:</p><br />
				<p><b>Nome:</b> '.$nome.'</p>															
				<p><b>Email:</b> '.$email.'</p>								
				<p><b>Telefone:</b> '.$ddd.' '.$telefone.'</p>																				
				<p><b>Mensagem:</b> '.$mensagem.'</p><br /><br /><br />
				<p>Este e-mail foi enviado utilizando o IP '.$ip.'</p>
				<p>Este e-mail é enviado pelo sistema do site, por favor não responda ao e-mail do remetente e sim ao e-mail informado pelo usuário no formulário.</p>
			' ;
			
		$this -> email -> from('site@colibri.imb.br', 'Site Colibri Empreendimentos Imobiliários');
		$this -> email -> to('xisto.guimaraes@gmail.com');
		$this -> email -> cc('contato@colibri.imb.br');
		$this -> email -> subject('Contato através do site');
		$this -> email -> message($conteudo);

		$this -> email -> send();
		
	}

	public function envia_espera_empreendimento()
	{
		$this -> email -> initialize();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = date("d/m/Y");
		$hora = date("H:i");
		$nome = $this->input->post('nome');
		$email = $this->input->post('email');
		$telefone = $this->input->post('telefone');
		$celular = $this->input->post('celular');
		$empreendimento = $this->input->post('empreendimento');
		$mensagem = $this->input->post('mensagem');
		
		$conteudo = '
				<p>Olá,</p>
				<p><b>'.$nome.'</b> enviou um e-mail às '.$hora.' do dia '.$data.' através do formulário de Cadastro na lista de espera.<br />Seguem abaixo seus dados:</p><br />
				<p><b>Nome:</b> '.$nome.'</p>															
				<p><b>Email:</b> '.$email.'</p>								
				<p><b>Telefone:</b> '.$telefone.'</p>																				
				<p><b>Celular:</b> '.$celular.'</p>																				
				<p><b>Empreendimento:</b> '.$empreendimento.'</p>																				
				<p><b>Mensagem:</b> '.$mensagem.'</p><br /><br /><br />
				<p>Este e-mail foi enviado utilizando o IP '.$ip.'</p>
				<p>Este e-mail é enviado pelo sistema do site, por favor não responda ao e-mail do remetente e sim ao e-mail informado pelo usuário no formulário.</p>
			' ;
			
		$this -> email -> from('site@colibri.imb.br', 'Site Colibri Empreendimentos Imobiliários');
		$this -> email -> to('xisto.guimaraes@gmail.com');
		$this -> email -> cc('contato@colibri.imb.br');
		$this -> email -> subject('Cadastro na lista de espera');
		$this -> email -> message($conteudo);

		$this -> email -> send();
		
	}

	public function envia_cadastro()
	{
		$this -> email -> initialize();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = date("d/m/Y");
		$hora = date("H:i");
		$nome = $this->input->post('nome');
		$endereco_pessoa = $this->input->post('endereco_pessoa');
		$ddd = $this->input->post('ddd');
		$telefone = $this->input->post('telefone');
		$email = $this->input->post('email');
		$tipo = $this->input->post('tipo');
		$finalidade = $this->input->post('finalidade');
		$valor = $this->input->post('valor');
		$endereco = $this->input->post('endereco-imovel');
		$bairro = $this->input->post('bairro');
		$cidade = $this->input->post('cidade') .' - '. $this->input->post('estado') ;
		$descricao = $this->input->post('descricao');
		
		$conteudo = '
				<p>Olá,</p>
				<p><b>'.$nome.'</b> enviou um e-mail às '.$hora.' do dia '.$data.' através do formulário de contato do site.<br />Seguem abaixo seus dados:</p><br />
				<p><b>Nome:</b> '.$nome.'</p>															
				<p><b>Endereço:</b> '.$endereco_pessoa.'</p>															
				<p><b>Email:</b> '.$email.'</p>								
				<p><b>Telefone:</b> '.$ddd.' '.$telefone.'</p><br /><br />																								
				<p><b>Dados do Imóvel:</b></p>
				<p><b>Tipo de imóvel:</b> '.$tipo.'</p>
				<p><b>Finalidade:</b> '.$finalidade.'</p>
				<p><b>Valor:</b> '.$valor.'</p>
				<p><b>Endereço:</b> '.$endereco.'</p>
				<p><b>Cidade:</b> '.$cidade.'</p>
				<p><b>Bairro:</b> '.$bairro.'</p>
				<p><b>Descrição:</b> '.$descricao.'</p><br><br><br>
				<p>Este e-mail foi enviado utilizando o IP '.$ip.'</p>
				<p>Este e-mail é enviado pelo sistema do site, por favor não responda ao e-mail do remetente e sim ao e-mail informado pelo usuário no formulário.</p>
			' ;
			
		$this -> email -> from('site@colibri.imb.br', 'Site Colibri Empreendimentos Imobiliários');
		$this -> email -> to('xisto.guimaraes@gmail.com');
		$this -> email -> cc('contato@colibri.imb.br');  
		$this -> email -> subject('Cadastro de imóvel através do site');
		$this -> email -> message($conteudo);

		$this -> email -> send();
		
	}
	
	
}