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
		
		<div class="row.full">
			<div class="medium-12 columns">
				<hr class="hr-az">
			</div>
		</div>

		<!-- Conteudo -->
		<div class="row">
			<div class="medium-12 medium-centered columns">
				<h1>ERRO 404</h1>
				<p>A página solicitada não foi encontrada. Por favor utilize o menu acima para navegar em nosso site. Em caso de dúvidas, entre em <a href="<?php echo base_url();  ?>fale-conosco">contato</a></p>		
				

			</div>
		</div>
		<!-- Fim Conteudo -->
		
		<div class="clearfix">&nbsp;</div>
		
		<div class="row">
			<div class="medium-12 columns text-center">
				<img src="<?php echo base_url() ?>/images/linha.png" />
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		
		<!-- Busca -->
		<?php $this -> load -> view('includes/busca'); ?>
		
		

		<?php $this -> load -> view('includes/rodape'); ?>
		
		<?php $this -> load -> view('includes/scripts'); ?>
	</body>
</html>