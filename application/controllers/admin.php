<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index() {
		$dados['titulo'] = 'Efetue o Login';
		$this -> load -> view('admin/index', $dados);

	}

	// ====== FUNÇÕES PRINCIPAIS ====== //	
	public function login() {
		
		$this -> form_validation -> set_rules('email', 'E-MAIL', 'trim|required|max_length[50]|strtolower|xss_clean|callback_validate_credentials');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|max_length[10]|xss_clean|callback_validate_credentials');

		if ($this -> form_validation -> run() == FALSE):
			$dados = array('titulo' => 'Erro', );
			$this -> load -> view('admin/index', $dados);
		else:
			$email = $this -> input -> post('email');
			$senha = $this -> input -> post('senha');

			//query the database
			$result = $this -> admin_model -> do_login($email, $senha);

			if ($result):
				$sess_array = array();
				foreach ($result as $row) {
					$sess_array = array('id' => $row -> id, 'nome' => $row -> nome, 'nivel' => $row -> nivel, 'acesso' => $row -> acesso);
					$this -> session -> set_userdata('logado', $sess_array);
					redirect('admin/principal', 'location');
				}
				return TRUE;
			else:
				$this -> session -> set_flashdata('erro_login', 'E-mail ou senha inválido!');
				redirect('admin/index', 'location');
				return false;
			endif;

			redirect('admin/principal', 'location');
		endif;
	}

	function logout() {
		session_start();
		$this -> session -> unset_userdata('logado');
		session_destroy();
		$this -> session -> set_flashdata('logout', 'Você saiu do sistema.');
		redirect('admin/', 'location');
	}
	
	public function Recuperar_senha() {
		
		$dados['titulo'] = 'Recuperar Senha';
		$this -> load -> view('admin/recuperar_senha', $dados);
	}
	

	public function enviar_senha() {
		$this -> form_validation -> set_rules('email', 'E-MAIL', 'trim|required|max_length[50]|strtolower|xss_clean|callback_validate_credentials');

		if ($this -> form_validation -> run() == FALSE) {
			$dados = array('titulo' => 'Erro', );
			$this -> load -> view('admin/recuperar_senha', $dados);
		} else {
			$email = $this -> input -> post('email');

			$result = $this -> admin_model -> envia_senha($email);

			if ($result) {
				$sess_array = array();
				foreach ($result as $row) {
					$sess_array = array('nome' => $row -> nome, 'senha' => $this -> encrypt -> decode($row -> senha), 'email' => $row -> email);
				}

				//INICIA SMTP
				$this -> email -> initialize();
				
				$mensagem = 'Olá ' .$sess_array['nome'].', <br/><br/>Você fez um pedido de lembrança de senha. Utlize os dados baixo para acessar.<br/><br/>Login: '.$sess_array['email'].'<br/>Senha: ' . $sess_array['senha'];

				$this -> email -> from('site@cioffiimoveis.com.br', 'Site Cioffi Imóveis');
				$this -> email -> to($sess_array['email']);

				$this -> email -> subject('Reenvio de Senha');
				$this -> email -> message($mensagem);

				$this -> email -> send();
				
				$this -> session -> set_flashdata('sucesso_email', 'Senha enviada para seu e-mail.');
				redirect('admin/', 'location');
				
				echo $this -> email -> print_debugger();

			} else {
				$this -> session -> set_flashdata('erro_email', 'E-mail não cadastrado!');
				redirect('admin/recuperar_senha', 'location');
				return false;
			}

		}

	}

	public function principal() {
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
			$dados['nome'] = $session_data['nome'];
			$dados['id'] = $session_data['id'];
			$dados['nivel'] = $session_data['nivel'];
			$dados['acesso'] = $session_data['acesso'];
			$dados['titulo'] = 'Página Principal';

			$this -> load -> view('admin/principal', $dados);
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;

	}
	// ====== FIM FUNÇÕES PRINCIPAIS ====== //

	
	
	// ====== USUARIOS ====== //
	public function usuarios($offset=0) {

		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
			$limite_por_pag = 10;
			$config['base_url'] = base_url()."admin/usuarios";
			$config['per_page'] = $limite_por_pag;
			$config['total_rows'] = $this->db->get('usuarios_adm')->num_rows(); 
			
			$this->pagination->initialize($config);
				
			$dados = array('titulo' => 'Painel de Controle - Gerênciar Usuarios', 'usuarios' => $this -> admin_model -> get_all_pagination($limite_por_pag, $offset) -> result(), 'paginacao' => $this->pagination->create_links(), 'nome' => $session_data['nome']);
			$this -> load -> view('admin/usuarios', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function cadastrar_usuario($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login

		//validacao
		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_length[50]|ucwords');
		$this -> form_validation -> set_rules('email', 'EMAIL', 'trim|required|valid_email|is_unique[usuarios_adm.email]');
		$this -> form_validation-> set_message('is_unique', 'E-mail já cadastrado no sistema.');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|required|max_length[10]|strtolower');
		$this -> form_validation -> set_message('matches', 'O campos %s está diferente do campo %s');
		$this -> form_validation -> set_rules('senha2', 'REPITA SENHA', 'trim|required|max_length[10]|strtolower|matches[senha]');
		$this -> form_validation -> set_rules('nivel', 'NIVEL', 'trim|required');

		if ($this -> form_validation -> run() == true):
			$dados = elements(array('nome', 'email', 'senha', 'nivel', 'acesso'), $this -> input -> post());
			$dados['senha'] = $this->encrypt->encode($this->input->post('senha'));
			$this->load->model('admin_model');
			$this -> admin_model -> inserir_usuario($dados);
		endif;
		
		$limite_por_pag = 10;
		$config['base_url'] = base_url()."admin/usuarios";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('usuarios_adm')->num_rows(); 
		
		$this->pagination->initialize($config);
			
		$dados = array('titulo' => 'Painel de Controle - Gerênciar Usuarios', 'usuarios' => $this -> admin_model -> get_all_pagination($limite_por_pag, $offset) -> result(), 'paginacao' => $this->pagination->create_links(), 'nome' => $session_data['nome']);
		$this -> load -> view('admin/usuarios', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function deletar_usuario() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		

		if ($this->uri->segment(3) > 0):
			$this -> admin_model -> deletar_usuario(array('id' => $this->uri->segment(3)));
		endif;
		
		$dados['titulo'] = 'Painel de Controle - Gerênciar Usuarios';
		$this -> load -> view('admin/usuarios', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function editar_usuario() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
		
		$query = $this -> admin_model -> get_byid($this->uri->segment(3)) -> row();

		$dados = array('titulo' => 'Painel de Controle - Gerênciar Usuarios - Editar Usuário', 'nome' => $query -> nome,  'email' => $query -> email,  'nivel' => $query -> nivel, 'id' => $query -> id);
		$this -> load -> view('admin/editar-usuarios', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login
	}
	
	public function atualizar_usuario() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
		
		//validacao
		$this -> form_validation -> set_rules('nome', 'NOME', 'trim|required|max_length[50]|ucwords');
		$this -> form_validation -> set_rules('senha', 'SENHA', 'trim|max_length[10]');
		$this -> form_validation -> set_rules('senha2', 'REPITA SENHA', 'trim|max_length[10]|matches[senha]');
		$this -> form_validation -> set_message('matches', 'O campos %s está diferente do campo %s');
		$this -> form_validation -> set_rules('nivel', 'NIVEL', 'trim|required');

		if ($this -> form_validation -> run() == true) {
			
			if($this -> input -> post('senha') == ''):
				$dados = elements(array('nome', 'nivel'), $this -> input -> post());
				$this -> admin_model -> atualizar_usuario($dados, array('id' => $this -> input -> post('id')));
			else:
				$dados = elements(array('nome', 'senha', 'nivel'), $this -> input -> post());
				$dados['senha'] = $this->encrypt->encode($this->input->post('senha'));
				$this -> admin_model -> atualizar_usuario($dados, array('id' => $this -> input -> post('id')));
			endif;
		}
		
		$query = $this -> admin_model -> get_byid($this -> input -> post('id')) -> row();
			
		$dados = array('titulo' => 'Painel de Controle - Gerênciar Usuarios - Editar Usuário', 'nome' => $query -> nome,  'email' => $query -> email,  'nivel' => $query -> nivel, 'id' => $query -> id);
		$this -> load -> view('admin/editar-usuarios', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login
	}
	// ====== FIM USUÁRIOS ====== //


	// ====== IMOVEIS ====== //
	public function gerenciar_imoveis($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$limite_por_pag = 20;
		$config['base_url'] = base_url()."admin/gerenciar-imoveis";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('imoveis') -> num_rows();
		$this->pagination->initialize($config); 
		 
		 
		$dados['titulo'] = 'Imóveis';
		$dados['imoveis'] = $this -> admin_model -> pag_imoveis($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this -> load -> view('admin/imoveis', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function cadastrar_imoveis($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		 
		$dados['titulo'] = 'Cadastrar Imóveis';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();
		$this -> load -> view('admin/cadastrar-imoveis', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function cadastrar_imovel() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
		
		 
		 	$valor = $this->input->post('valor');
			$valor = str_replace('.', '', $valor);
			$valor = str_replace(',', '', $valor);
			
			
			$config['upload_path'] = './fotos-imoveis/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '10240';
			$config['overwrite']  = FALSE;
			$config['encrypt_name'] = TRUE;
			 
			$arquivo = "arquivo";
			$this->upload->initialize($config); 

			//Faz o upload
			if(!$this->upload->do_upload($arquivo)):
			    $error = array('erro' => $this->upload->display_errors());
				$capa = '0';
			else:
			    $upload_data = $this->upload->data();
			    $capa = $upload_data['file_name']; 
			endif;
			
			
			$config_img['image_library'] = 'gd2';
			$config_img['source_image'] = './fotos-imoveis/'.$capa;
			$config_img['create_thumb'] = FALSE;
			$config_img['maintain_ratio'] = TRUE;
			$config_img['width'] = 300;
			$config_img['height'] = 225;
			$config_img['wm_overlay_path'] = './images/marca-dagua.png';
			$config_img['wm_type'] = 'overlay';
			$config_img['wm_vrt_alignment'] = 'middle';
			$config_img['wm_hor_alignment'] = 'center';

			$this->load->library('image_lib', $config_img);
			
			$this->image_lib->resize();
			$this->image_lib->watermark();
		 
		 
			$dados['codunico'] = $this->input->post('codunico');
			$dados['valor'] = substr($valor, 0, -2);
			$dados['tipo'] = $this->input->post('tipo');
			$dados['negocio'] = $this->input->post('negocio');
			$dados['endereco'] = $this->input->post('endereco');
			$dados['cidade'] = $this->input->post('cidade');
			$dados['bairro'] = $this->input->post('bairro');
			$dados['areaTotal'] = $this->input->post('areaTotal').' '.$this->input->post('medidaAreaTotal');
			$dados['areaCons'] = $this->input->post('areaCons').' '.$this->input->post('medidaAreaCons');
			$dados['destaque'] = $this->input->post('destaque');
			$dados['capa'] = $capa;
			$dados['dormitorios'] = $this->input->post('dormitorios');
			$dados['suites'] = $this->input->post('suites');
			$dados['banheiros'] = $this->input->post('banheiros');
			$dados['garagem'] = $this->input->post('garagem');
			
			if($this->input->post('salaTv')): $salaTv = 'Sala de Tv;'; else: $salaTv = '0'; endif;
			$dados['salaTv'] = $salaTv;
			
			if($this->input->post('salaEstar')): $salaEstar = 'Sala de Estar;'; else: $salaEstar = '0'; endif;
			$dados['salaEstar'] = $salaEstar;
			
			if($this->input->post('salaJantar')): $salaJantar = 'Sala de Jantar;'; else: $salaJantar = '0'; endif;
			$dados['salaJantar'] = $salaJantar;
			
			if($this->input->post('sala2ambientes')): $sala2ambientes = 'Sala com 2 ambientes;'; else: $sala2ambientes = '0'; endif;
			$dados['sala2ambientes'] = $sala2ambientes;
			
			if($this->input->post('cozinha')): $cozinha = 'Cozinha;'; else: $cozinha = '0'; endif;
			$dados['cozinha'] = $cozinha;
			
			if($this->input->post('cozinhaPlanejada')): $cozinhaPlanejada = 'Cozinha Planejada;'; else: $cozinhaPlanejada = '0'; endif;
			$dados['cozinhaPlanejada'] = $cozinhaPlanejada;
			
			if($this->input->post('cozinhaAmericana')): $cozinhaAmericana = 'Cozinha Americana;'; else: $cozinhaAmericana = '0'; endif;
			$dados['cozinhaAmericana'] = $cozinhaAmericana;
			
			if($this->input->post('cozinhaMineira')): $cozinhaMineira = 'Cozinha Mineira;'; else: $cozinhaMineira = '0'; endif;
			$dados['cozinhaMineira'] = $cozinhaMineira;
			
			if($this->input->post('cozinhaMineira')): $cozinhaMineira = 'Cozinha Mineira;'; else: $cozinhaMineira = '0'; endif;
			$dados['cozinhaMineira'] = $cozinhaMineira;
			
			if($this->input->post('lavabo')): $lavabo = 'Lavabo;'; else: $lavabo = '0'; endif;
			$dados['lavabo'] = $lavabo;
			
			if($this->input->post('areaServico')): $areaServico = 'Área de Serviço;'; else: $areaServico = '0'; endif;
			$dados['areaServico'] = $areaServico;
			
			if($this->input->post('quartoEmpregada')): $quartoEmpregada = 'Quarto de empregada;'; else: $quartoEmpregada = '0'; endif;
			$dados['quartoEmpregada'] = $quartoEmpregada;
			
			if($this->input->post('quintal')): $quintal = 'Quintal;'; else: $quintal = '0'; endif;
			$dados['quintal'] = $quintal;
			
			if($this->input->post('copa')): $copa = 'Copa;'; else: $copa = '0'; endif;
			$dados['copa'] = $copa;
			
			if($this->input->post('escritorio')): $escritorio = 'Escritório;'; else: $escritorio = '0'; endif;
			$dados['escritorio'] = $escritorio;
			
			if($this->input->post('despensa')): $despensa = 'Despensa;'; else: $despensa = '0'; endif;
			$dados['despensa'] = $despensa;
			
			if($this->input->post('porao')): $porao = 'Porão;'; else: $porao = '0'; endif;
			$dados['porao'] = $porao;
			
			if($this->input->post('piscina')): $piscina = 'Piscina;'; else: $piscina = '0'; endif;
			$dados['piscina'] = $piscina;
			
			if($this->input->post('churrasqueira')): $churrasqueira = 'Churrasqueira;'; else: $churrasqueira = '0'; endif;
			$dados['churrasqueira'] = $churrasqueira;
			
			if($this->input->post('jardim')): $jardim = 'Jardim;'; else: $jardim = '0'; endif;
			$dados['jardim'] = $jardim;
			
			if($this->input->post('jardimInverno')): $jardimInverno = 'Jardim de Inverno;'; else: $jardimInverno = '0'; endif;
			$dados['jardimInverno'] = $jardimInverno;
			
			if($this->input->post('areaLazer')): $areaLazer = 'Área de Lazer;'; else: $areaLazer = '0'; endif;
			$dados['areaLazer'] = $areaLazer;
			
			if($this->input->post('salaoJogos')): $salaoJogos = 'Salão de Jogos;'; else: $salaoJogos = '0'; endif;
			$dados['salaoJogos'] = $salaoJogos;
			
			if($this->input->post('sauna')): $sauna = 'Sauna;'; else: $sauna = '0'; endif;
			$dados['sauna'] = $sauna;
			
			if($this->input->post('hidromassagem')): $hidromassagem = 'Hidromassagem;'; else: $hidromassagem = '0'; endif;
			$dados['hidromassagem'] = $hidromassagem;
			
			if($this->input->post('ofuroJacuzi')): $ofuroJacuzi = 'Ofuro / Jacuzi;'; else: $ofuroJacuzi = '0'; endif;
			$dados['ofuroJacuzi'] = $ofuroJacuzi;
			    
			if($this->input->post('gourmet')): $gourmet = 'Espaço Gourmet;'; else: $gourmet = '0'; endif;
			$dados['gourmet'] = $gourmet;
			    
			if($this->input->post('sacada')): $sacada = 'Sacada;'; else: $sacada = '0'; endif;
			$dados['sacada'] = $sacada;
			    
			if($this->input->post('varanda')): $varanda = 'Varanda;'; else: $varanda = '0'; endif;
			$dados['varanda'] = $varanda;
			    
			if($this->input->post('portaoEletronico')): $portaoEletronico = 'Portão Eletrônico;'; else: $portaoEletronico = '0'; endif;
			$dados['portaoEletronico'] = $portaoEletronico;
			    
			if($this->input->post('interfone')): $interfone = 'Interfone;'; else: $interfone = '0'; endif;
			$dados['interfone'] = $interfone;
			    
			if($this->input->post('aquecedorSolar')): $aquecedorSolar = 'Aquecedor Solar;'; else: $aquecedorSolar = '0'; endif;
			$dados['aquecedorSolar'] = $aquecedorSolar;
			    
			if($this->input->post('cercaEletrica')): $cercaEletrica = 'Cerca Elétrica;'; else: $cercaEletrica = '0'; endif;
			$dados['cercaEletrica'] = $cercaEletrica;
			    
			if($this->input->post('farmacia')): $farmacia = 'Farmácia;'; else: $farmacia = '0'; endif;
			$dados['farmacia'] = $farmacia;
			    
			if($this->input->post('supermercado')): $supermercado = 'Supermercado;'; else: $supermercado = '0'; endif;
			$dados['supermercado'] = $supermercado;
			    
			if($this->input->post('mercado')): $mercado = 'Mercado;'; else: $mercado = '0'; endif;
			$dados['mercado'] = $mercado;
			    
			if($this->input->post('padaria')): $padaria = 'Padaria;'; else: $padaria = '0'; endif;
			$dados['padaria'] = $padaria;
			    
			if($this->input->post('acougue')): $acougue = 'Açougue;'; else: $acougue = '0'; endif;
			$dados['acougue'] = $acougue;
			    
			if($this->input->post('pizzaria')): $pizzaria = 'Pizzaria;'; else: $pizzaria = '0'; endif;
			$dados['pizzaria'] = $pizzaria;
			    
			if($this->input->post('restaurante')): $restaurante = 'Restaurante;'; else: $restaurante = '0'; endif;
			$dados['restaurante'] = $restaurante;
			    
			if($this->input->post('lanchonete')): $lanchonete = 'Lanchonete;'; else: $lanchonete = '0'; endif;
			$dados['lanchonete'] = $lanchonete;
			    
			if($this->input->post('igrejaEvangelica')): $igrejaEvangelica = 'Igreja Evangélica;'; else: $igrejaEvangelica = '0'; endif;
			$dados['igrejaEvangelica'] = $igrejaEvangelica;
			    
			if($this->input->post('igrejaCatolica')): $igrejaCatolica = 'Igreja Católica;'; else: $igrejaCatolica = '0'; endif;
			$dados['igrejaCatolica'] = $igrejaCatolica;
			    
			if($this->input->post('templo')): $templo = 'Templo;'; else: $templo = '0'; endif;
			$dados['templo'] = $templo;
			    
			if($this->input->post('parque')): $parque = 'Parque / Praça / Clube;'; else: $parque = '0'; endif;
			$dados['parque'] = $parque;
			    
			if($this->input->post('onibus')): $onibus = 'Ponto de ônibus;'; else: $onibus = '0'; endif;
			$dados['onibus'] = $onibus;
			    
			if($this->input->post('postoGasolina')): $postoGasolina = 'Posto de Gasolina;'; else: $postoGasolina = '0'; endif;
			$dados['postoGasolina'] = $postoGasolina;
			    
			if($this->input->post('postoSaude')): $postoSaude = 'Posto de Saúde;'; else: $postoSaude = '0'; endif;
			$dados['postoSaude'] = $postoSaude;
			    
			if($this->input->post('hospital')): $hospital = 'Hospital;'; else: $hospital = '0'; endif;
			$dados['hospital'] = $hospital;
			    
			if($this->input->post('escola1grau')): $escola1grau = 'Escola de 1º grau;'; else: $escola1grau = '0'; endif;
			$dados['escola1grau'] = $escola1grau;
			    
			if($this->input->post('escola2grau')): $escola2grau = 'Escola de 2º grau;'; else: $escola2grau = '0'; endif;
			$dados['escola2grau'] = $escola2grau;
			    
			if($this->input->post('faculdade')): $faculdade = 'Faculdade;'; else: $faculdade = '0'; endif;
			$dados['faculdade'] = $faculdade;
			    
			if($this->input->post('creche')): $creche = 'Creche;'; else: $creche = '0'; endif;
			$dados['creche'] = $creche;
			
			$dados['observacoes'] = $this->input->post('observacoes');
			$dados['status'] = $this->input->post('status');
			
	
			$this -> admin_model -> inserir_imovel($dados);
			
			$this -> session -> set_flashdata('sucesso', 'Cadastrado com sucesso.');
			redirect('admin/cadastrar-imoveis', 'location');
		 
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	
	public function editar_imovel() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$imovel = $this -> admin_model -> get_imovel($this->uri->segment(3)) -> row();
		 
		$dados['titulo'] = 'Editar Imóveis';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['tipos'] = $this -> admin_model -> get_tipo() -> result();
		$dados['negocios'] = $this -> admin_model -> get_negocio() -> result();		
		
		$dados['idImovel'] = $imovel -> idImovel;
		$dados['codunico'] = $imovel -> CodUnico;
		$dados['valor'] = $imovel -> valor;
		$dados['tipoAtual'] = $imovel -> tipo;
		$dados['negocioAtual'] = $imovel -> negocio;
		$dados['endereco'] = $imovel -> endereco;
		$dados['cidadeAtual'] = $imovel -> cidade;
		$dados['bairroAtual'] = $imovel -> bairro;
		
		$areaTotal = explode(' ', $imovel -> areaTotal);
		$areaCons = explode(' ', $imovel -> areaCons);
		
		$dados['areaTotal'] = $areaTotal[0];
		$dados['areaCons'] = $areaCons[0];
		$dados['medidaAreaTotal'] = $areaTotal[1];
		$dados['medidaAreaCons'] = $areaCons[1];
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

		$this -> load -> view('admin/editar-imovel', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function atualizar_imovel() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
			$valor = $this->input->post('valor');
			$valor = str_replace('.', '', $valor);
			$valor = str_replace(',', '', $valor);
						
			$config['upload_path'] = './fotos-imoveis/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '10240';
			$config['overwrite']  = FALSE;
			$config['encrypt_name'] = TRUE;
			 
			$arquivo = "arquivo";
			$this->upload->initialize($config); 

			//Atualiza a capa
			if($this->upload->do_upload($arquivo)):
				
				$imovel = $this -> admin_model -> get_imovel($this -> input -> post('idImovel')) -> row();
			
				// Deleta Foto
				if($imovel -> capa != '0'):
					unlink('./fotos-imoveis/'.$imovel -> capa);
				endif;				
				
			    $upload_data = $this->upload->data();
				$dados['capa'] = $upload_data['file_name'];
								
				$config_img['image_library'] = 'gd2';
				$config_img['source_image'] = './fotos-imoveis/'.$dados['capa'];
				$config_img['create_thumb'] = FALSE;
				$config_img['maintain_ratio'] = TRUE;
				$config_img['width'] = 300;
				$config_img['height'] = 225;
				$config_img['wm_overlay_path'] = './images/marca-dagua.png';
				$config_img['wm_type'] = 'overlay';
				$config_img['wm_vrt_alignment'] = 'middle';
				$config_img['wm_hor_alignment'] = 'center';
	
				$this->load->library('image_lib', $config_img);
				
				$this->image_lib->resize();
				$this->image_lib->watermark();
								
			endif;
		 		 

		 
		 
		 
			$dados['codunico'] = $this->input->post('codunico');
			$dados['valor'] = substr($valor, 0, -2);
			$dados['tipo'] = $this->input->post('tipo');
			$dados['negocio'] = $this->input->post('negocio');
			$dados['endereco'] = $this->input->post('endereco');
			$dados['cidade'] = $this->input->post('cidade');
			$dados['bairro'] = $this->input->post('bairro');
			$dados['areaTotal'] = $this->input->post('areaTotal').' '.$this->input->post('medidaAreaTotal');
			$dados['areaCons'] = $this->input->post('areaCons').' '.$this->input->post('medidaAreaCons');
			$dados['destaque'] = $this->input->post('destaque');
			$dados['dormitorios'] = $this->input->post('dormitorios');
			$dados['suites'] = $this->input->post('suites');
			$dados['banheiros'] = $this->input->post('banheiros');
			$dados['garagem'] = $this->input->post('garagem');
			
			if($this->input->post('salaTv')): $salaTv = 'Sala de Tv;'; else: $salaTv = '0'; endif;
			$dados['salaTv'] = $salaTv;
			
			if($this->input->post('salaEstar')): $salaEstar = 'Sala de Estar;'; else: $salaEstar = '0'; endif;
			$dados['salaEstar'] = $salaEstar;
			
			if($this->input->post('salaJantar')): $salaJantar = 'Sala de Jantar;'; else: $salaJantar = '0'; endif;
			$dados['salaJantar'] = $salaJantar;
			
			if($this->input->post('sala2ambientes')): $sala2ambientes = 'Sala com 2 ambientes;'; else: $sala2ambientes = '0'; endif;
			$dados['sala2ambientes'] = $sala2ambientes;
			
			if($this->input->post('cozinha')): $cozinha = 'Cozinha;'; else: $cozinha = '0'; endif;
			$dados['cozinha'] = $cozinha;
			
			if($this->input->post('cozinhaPlanejada')): $cozinhaPlanejada = 'Cozinha Planejada;'; else: $cozinhaPlanejada = '0'; endif;
			$dados['cozinhaPlanejada'] = $cozinhaPlanejada;
			
			if($this->input->post('cozinhaAmericana')): $cozinhaAmericana = 'Cozinha Americana;'; else: $cozinhaAmericana = '0'; endif;
			$dados['cozinhaAmericana'] = $cozinhaAmericana;
			
			if($this->input->post('cozinhaMineira')): $cozinhaMineira = 'Cozinha Mineira;'; else: $cozinhaMineira = '0'; endif;
			$dados['cozinhaMineira'] = $cozinhaMineira;
			
			if($this->input->post('cozinhaMineira')): $cozinhaMineira = 'Cozinha Mineira;'; else: $cozinhaMineira = '0'; endif;
			$dados['cozinhaMineira'] = $cozinhaMineira;
			
			if($this->input->post('lavabo')): $lavabo = 'Lavabo;'; else: $lavabo = '0'; endif;
			$dados['lavabo'] = $lavabo;
			
			if($this->input->post('areaServico')): $areaServico = 'Área de Serviço;'; else: $areaServico = '0'; endif;
			$dados['areaServico'] = $areaServico;
			
			if($this->input->post('quartoEmpregada')): $quartoEmpregada = 'Quarto de empregada;'; else: $quartoEmpregada = '0'; endif;
			$dados['quartoEmpregada'] = $quartoEmpregada;
			
			if($this->input->post('quintal')): $quintal = 'Quintal;'; else: $quintal = '0'; endif;
			$dados['quintal'] = $quintal;
			
			if($this->input->post('copa')): $copa = 'Copa;'; else: $copa = '0'; endif;
			$dados['copa'] = $copa;
			
			if($this->input->post('escritorio')): $escritorio = 'Escritório;'; else: $escritorio = '0'; endif;
			$dados['escritorio'] = $escritorio;
			
			if($this->input->post('despensa')): $despensa = 'Despensa;'; else: $despensa = '0'; endif;
			$dados['despensa'] = $despensa;
			
			if($this->input->post('porao')): $porao = 'Porão;'; else: $porao = '0'; endif;
			$dados['porao'] = $porao;
			
			if($this->input->post('piscina')): $piscina = 'Piscina;'; else: $piscina = '0'; endif;
			$dados['piscina'] = $piscina;
			
			if($this->input->post('churrasqueira')): $churrasqueira = 'Churrasqueira;'; else: $churrasqueira = '0'; endif;
			$dados['churrasqueira'] = $churrasqueira;
			
			if($this->input->post('jardim')): $jardim = 'Jardim;'; else: $jardim = '0'; endif;
			$dados['jardim'] = $jardim;
			
			if($this->input->post('jardimInverno')): $jardimInverno = 'Jardim de Inverno;'; else: $jardimInverno = '0'; endif;
			$dados['jardimInverno'] = $jardimInverno;
			
			if($this->input->post('areaLazer')): $areaLazer = 'Área de Lazer;'; else: $areaLazer = '0'; endif;
			$dados['areaLazer'] = $areaLazer;
			
			if($this->input->post('salaoJogos')): $salaoJogos = 'Salão de Jogos;'; else: $salaoJogos = '0'; endif;
			$dados['salaoJogos'] = $salaoJogos;
			
			if($this->input->post('sauna')): $sauna = 'Sauna;'; else: $sauna = '0'; endif;
			$dados['sauna'] = $sauna;
			
			if($this->input->post('hidromassagem')): $hidromassagem = 'Hidromassagem;'; else: $hidromassagem = '0'; endif;
			$dados['hidromassagem'] = $hidromassagem;
			
			if($this->input->post('ofuroJacuzi')): $ofuroJacuzi = 'Ofuro / Jacuzi;'; else: $ofuroJacuzi = '0'; endif;
			$dados['ofuroJacuzi'] = $ofuroJacuzi;
			    
			if($this->input->post('gourmet')): $gourmet = 'Espaço Gourmet;'; else: $gourmet = '0'; endif;
			$dados['gourmet'] = $gourmet;
			    
			if($this->input->post('sacada')): $sacada = 'Sacada;'; else: $sacada = '0'; endif;
			$dados['sacada'] = $sacada;
			    
			if($this->input->post('varanda')): $varanda = 'Varanda;'; else: $varanda = '0'; endif;
			$dados['varanda'] = $varanda;
			    
			if($this->input->post('portaoEletronico')): $portaoEletronico = 'Portão Eletrônico;'; else: $portaoEletronico = '0'; endif;
			$dados['portaoEletronico'] = $portaoEletronico;
			    
			if($this->input->post('interfone')): $interfone = 'Interfone;'; else: $interfone = '0'; endif;
			$dados['interfone'] = $interfone;
			    
			if($this->input->post('aquecedorSolar')): $aquecedorSolar = 'Aquecedor Solar;'; else: $aquecedorSolar = '0'; endif;
			$dados['aquecedorSolar'] = $aquecedorSolar;
			    
			if($this->input->post('cercaEletrica')): $cercaEletrica = 'Cerca Elétrica;'; else: $cercaEletrica = '0'; endif;
			$dados['cercaEletrica'] = $cercaEletrica;
			    
			if($this->input->post('farmacia')): $farmacia = 'Farmácia;'; else: $farmacia = '0'; endif;
			$dados['farmacia'] = $farmacia;
			    
			if($this->input->post('supermercado')): $supermercado = 'Supermercado;'; else: $supermercado = '0'; endif;
			$dados['supermercado'] = $supermercado;
			    
			if($this->input->post('mercado')): $mercado = 'Mercado;'; else: $mercado = '0'; endif;
			$dados['mercado'] = $mercado;
			    
			if($this->input->post('padaria')): $padaria = 'Padaria;'; else: $padaria = '0'; endif;
			$dados['padaria'] = $padaria;
			    
			if($this->input->post('acougue')): $acougue = 'Açougue;'; else: $acougue = '0'; endif;
			$dados['acougue'] = $acougue;
			    
			if($this->input->post('pizzaria')): $pizzaria = 'Pizzaria;'; else: $pizzaria = '0'; endif;
			$dados['pizzaria'] = $pizzaria;
			    
			if($this->input->post('restaurante')): $restaurante = 'Restaurante;'; else: $restaurante = '0'; endif;
			$dados['restaurante'] = $restaurante;
			    
			if($this->input->post('lanchonete')): $lanchonete = 'Lanchonete;'; else: $lanchonete = '0'; endif;
			$dados['lanchonete'] = $lanchonete;
			    
			if($this->input->post('igrejaEvangelica')): $igrejaEvangelica = 'Igreja Evangélica;'; else: $igrejaEvangelica = '0'; endif;
			$dados['igrejaEvangelica'] = $igrejaEvangelica;
			    
			if($this->input->post('igrejaCatolica')): $igrejaCatolica = 'Igreja Católica;'; else: $igrejaCatolica = '0'; endif;
			$dados['igrejaCatolica'] = $igrejaCatolica;
			    
			if($this->input->post('templo')): $templo = 'Templo;'; else: $templo = '0'; endif;
			$dados['templo'] = $templo;
			    
			if($this->input->post('parque')): $parque = 'Parque / Praça / Clube;'; else: $parque = '0'; endif;
			$dados['parque'] = $parque;
			    
			if($this->input->post('onibus')): $onibus = 'Ponto de ônibus;'; else: $onibus = '0'; endif;
			$dados['onibus'] = $onibus;
			    
			if($this->input->post('postoGasolina')): $postoGasolina = 'Posto de Gasolina;'; else: $postoGasolina = '0'; endif;
			$dados['postoGasolina'] = $postoGasolina;
			    
			if($this->input->post('postoSaude')): $postoSaude = 'Posto de Saúde;'; else: $postoSaude = '0'; endif;
			$dados['postoSaude'] = $postoSaude;
			    
			if($this->input->post('hospital')): $hospital = 'Hospital;'; else: $hospital = '0'; endif;
			$dados['hospital'] = $hospital;
			    
			if($this->input->post('escola1grau')): $escola1grau = 'Escola de 1º grau;'; else: $escola1grau = '0'; endif;
			$dados['escola1grau'] = $escola1grau;
			    
			if($this->input->post('escola2grau')): $escola2grau = 'Escola de 2º grau;'; else: $escola2grau = '0'; endif;
			$dados['escola2grau'] = $escola2grau;
			    
			if($this->input->post('faculdade')): $faculdade = 'Faculdade;'; else: $faculdade = '0'; endif;
			$dados['faculdade'] = $faculdade;
			    
			if($this->input->post('creche')): $creche = 'Creche;'; else: $creche = '0'; endif;
			$dados['creche'] = $creche;
			
			$dados['observacoes'] = $this->input->post('observacoes');
			$dados['status'] = $this->input->post('status');
			
			
			$this -> admin_model -> atualizar_imovel($dados, array('idImovel' => $this -> input -> post('idImovel')));
			$this -> session -> set_flashdata('sucesso', 'Atualizado com sucesso.');
			redirect('admin/gerenciar-imoveis','location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_imovel() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		if ($this->uri->segment(3) > 0):
			$imovel = $this -> admin_model -> get_imovel($this->uri->segment(3)) -> row();
			
			// Deleta Foto
			if($imovel -> capa != '0'):
				unlink('./fotos-imoveis/'.$imovel -> capa);
			endif;
			
			$this -> admin_model -> excluir_imovel(array('idImovel' => $this->uri->segment(3)));
			
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/gerenciar-imoveis', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function cadastrar_fotos() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		
		$dados['titulo'] = 'Cadastrar Fotos';
		$dados['imovel'] = $this -> admin_model -> get_imovel($this->uri->segment(3)) -> row();
		$dados['fotos'] = $this -> admin_model -> get_fotos($this->uri->segment(3)) -> result();

		$this -> load -> view('admin/fotos-imoveis', $dados);

		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	public function upload_fotos() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
			$config['upload_path'] = './fotos-imoveis/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '10240';
			$config['overwrite']  = FALSE;
			$config['encrypt_name'] = TRUE;
			 
			$arquivo = "arquivo";
			$this->upload->initialize($config); 

			//Faz o upload
			if(!$this->upload->do_upload($arquivo)):
			    $error = array('erro' => $this->upload->display_errors());
			else:
			    $upload_data = $this->upload->data();
				
				$dados['codImovel'] = $this->input->post('idImovel'); 
				$dados['foto'] = $upload_data['file_name']; 
				$dados['thumb'] = $upload_data['file_name']; 
				$dados['legenda'] = $this->input->post('legenda'); 
				$dados['ordem'] = $this->input->post('ordem'); 
				$this -> admin_model -> inserir_fotos($dados);
			    $capa = $upload_data['file_name']; 
			endif;
			
			$medidaImagem = getimagesize('./fotos-imoveis/'.$capa);
			$largurao = $medidaImagem[0];
			$alturao = $medidaImagem[1];
			
			if($medidaImagem[0] > $medidaImagem[1]):
				$larguran   = 800; // altura nova
				$alturan = ($alturao * $larguran) / $largurao; // altura nova
			else:
				$alturan   = 600; // altura nova
				$larguran = ($largurao * $alturan) / $alturao; // largura nova
			endif;
			
			$config_img['image_library'] = 'gd2';
			$config_img['source_image'] = './fotos-imoveis/'.$capa;
			$config_img['create_thumb'] = FALSE;
			$config_img['maintain_ratio'] = TRUE;
			$config_img['width'] = $larguran;
			$config_img['height'] = $alturan;
			$config_img['wm_overlay_path'] = './images/marca-dagua.png';
			$config_img['wm_type'] = 'overlay';
			$config_img['wm_vrt_alignment'] = 'middle';
			$config_img['wm_hor_alignment'] = 'center';

			$this->load->library('image_lib', $config_img);
			
			$this->image_lib->resize();
			$this->image_lib->watermark();
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_foto() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
		if ($this->uri->segment(3) > 0):
			$foto = $this -> admin_model -> get_foto_delete($this->uri->segment(3)) -> row();
			unlink('./fotos-imoveis/'.$foto -> foto);
			$this -> admin_model -> excluir_foto(array('idFoto' => $this->uri->segment(3)));
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/cadastrar-fotos/'. $this->uri->segment(4), 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	// ====== FIM IMÓVEIS ====== //
		
	// ====== CIDADES ====== //
	public function cidades($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$limite_por_pag = 10;
		$config['base_url'] = base_url()."admin/cidades";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('cidades') -> num_rows();
		$this->pagination->initialize($config); 
		 
		$dados['titulo'] = 'Cadastrar Cidades e Bairros';
		$dados['cidades'] = $this -> admin_model -> pag_cidades($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this -> load -> view('admin/cidades', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function cadastrar_cidade() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		$dados['cidade'] = ucwords($this->input->post('cidade')).' - '.$this->input->post('estado');
		
		$this -> admin_model -> inserir_cidade($dados);
		
		$this -> session -> set_flashdata('sucesso', 'Cadastrado com sucesso.');
		redirect('admin/cidades', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_cidade() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		if ($this->uri->segment(3) > 0):
			$this -> admin_model -> excluir_cidade(array('idCidade' => $this->uri->segment(3)));
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/cidades', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	// ====== FIM CIDADES ====== //
	
	// ====== BAIRROS ====== //
	public function bairros($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$limite_por_pag = 10;
		$config['base_url'] = base_url()."admin/bairros";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('bairros') -> num_rows(); 
		$this->pagination->initialize($config);
		 
		$dados['titulo'] = 'Cadastrar Bairros';
		$dados['cidades'] = $this -> admin_model -> get_cidades() -> result();
		$dados['bairros'] = $this -> admin_model -> pag_bairros($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this -> load -> view('admin/bairros', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function cadastrar_bairro() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		$dados['cidade'] = $this->input->post('cidade');
		$dados['bairro'] = ucwords($this->input->post('bairro'));
		
		$this -> admin_model -> inserir_bairro($dados);
		
		$this -> session -> set_flashdata('sucesso', 'Cadastrado com sucesso.');
		redirect('admin/bairros', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_bairro() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		if ($this->uri->segment(3) > 0):
			$this -> admin_model -> excluir_bairro(array('idBairro' => $this->uri->segment(3)));
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/bairros', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

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
	
	
	// ====== FIM BAIRROS ====== //	
	
	// ====== NEGOCIOS ====== //
	public function negocio($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$limite_por_pag = 10;
		$config['base_url'] = base_url()."admin/negocio";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('negocio') -> num_rows();
		
		$this->pagination->initialize($config);
		 
		$dados['titulo'] = 'Cadastrar Bairros';
		$dados['negocios'] = $this -> admin_model -> pag_negocio($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this -> load -> view('admin/negocio', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function cadastrar_negocio() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		$dados['negocio'] = ucwords($this->input->post('negocio'));
		
		$this -> admin_model -> inserir_negocio($dados);
		
		$this -> session -> set_flashdata('sucesso', 'Cadastrado com sucesso.');
		redirect('admin/negocio', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_negocio() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		if ($this->uri->segment(3) > 0):
			$this -> admin_model -> excluir_negocio(array('idNegocio' => $this->uri->segment(3)));
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/negocio', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	// ====== FIM NEGOCIO ====== //	
	
	// ====== TIPOS (DE IMOVEIS) ====== //
	public function tipos($offset=0) {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 
		$limite_por_pag = 10;
		$config['base_url'] = base_url()."admin/tipos";
		$config['per_page'] = $limite_por_pag;
		$config['total_rows'] = $this->db->get('tipo') -> num_rows();
		
		$this->pagination->initialize($config);
		 
		$dados['titulo'] = 'Cadastrar Tipos de Imóveis';
		$dados['tipos'] = $this -> admin_model -> pag_tipos($limite_por_pag, $offset) -> result();
		$dados['paginacao'] = $this -> pagination -> create_links();
		
		$this -> load -> view('admin/tipos', $dados);
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function cadastrar_tipo() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		$dados['tipo'] = ucwords($this->input->post('tipo'));
		
		$this -> admin_model -> inserir_tipo($dados);
		
		$this -> session -> set_flashdata('sucesso', 'Cadastrado com sucesso.');
		redirect('admin/tipos', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}

	public function excluir_tipo() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		if ($this->uri->segment(3) > 0):
			$this -> admin_model -> excluir_tipo(array('idTipo' => $this->uri->segment(3)));
		endif;
		
		$this -> session -> set_flashdata('sucesso', 'Excluido com sucesso.');
		redirect('admin/tipos', 'location');
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	// ====== FIM TIPOS (DE IMOVEIS) ====== //	

	
	
	public function chat() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		$dados['titulo'] = 'Chat On-line';
		
		$this -> load -> view('admin/chat', $dados);	
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	// ====== PAGINAS ====== //
	public function paginas() {
		
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		 		  
		
		$dados['titulo'] = 'Paginas';
		$dados['sobre'] = $this -> admin_model -> get_pagina('1') -> row();
		$dados['servicos'] = $this -> admin_model -> get_pagina('2') -> row();
		$dados['loteamentos'] = $this -> admin_model -> get_pagina('3') -> row();
		
		$this -> load -> view('admin/paginas', $dados);	
		
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login

	}
	
	
	public function atualizar_pagina() {
		//Valida Login
		if ($this -> session -> userdata('logado')):
			$session_data = $this -> session -> userdata('logado');
		//Valida Login
		
		//validacao
		$this -> form_validation -> set_rules('titulo', 'TÍTULO', 'trim|required|max_length[250]');
		$this -> form_validation -> set_rules('conteudo', 'CONTEUDO', 'trim|required');
		

		if ($this -> form_validation -> run() == true) {
			$dados['titulo'] = $this -> input -> post('titulo');
			$dados['conteudo'] = $this -> input -> post('conteudo');
			$this -> admin_model -> atualizar_pagina($dados, array('id' => $this -> input -> post('id')));
		}
			
		$dados = array('titulo' => 'Painel de Controle - Editar Pagina');
		$this -> load -> view('admin/paginas', $dados);
		
		//Valida Login
		else :
			$this -> session -> set_flashdata('acesso', 'Efetue o login.');
			redirect('admin/', 'location');
		endif;
		//Valida Login
	}
	
		// ====== FIM PAGINAS ====== //
		
		
	
	
}