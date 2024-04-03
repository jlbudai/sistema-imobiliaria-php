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
				<h1><?php echo $conteudo->titulo ?></h1>
				<?php echo $conteudo->conteudo ?>
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