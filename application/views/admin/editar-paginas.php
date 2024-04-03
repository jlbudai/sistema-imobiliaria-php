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
		<div id="navegacao">	
		<?php $this->load->view('admin/menu'); ?>
			
		</div>
		
		<div id="conteudo-admin">
			<?php $this->load->view('admin/topo'); ?>
			
			<div id="box-conteudo">
				<h5>Editando Páginas</h5>
				<br />
			<?php
			echo form_open('admin/atualizar_pagina/'.$idPagina);
				echo "Título da Página<br/><br/>";
				echo form_input(array('name' => 'titulo'), set_value('titulo', $tituloPagina), 'class="input-text" autofocus').'<br/><br/>';
				echo "Subtitulo da Página<br/><br/>";
				echo form_input(array('name' => 'subtitulo'), set_value('subtitulo', $subtituloPagina), 'class="input-text"').'<br/><br/>';
				echo "Conteúdo da Página<br/><br/>";
				echo form_textarea(array('name' => 'conteudo'),  set_value('conteudo', $conteudo));
				echo '<br/><br/>';
			?>
			<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:history.back();" class="button alert round" />
			<?php
				echo form_submit(array('name' => 'atualizar'), 'Atualizar', 'class="button success round"');
			echo form_close();
			?>
			</div>
			
		</div>


		<!-- Include Scripts -->
		<?php $this->load->view('includes/scripts'); ?>
		
		<script src="<?php echo base_url().'javascripts/ckeditor/ckeditor.js' ?>"></script>
		<script>
			CKEDITOR.replace( 'conteudo' );
		</script>		
		

	</body>
</html>