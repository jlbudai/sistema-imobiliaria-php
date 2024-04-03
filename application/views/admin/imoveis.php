<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt-br">
	<!--<![endif]-->
	<head>
		<?php $this->load->view('admin/head'); ?>
	</head>
	<body>
		
		<?php $this->load->view('admin/topo'); ?>
		
		<div class="row.full">
			<div class="medium-2 columns bgd-cz5 padding0 margin0 panel">
				<?php $this->load->view('admin/menu'); ?>		
			</div>
			<div class="medium-10 columns">
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="medium-12 columns">



						<h4>Imóveis Cadastrados</h4>
						<?php
							if ($this -> session -> flashdata('sucesso')) {
								echo '<div class="alert-box success">' . $this -> session -> flashdata('sucesso') . '<a href="" class="close">&times;</a></div>';
							}
							
							if ($imoveis):
								$this -> table -> set_heading('Código Único','Tipo de Negócio','Endereço','','','');
								foreach ($imoveis as $imovel) :
									$negocio = $imovel -> tipo .' para '.$imovel -> negocio;
									$endereco = $imovel -> endereco .' '.$imovel -> bairro.' - '.$imovel -> cidade;
									$this -> table -> add_row(anchor(base_url().'imoveis/detalhe-imovel/'.$imovel -> CodUnico, $imovel -> CodUnico, 'title="Clique para Visualizar o imóvel" target="_blank"'),$negocio, $endereco, '<a href="'.base_url().'admin/cadastrar-fotos/'.$imovel->idImovel.'" class="button success [tiny small large] right margin0">Fotos</a>', '<a href="'.base_url().'admin/editar-imovel/'.$imovel->idImovel.'" class="button [tiny small large] right margin0">Editar</a>', '<a href="'.base_url().'admin/excluir-imovel/'.$imovel->idImovel.'" class="button alert [tiny small large] right margin0">Excluir</a>');
								endforeach;
								echo $this -> table -> generate();
								echo !empty($paginacao) ? $paginacao : '';
								
							else :
								echo 'Não existem registros.';
							endif;
							
						?>
						
						
					</div>		
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('admin/scripts'); ?>
		
		

	</body>
</html>