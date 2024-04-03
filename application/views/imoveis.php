<!doctype html>
<html class="no-js" lang="pt-br">
	<head>
		<?php $this -> load -> view('includes/head'); ?>
	</head>
	<body>

		<!-- Topo -->
		<?php $this -> load -> view('includes/menu'); ?>
		
		<!-- Banner -->
		<?php $this -> load -> view('includes/banners'); ?>
		
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>

		<!-- Conteudo -->
		<div class="row">
			<div class="medium-12 medium-centered columns">
				<h1>IMÓVEIS</h1>
				<p>Conheça abaixo todas as nossa opções de imóveis</p>
					<?php 
							if ($imoveis):
								$this -> table -> set_heading('','Código Ref.:','Imóvel','Negócio','Valor','Cidade','');
								foreach ($imoveis as $imovel) :
									if($imovel -> status == 'Vendido'):
										$status = base_url().'/images/btn-vendido.png';
									elseif($imovel -> status == 'Alugado'):
										$status = base_url().'/images/btn-alugado.png';
									elseif($imovel -> status == 'Oferta'):
										$status = base_url().'/images/btn-oferta.png';
									elseif($imovel -> status == 'Oportunidade'):
										$status = base_url().'/images/btn-oportunidade.png';
									else:
										$status = base_url().'/images/px-transp.png';
									endif;
									
									if($imovel -> capa != '0'):
										$capa = base_url().'fotos-imoveis/'.$imovel -> capa;
									else:
										$capa = base_url().'images/sem-foto-cadastrada.jpg';										
									endif;
									$this -> table -> add_row('<img src="'.$capa.'" /><img src="'.$status.'" style="position: absolute; left: 26px; height:80px;" />', $imovel -> CodUnico, $imovel -> tipo, $imovel -> negocio, number_format($imovel -> valor, 2, ",", "."), $imovel -> cidade, '<a href="'.base_url().'imoveis/detalhe-imovel/'.$imovel->CodUnico.'" class="button colibri tiny right">+ DETALHES</a>');
								endforeach;
								echo $this -> table -> generate();
								echo !empty($paginacao) ? $paginacao : '';
								
							else :
								echo 'Não existem registros.';
							endif;					
					 ?>		
				

			</div>
		</div>
		<!-- Fim Conteudo -->
		
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="row">
			<div class="medium-12 columns text-center">
				<hr />
			</div>
		</div>
		
		<!-- Busca -->
		<?php $this -> load -> view('includes/busca'); ?>
		
		

		<?php $this -> load -> view('includes/rodape'); ?>
		
		<?php $this -> load -> view('includes/scripts'); ?>
	</body>
</html>