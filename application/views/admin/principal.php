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
		
		<div class="row.full height100">
			<div class="medium-2 columns bgd-cz5 padding0 margin0 height100 panel">
				<?php $this->load->view('admin/menu'); ?>		
			</div>
			<div class="medium-10 columns">
				<div class="clearfix">&nbsp;</div>
				<div class="row">
					<div class="medium-10 medium-centered columns panel">
						<h4>Bem vindo ao Gerenciador de Conteúdo</h4>
						<p>Para efetuar alterações como incluir, editar e excluir o conteudo do site, utilize o menu ao lado. Cada uma das áreas principais dará acesso a todas as funcionalidades da respectiva área.</p>
					</div>		
				</div>
			</div>
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('includes/scripts'); ?>

	</body>
</html>